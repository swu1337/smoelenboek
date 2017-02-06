<?php
namespace smoelenboek\models\db;

class Klas {
    private $id;
    private $naam;
    private $mentor_id;

    public function __construct() {
        $this->id = filter_var($this->id, FILTER_VALIDATE_INT);
        $this->mentor_id = filter_var($this->mentor_id, FILTER_VALIDATE_INT);
        $this->db = new \PDO(DATA_SOURCE_NAME, DB_USERNAME, DB_PASSWORD);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getId() {
        return $this->id;
    }

    public function getNaam() {
        return $this->naam;
    }

    public function getMentor_id() {
        return $this->mentor_id;
    }

    public function getMentor() {
        $sql = "SELECT * FROM `personen` WHERE `personen`.`id` = :mentor_id LIMIT 1";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':mentor_id', $this->mentor_id);
        $stmnt->execute();
        $mentor = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\Persoon');

        if (count($mentor) === 1) {
            return $mentor[0];
        } else {
            return NULL;
        }
    }
}
?>
