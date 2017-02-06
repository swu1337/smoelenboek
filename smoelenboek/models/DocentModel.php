<?php
namespace smoelenboek\models;

class DocentModel {
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

    private function startSessie() {
        if(!isset($_SESSION)) {
            session_start();
        }
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

        return $gebruiker->getRecht() === "docent";
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
            $sql = "SELECT * FROM `klassen` LIMIT 1";
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

    public function getKlasById($klas_id) {
        $sql = "SELECT * FROM `klassen` WHERE `klassen`.`id` = :id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':id', $klas_id);
        $stmnt->execute();
        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Klas')[0];
    }

    public function getKlasByMentor($m_id) {
        $sql = "SELECT * FROM `klassen` WHERE `klassen`.`mentor_id` = :m_id LIMIT 1";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':m_id', $m_id);
        $stmnt->execute();
        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Klas')[0];
    }

    public function getLeerlingById($ll_id) {
        $sql = "SELECT * FROM `personen` WHERE `personen`.`id` = :ll_id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':ll_id', $ll_id);
        $stmnt->execute();

        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Persoon')[0];
    }

    public function getLeerlingen($klas_id) {
        $sql = "SELECT * FROM `personen` WHERE klas_id = :klas_id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':klas_id', $klas_id);
        $stmnt->execute();

        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Persoon');
    }

    public function getMentor($klas_id) {
        $sql = "SELECT * FROM `personen` WHERE `personen`.`id` = (SELECT `mentor_id` FROM `klassen` WHERE `klassen`.`id` = :klas_id)";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':klas_id', $klas_id);
        $stmnt->execute();
        return $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Persoon')[0];
    }

    private function updateGebruiker() {
        $gebruiker_id = $this->getGebruiker()->getId();
        $sql = "SELECT * FROM `personen` WHERE `personen`.`id`=:gebruiker_id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':gebruiker_id', $gebruiker_id);
        $stmnt->setFetchMode(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Persoon');
        $stmnt->execute();
        $_SESSION['gebruiker']= $stmnt->fetch(\PDO::FETCH_CLASS);
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

        $sql = "UPDATE `personen` SET `personen`.`email`=:email, `personen`.`telnummer`=:telefoon WHERE `personen`.`id`=:ll_id";
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

        if(empty($nww1) || empty($nww2) || empty($ww)) {
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
