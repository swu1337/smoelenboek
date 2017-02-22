<?php
namespace smoelenboek\models;

use smoelenboek\utils\Foto as FOTO;

class DirecteurModel {
    private $control;
    private $action;
    private $db;

    public function __construct($control, $action) {
        $this->control = $control;
        $this->action = $action;
        $this->db = new \PDO(DATA_SOURCE_NAME, DB_USERNAME, DB_PASSWORD);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->startSessie();
    }

    private function updateGebruiker() {
        $gebruiker_id = $this->getGebruiker()->getId();
        $sql = "SELECT * FROM `personen` WHERE `personen`.`id`= :gebruiker_id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':gebruiker_id', $gebruiker_id);
        $stmnt->setFetchMode(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Persoon');
        $stmnt->execute();
        $_SESSION['gebruiker']= $stmnt->fetch(\PDO::FETCH_CLASS);
    }

    private function startSessie() {
        if(!isset($_SESSION)) {
            session_start();
        }
    }

    private function heeftKlasMentor($kid) {
        $sql = "SELECT EXISTS(SELECT * FROM `klassen` WHERE `klassen`.`mentor_id` IS NOT NULL AND `klassen`.`id` = :kid)";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':kid', $kid);
        $stmnt->execute();
        return in_array('1', $stmnt->fetch(\PDO::FETCH_ASSOC));
    }
    
    private function removeMentorFromKlas($klas_id) {
        $sql = "UPDATE `klassen` SET `klassen`.`mentor_id` = NULL WHERE `klassen`.`id` = :id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam('id', $klas_id);
        $stmnt->execute();
    }
    
    private function updateKlas($mentor_id, $klas_id, $klasnaam) {
        $sql = "UPDATE `klassen` SET `klassen`.`mentor_id` = :mentor_id, `klassen`.`naam` = :klasnaam WHERE `klassen`.`id` = :klas_id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':mentor_id', $mentor_id);
        $stmnt->bindParam(':klas_id', $klas_id);
        $stmnt->bindParam(':klasnaam', $klasnaam);
        $stmnt->execute();
        
        return $stmnt;
    }

    public function isGerechtigd() {
        //controleer of er ingelogd is. Ja, kijk of de gebuiker deze controller mag gebruiken
        if(isset($_SESSION['gebruiker']) && !empty($_SESSION['gebruiker'])) {
        $gebruiker = $_SESSION['gebruiker'];

        // if ($gebruiker->getRecht() == "medewerker") {
        //     return true;
        // } else {
        //     return false;
        // }

        return $gebruiker->getRecht() === "directeur";
        }

        return false;
    }

    public function getGebruiker() {
        return $_SESSION['gebruiker'];
    }

    public function uitloggen() {
       $_SESSION = array();
       session_destroy();
    }

    public function isPostLeeg() {
        return empty($_POST);
    }

    public function isMentor($persoon_id, $klas_id = null) {
        $sql = "SELECT EXISTS(SELECT * FROM `klassen` WHERE `klassen`.`mentor_id` = :p_id LIMIT 1)";

        if(!empty($klas_id)) {
            $sql ="SELECT EXISTS(SELECT * FROM `klassen` WHERE `klassen`.`mentor_id` = :p_id AND `klassen`.`id` = :klas_id LIMIT 1)";
        }

        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':p_id', $persoon_id);

        if(!empty($klas_id)) {
            $stmnt->bindParam(':klas_id', $klas_id);
        }

        $stmnt->execute();

