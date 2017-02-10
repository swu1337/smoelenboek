<?php
namespace smoelenboek\models;

class BezoekerModel {
    private $control;
    private $action;
    private $db;

    public function __construct($control, $action) {
        $this->control = $control;
        $this->action = $action;
        $this->db = new \PDO(DATA_SOURCE_NAME, DB_USERNAME, DB_PASSWORD);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function isPostLeeg() {
        return empty($_POST);
    }

    private function startSessie() {
        if(!isset($_SESSION)) {
            session_start();
        }
    }

    public function controleerInloggen() {
        $gn =  filter_input(INPUT_POST, 'gn');
        $ww =  filter_input(INPUT_POST, 'ww');

        if (!empty($gn) && !empty($ww)) {
            $sql = 'SELECT * FROM `personen` WHERE `personen`.`gebrnaam` = :gn AND `personen`.`ww` = :ww';
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':gn', $gn);
            $stmnt->bindParam(':ww', $ww);
            $stmnt->execute();

            $result = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__.'\db\Persoon');

            if(count($result) === 1) {
                $this->startSessie();
                $_SESSION['gebruiker'] = $result[0];
                return REQUEST_SUCCESS;
            }

            return REQUEST_FAILURE_DATA_INVALID;
        }
        return REQUEST_FAILURE_DATA_INCOMPLETE;
    }

    public function getDirecteur() {
        $sql = "SELECT * FROM `personen` WHERE `personen`.`recht`= 'directeur'";
        $stmnt = $this->db->prepare($sql);
        $stmnt->execute();
        $contacten = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__.'\db\Persoon');

        return $contacten[0];
    }

    public function getGebruiker() {
        // if(!isset($_SESSION['gebruiker'])) {
        //     return NULL;
        // }
        // return $_SESSION['gebruiker'];

        return isset($_SESSION['gebruiker']) ? $_SESSION['gebruiker'] : NULL;
    }
}