        return in_array('1', $stmnt->fetch(\PDO::FETCH_ASSOC));
    }

    public function getKlassen($first = false) {
        $sql = "SELECT * FROM `klassen`";

        if($first) {
            $sql = "SELECT `klassen`.* FROM `klassen` JOIN `personen` ON `klassen`.`mentor_id` = `personen`.`id` LIMIT 1";
        }

        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();

        if($first) {
            return $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Klas')[0];
        }

        return $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Klas');
    }

    public function getKlasByLeerling($id) {
        $sql = "SELECT `klassen`.* FROM `klassen` LEFT JOIN `personen` on `personen`.`klas_id` = `klassen`.`id` WHERE `personen`.`id` = :ll_id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':ll_id', $id);
        $stmnt->execute();

        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Klas')[0];
    }

    public function getAlleLeerlingen() {
        $sql = "SELECT `personen`.*, `klassen`.`naam` as \"klasnaam\" FROM `personen` LEFT JOIN `klassen` ON `personen`.`klas_id` = `klassen`.`id` WHERE `personen`.`recht` = 'leerling'";
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();

        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Persoon');
    }

    public function getKlasById($klas_id) {
        $sql = "SELECT * FROM `klassen` WHERE `klassen`.`id` = :id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $klas_id);
        $stmnt->execute();

        $klas = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Klas');

        if($klas) {
            return $klas[0];
        } else {
            return REQUEST_WRONG_URL;
        }
    }

    public function getKlasByMentor($m_id) {
        $sql = "SELECT * FROM `klassen` WHERE `klassen`.`mentor_id` = :m_id LIMIT 1";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':m_id', $m_id);
        $stmnt->execute();
        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Klas')[0];
    }

    public function getLeerlingen($klas_id = NULL) {
        $sql = "SELECT * FROM `personen` WHERE recht = 'leerling'";

        if(!empty($klas_id)) {
            $sql = "SELECT * FROM `personen` WHERE klas_id = :klas_id";
        }

        $stmnt = $this->db->prepare($sql);

        if(!empty($klas_id)) {
            $stmnt->bindParam(':klas_id', $klas_id);
        }

        $stmnt->execute();

        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Persoon');
    }

    public function getMentor($klas_id) {
        $sql = "SELECT * FROM `personen` WHERE `personen`.`id` = (SELECT `mentor_id` FROM `klassen` WHERE `klassen`.`id` = :klas_id)";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':klas_id', $klas_id);
        $stmnt->execute();
        $mentor = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Persoon');

        if (count($mentor) === 1) {
            return $mentor[0];
        } else {
            return NULL;
        }
    }

    public function getDocenten($request) {
        switch ($request) {
            case 'All':
                $sql = "SELECT `personen`.*, `klassen`.naam AS \"klasnaam\" FROM `personen` LEFT JOIN `klassen` ON `personen`.`id` = `klassen`.`mentor_id` WHERE recht = 'docent' ORDER BY `personen`.`id`";
                break;
            case 'Beschikbaar':
                $sql = "SELECT `personen`.* FROM `personen` LEFT JOIN `klassen` ON `personen`.`id` = `klassen`.`mentor_id` WHERE recht = 'docent' AND `klassen`.`mentor_id` IS NULL ORDER BY `personen`.`id`";
                break;
        }

        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();

        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Persoon');
    }

    public function getPersoonById($id) {
        $sql = "SELECT * FROM `personen` WHERE `personen`.`id` = :id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();

        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Persoon')[0];
    }
    
    public function createData() {
        switch (filter_input(INPUT_GET, 'prop')) {
            case 'leerling':               
                $gebruikersnaam = filter_input(INPUT_POST, 'gebrnaam');
                $voorletter = filter_input(INPUT_POST, 'vnaam');
                $achternaam = filter_input(INPUT_POST, 'anaam');
                $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
                $telnummer = filter_input(INPUT_POST, 'telnummer');
                $klas = filter_input(INPUT_POST, 'klas', FILTER_VALIDATE_INT);
                $adres = filter_input(INPUT_POST, 'adres');
                $plaats = filter_input(INPUT_POST, 'plaats');

                //NOT-REQUIRED
                $wachtwoord = filter_input(INPUT_POST, 'ww');
                $tussenvoegsel = filter_input(INPUT_POST, 'tv');
                
                if(in_array(null, [$gebruikersnaam, $voorletter, $achternaam, $telnummer, $email, $klas, $adres, $plaats])) {
                    return REQUEST_FAILURE_DATA_INCOMPLETE;
                }

                if($email === false || $klas === false) {
                    echo 'dede';
                    return REQUEST_FAILURE_DATA_INVALID;
                }

                if(empty($wachtwoord)) {
                    $wachtwoord = 'qwerty';
                }

                $result = FOTO::isAfbeeldingGestuurd();
                if($result === IMAGE_FAILURE_TYPE || $result === IMAGE_FAILURE_SIZE_EXCEEDED) {
                    return $result;
                }

                if($result === IMAGE_NOTHING_UPLOADED) {
                    $foto = IMAGE_LOCATION . IMAGE_DEFAULT;
                } else {
                    $foto = IMAGE_LOCATION . FOTO::getAfbeeldingNaam();
                }

                $sql = "INSERT IGNORE INTO `personen` (vnaam, tv, anaam, gebrnaam, ww, email, telnummer, foto, adres, plaats, klas_id, recht) 
                VALUES (:vnaam, :tv, :anaam, :gebrnaam, :ww, :email, :telnummer, :foto, :adres, :plaats, :klas_id, 'leerling')";
                
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindParam(':gebrnaam', $gebruikersnaam);
                $stmnt->bindParam(':ww', $wachtwoord);
                $stmnt->bindParam(':vnaam', $voorletter);
                $stmnt->bindParam(':klas_id', $klas);
                $stmnt->bindParam(':tv', $tussenvoegsel);
                $stmnt->bindParam(':anaam', $achternaam);
                $stmnt->bindParam(':email', $email);
                $stmnt->bindParam(':adres', $adres);
                $stmnt->bindParam(':plaats', $plaats);
                $stmnt->bindParam(':telnummer', $telnummer);
                $stmnt->bindParam(':foto', $foto);
                
                try {
                    var_dump($stmnt);
                    $stmnt->execute();
                } catch(\PDOEXception $e) {
                    var_dump($e); 
                    return REQUEST_FAILURE_DATA_INVALID;
                }

                if($stmnt->rowCount() === 1) {
                    if(!empty($foto)) {
                        FOTO::slaAfbeeldingOp($foto);
                    }
                    return REQUEST_SUCCESS;
                }
                
                return REQUEST_FAILURE_DATA_INVALID;
                break;
            case 'docent':
                $gebruikersnaam = filter_input(INPUT_POST, 'gebrnaam');
                $voorletter = filter_input(INPUT_POST, 'vnaam');
                $achternaam = filter_input(INPUT_POST, 'anaam');
                $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
                $telnummer = filter_input(INPUT_POST, 'telnummer');

                //NOT-REQUIRED
                $adres = filter_input(INPUT_POST, 'adres');
                $plaats = filter_input(INPUT_POST, 'plaats');
                $wachtwoord = filter_input(INPUT_POST, 'ww');
                $tussenvoegsel = filter_input(INPUT_POST, 'tv');
                $klas = null;
                      
                if(in_array(null, [$gebruikersnaam, $voorletter, $achternaam, $telnummer, $email])) {
                    return REQUEST_FAILURE_DATA_INCOMPLETE;
                }

                if($email === false) {
                    return REQUEST_FAILURE_DATA_INVALID;
                }

                if(empty($wachtwoord)) {
                    $wachtwoord = 'qwerty';
                }

                $result = FOTO::isAfbeeldingGestuurd();
                if($result === IMAGE_FAILURE_TYPE || $result === IMAGE_FAILURE_SIZE_EXCEEDED) {
                    return $result;
                }

                if($result === IMAGE_NOTHING_UPLOADED) {
                    $foto = IMAGE_LOCATION . IMAGE_DEFAULT;
                } else {
                    $foto = IMAGE_LOCATION . FOTO::getAfbeeldingNaam();
                }

                $sql = "INSERT IGNORE INTO `personen` (vnaam, tv, anaam, gebrnaam, ww, email, telnummer, foto, adres, plaats, klas_id, recht) 
                VALUES (:vnaam, :tv, :anaam, :gebrnaam, :ww, :email, :telnummer, :foto, :adres, :plaats, :klas_id, 'docent')";
                
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindParam(':gebrnaam', $gebruikersnaam);
                $stmnt->bindParam(':ww', $wachtwoord);
                $stmnt->bindParam(':vnaam', $voorletter);
                $stmnt->bindParam(':klas_id', $klas);
                $stmnt->bindParam(':tv', $tussenvoegsel);
                $stmnt->bindParam(':anaam', $achternaam);
                $stmnt->bindParam(':email', $email);
                $stmnt->bindParam(':adres', $adres);
                $stmnt->bindParam(':plaats', $plaats);
                $stmnt->bindParam(':telnummer', $telnummer);
                $stmnt->bindParam(':foto', $foto);
                
                try {
                    $stmnt->execute();
                } catch(\PDOEXception $e) {
                    return REQUEST_FAILURE_DATA_INVALID;
                }

                if($stmnt->rowCount() === 1) {
                    if(!empty($foto)) {
                        FOTO::slaAfbeeldingOp($foto);
                    }
                    return REQUEST_SUCCESS;
                }

                return REQUEST_FAILURE_DATA_INVALID;
                break;
            case 'klas':
                $klasnaam = filter_input(INPUT_POST, 'klasnaam');
                $mentor = filter_input(INPUT_POST, 'mentorvan', FILTER_VALIDATE_INT);

                if($mentor === null || $klasnaam === null) {
                    return REQUEST_FAILURE_DATA_INCOMPLETE;
                }

                if($mentor === false || $klasnaam === false) {
                    return REQUEST_FAILURE_DATA_INVALID;
                }

                $sql = "INSERT INTO `klassen` (naam, mentor_id) VALUES (:naam, :mentor)";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindParam(':naam', $klasnaam);
                $stmnt->bindParam(':mentor', $mentor);

                try {
                    $stmnt->execute();
                } catch(\PDOEXception $e) {
                    return REQUEST_FAILURE_DATA_INVALID;
                }

                if($stmnt->rowCount() === 1) {
                    return REQUEST_SUCCESS;
                }

                return REQUEST_FAILURE_DATA_INVALID;
                break;
            default:
                return REQUEST_WRONG_URL;
                break;
        }
    }

    public function updateData($object = null) {
        switch (filter_input(INPUT_GET, 'prop')) {
            case 'leerling':
                $gebruikersnaam = filter_input(INPUT_POST, 'gebrnaam');
                $voorletter = filter_input(INPUT_POST, 'vnaam');
                $achternaam = filter_input(INPUT_POST, 'anaam');
                $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
                $telnummer = filter_input(INPUT_POST, 'telnummer');
                $klas = filter_input(INPUT_POST, 'klas', FILTER_VALIDATE_INT);
                $adres = filter_input(INPUT_POST, 'adres');
                $plaats = filter_input(INPUT_POST, 'plaats');
                $id = $object->getId();
                
                //NOT-REQUIRED
                $tussenvoegsel = filter_input(INPUT_POST, 'tv');
                $opmerkingen = filter_input(INPUT_POST, 'opmerkingen');
                
                if(in_array(null, [$gebruikersnaam, $voorletter, $achternaam, $telnummer, $email, $klas, $adres, $plaats])) {
                    return REQUEST_FAILURE_DATA_INCOMPLETE;
                }

                if($email === false || $klas === false) {
                    return REQUEST_FAILURE_DATA_INVALID;
                }
                
                $sql = "UPDATE `personen` SET vnaam = :vnaam, tv = :tv, anaam = :anaam, gebrnaam = :gebrnaam, email = :email, telnummer = :telnummer, adres = :adres, plaats = :plaats, klas_id = :klas_id, opmerkingen = :opmerkingen WHERE `personen`.`id` = :id";
                
                if(!empty($object) && $object->getGebruikersnaam() === $gebruikersnaam) {
                    $sql = "UPDATE `personen` SET vnaam = :vnaam, tv = :tv, anaam = :anaam, email = :email, telnummer = :telnummer, klas_id = :klas_id, adres = :adres, plaats = :plaats, opmerkingen = :opmerkingen WHERE `personen`.`id` = :id";
                }
                
                $stmnt = $this->db->prepare($sql);
                
                if(!empty($object)  && $object->getGebruikersnaam() !== $gebruikersnaam) {
                    $stmnt->bindParam(':gebrnaam', $gebruikersnaam);
                }
                
                $stmnt->bindParam(':id', $id);
                $stmnt->bindParam(':vnaam', $voorletter);
                $stmnt->bindParam(':tv', $tussenvoegsel);
                $stmnt->bindParam(':anaam', $achternaam);
                $stmnt->bindParam(':email', $email);
                $stmnt->bindParam(':telnummer', $telnummer);
                $stmnt->bindParam(':klas_id', $klas);
                $stmnt->bindParam(':adres', $adres);
                $stmnt->bindParam(':plaats', $plaats);
                $stmnt->bindParam(':opmerkingen', $opmerkingen);
                
                try {
                    $stmnt->execute();
                } catch(\PDOEXception $e) {
                    var_dump($e);
                    return REQUEST_FAILURE_DATA_INVALID;
                }

                if($stmnt->rowCount() === 1) {
                    return REQUEST_SUCCESS;
                }

                return REQUEST_FAILURE_DATA_INVALID;
                break;
            case 'docent':
                $gebruikersnaam = filter_input(INPUT_POST, 'gebrnaam');
                $voorletter = filter_input(INPUT_POST, 'vnaam');
                $achternaam = filter_input(INPUT_POST, 'anaam');
                $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
                $telnummer = filter_input(INPUT_POST, 'telnummer');
                $id = $object->getId();
                
                //NOT-REQUIRED
                $tussenvoegsel = filter_input(INPUT_POST, 'tv');
                $adres = filter_input(INPUT_POST, 'adres');
                $plaats = filter_input(INPUT_POST, 'plaats');
                
                if(in_array(null, [$gebruikersnaam, $voorletter, $achternaam, $telnummer, $email])) {
                    return REQUEST_FAILURE_DATA_INCOMPLETE;
                }

                if($email === false) {
                    return REQUEST_FAILURE_DATA_INVALID;
                }
                
                $sql = "UPDATE `personen` SET vnaam = :vnaam, tv = :tv, anaam = :anaam, gebrnaam = :gebrnaam, email = :email, telnummer = :telnummer, adres = :adres, plaats = :plaats WHERE `personen`.`id` = :id";
                
                if(!empty($object) && $object->getGebruikersnaam() === $gebruikersnaam) {
                    $sql = "UPDATE `personen` SET vnaam = :vnaam, tv = :tv, anaam = :anaam, email = :email, telnummer = :telnummer, adres = :adres, plaats = :plaats WHERE `personen`.`id` = :id";
                }
                
                $stmnt = $this->db->prepare($sql);
                
                if(!empty($object)  && $object->getGebruikersnaam() !== $gebruikersnaam) {
                    $stmnt->bindParam(':gebrnaam', $gebruikersnaam);
                }
                
                $stmnt->bindParam(':id', $id);
                $stmnt->bindParam(':vnaam', $voorletter);
                $stmnt->bindParam(':tv', $tussenvoegsel);
                $stmnt->bindParam(':anaam', $achternaam);
                $stmnt->bindParam(':email', $email);
                $stmnt->bindParam(':telnummer', $telnummer);
                $stmnt->bindParam(':adres', $adres);
                $stmnt->bindParam(':plaats', $plaats);
                
                try {
                    $stmnt->execute();
                } catch(\PDOEXception $e) {
                    var_dump($e);
                    return REQUEST_FAILURE_DATA_INVALID;
                }

                if($stmnt->rowCount() === 1) {
                    return REQUEST_SUCCESS;
                }
                break;
            case 'klas':
                $klasnaam = filter_input(INPUT_POST, 'klasnaam');
                $mentor = filter_input(INPUT_POST, 'mentorvan', FILTER_VALIDATE_INT);
                $klas_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                
                if(in_array(null, [$klasnaam, $mentor, $klas_id])) {
                    return REQUEST_FAILURE_DATA_INCOMPLETE;
                }

                if(in_array(false, [$klasnaam,$mentor, $klas_id])) {
                    return REQUEST_FAILURE_DATA_INVALID;
                }

                try {
                    //Check if the selected docent is already a mentor
                    if($this->isMentor($mentor)) {
                        $this->removeMentorFromKlas($this->getKlasByMentor($mentor)->getId());
                        $result = $this->updateKlas($mentor, $klas_id, $klasnaam);
                    } else {
                        $result = $this->updateKlas($mentor, $klas_id, $klasnaam);
                    }
                } catch(\PDOEXception $e) {
                    return REQUEST_FAILURE_DATA_INVALID;
                }
                
                if($result->rowCount() === 1) {
                    return REQUEST_SUCCESS;
                }
                
                return REQUEST_NOTHING_CHANGED;
                break;
            default:
                return REQUEST_WRONG_URL;
                break;
        }
    }

    public function deleteData() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prop = filter_input(INPUT_GET, 'prop');

        if($id === null || $prop === null) {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        if($id === false || $prop === false) {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        switch ($prop) {
            case 'leerling':
            case 'docent':
                $data = $this->getPersoonById($id);
                $fotoNaam = $data->getFoto();
                $sql = "DELETE FROM `personen` WHERE `personen`.`id`=:id";
                break;
            case 'klas':
                $data = $this->getKlasById($id);
                $fotoNaam = NULL;
                $sql = "DELETE FROM `klassen` WHERE `klassen`.`id`=:id";
                break;
        }

        if(count($data) === 0) {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);

        $stmnt->execute();

        if($stmnt->rowCount() === 1) {

            if(!empty($fotoNaam) && $fotoNaam !== IMAGE_LOCATION . IMAGE_DEFAULT) {
                FOTO::verwijderAfbeelding($fotoNaam);
            }

            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }

    public function resetWachtwoord() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if(!empty($id)) {
            $sql = "UPDATE `personen` SET `ww` = 'qwerty' WHERE `personen`.`id` = :id";

            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':id', $id);

            try {
                $stmnt->execute();
            } catch(\PDOEXception $e) {
                return REQUEST_FAILURE_DATA_INVALID;
            }

            if ($stmnt->rowCount() === 1) {
                return REQUEST_SUCCESS;
            }

            return REQUEST_NOTHING_CHANGED;
        } else {
            return REQUEST_FAILURE_DATA_INVALID;
        }
    }

    public function wijzigGegevens($id) {
        $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
        $telefoon = filter_input(INPUT_POST, 'telefoon');

        if(!empty($voorletter) && !empty($telefoon)) {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        if($email === false) {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        $sql = "UPDATE `personen` SET `personen`.`email`= :email, `personen`.`telnummer`= :telefoon WHERE `personen`.`id`= :ll_id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':email', $email);
        $stmnt->bindParam(':telefoon', $telefoon);
        $stmnt->bindParam(':ll_id', $id);

        try {
            $stmnt->execute();
        } catch(\PDOEXception $e) {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        if($stmnt->rowCount() === 1) {
            $this->updateGebruiker();
            return REQUEST_SUCCESS;
        }

        return REQUEST_NOTHING_CHANGED;
    }

    public function wijzigWachtwoord($id) {
        $ww = filter_input(INPUT_POST, 'ww');
        $nww1 = filter_input(INPUT_POST, 'nww1');
        $nww2 = filter_input(INPUT_POST, 'nww2');
        $hww = $this->getGebruiker()->getWachtwoord();

        if(in_array(null, [$nww1, $nww2, $ww])) {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        if($_POST['nww1'] !== $_POST['nww2']) {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        if($hww !== $ww) {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        if($nww1 === $ww) {
            return REQUEST_NOTHING_CHANGED;
        }


        $sql = "UPDATE `personen` SET `personen`.`ww` = :nww WHERE `personen`.`id` = :id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->bindParam(':nww', $nww1);
        $stmnt->execute();

        if($stmnt->rowCount() === 1) {
            $this->updateGebruiker();
            return REQUEST_SUCCESS;
        }

        return REQUEST_NOTHING_CHANGED;
    }

    public function wijzigOpmerking($id) {
        $opmerkingen = filter_input(INPUT_POST, 'opmerkingen');

        if(empty($opmerkingen)) {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        $sql = "UPDATE `personen` SET `personen`.`opmerkingen` = :opmerkingen WHERE `personen`.`id` = :ll_id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':opmerkingen', $opmerkingen);
        $stmnt->bindParam(':ll_id', $id);

        try {
            $stmnt->execute();
        } catch(\PDOEXception $e) {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        if($stmnt->rowCount() === 1) {
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
}
