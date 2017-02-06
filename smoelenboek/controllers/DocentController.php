<?php
namespace smoelenboek\controllers;

use smoelenboek\models as MODELS;
use smoelenboek\view as VIEW;

class DocentController {
    private $action;
    private $control;
    private $view;
    private $model;

    public function __construct($control, $action) {
        $this->control = $control;
        $this->action = $action;

        $this->view = new VIEW\View();
        $this->model = new MODELS\DocentModel($control, $action);

        // $isGerechtigd = $this->model->isGerechtigd();
        //
        // if($isGerechtigd!=true) {
        //     $this->model->loguit();
        //     $this->forward('default',"bezoeker");
        // }

        if(!$this->model->isGerechtigd()) {
            $this->model->uitloggen();
            $this->forward('default',"bezoeker");
        }
    }

    /**
    * execute vertaalt de action variable dynamisch naar een handler van de specifieke controller.
    * als de handler niet bestaat wordt de default als action ingesteld en
    * wordt de taak overgedragen aan de defaultAction handler. defaultAction bestaat altijd wel
    */

    public function execute() {
        $opdracht = $this->action.'Action';

        if(!method_exists($this, $opdracht)) {
            $opdracht = 'defaultAction';
            $this->action = 'default';
        }

        $this->$opdracht();
        $this->view->setAction($this->action);
        $this->view->setControl($this->control);
        $this->view->toon();
    }

    private function forward($action, $control = null) {
        if($control === null) {
            $this->action = $action;
            $controller = $this;
        } else {
            $klasseNaam = __NAMESPACE__.'\\'.ucFirst($control).'Controller';
            $controller = new $klasseNaam($control, $action);
        }

        $controller->execute();
        exit();
    }

    private function uitloggenAction() {
        $this->model->uitloggen();
        $this->forward('default', 'bezoeker');
    }

    private function defaultAction() {
        $gebruiker = $this->model->getGebruiker();

        //Default klas defined if $gebruiker is not a mentor and get mentor and leerlingen from that klas.
        $klas = $this->model->getKlassen(true);
        $leerlingen = $this->model->getLeerlingen($klas->getId());
        $mentor = $this->model->getMentor($klas->getId());

        $isMentor = $this->model->isMentor($gebruiker->getId());

        if($isMentor) {
            $mentor = $gebruiker;
            $leerlingen = $this->model->getLeerlingen($this->model->getKlasByMentor($mentor->getId())->getId());
        }
        $this->view->set('isMentor', $isMentor);
        $this->view->set('mentor', $mentor);
        $this->view->set('klasgenoten', $leerlingen);

        $this->view->set('gebruiker', $gebruiker);
        $this->view->set('klassen', $this->model->getKlassen());
    }

    private function wwWijzigenAction() {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker', $gebruiker);
        $this->view->set('klassen', $this->model->getKlassen());

        if($this->model->isPostLeeg()) {
           $this->view->set('boodschap', 'Wijzig hier je wachtwoord');
        } else {
            switch($this->model->wijzigWachtwoord($gebruiker->getId())) {
                case REQUEST_SUCCESS:
                    $this->view->set('boodschap', 'Wijziging wachtwoord gelukt!');
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set('boodschap', 'Nieuwe wachtwoord niet identiek of oude wachtwoord fout. Poog opnieuw!');
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set('boodschap', 'Niet alle velden ingevuld!');
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set('boodschap', 'Er was niets te wijzigen!');
                    break;
            }
        }
    }

    private function bekijkenAction() {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker', $gebruiker);
        $this->view->set('klassen', $this->model->getKlassen());

        if($gebruiker->getRecht() === 'leerling') {
            $this->view->set('mijn_klas', $this->model->getKlasByLeerling($gebruiker->getId()));
        }
    }

    private function wijzigenAction() {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker', $gebruiker);
        $this->view->set('klassen', $this->model->getKlassen());

        if(!$this->model->isPostLeeg()) {
            switch($this->model->wijzigGegevens($gebruiker->getId())) {
                case REQUEST_SUCCESS:
                    $this->view->set('boodschap', 'Wijziging gelukt!');
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set('boodschap', 'De gegevens waren incompleet. Vul compleet in!');
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set('boodschap', 'Er was niets te wijzigen!');
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set('boodschap', 'Fout Invoer');
                    break;
            }
        } else {
            $this->view->set("boodschap","Wijzig hier je gegevens");
        }
    }

    public function klasDetailsAction() {
        if(!empty($_GET['kid'])) {
            $id = intval($_GET['kid']);
            $gebruiker = $this->model->getGebruiker();
            $this->view->set('klas1', $this->model->getKlasById($id));
            $this->view->set('mentor', $this->model->getMentor($id));
            $this->view->set('klasgenoten', $this->model->getLeerlingen($id));
            $this->view->set('gebruiker', $gebruiker);
            $this->view->set('klassen', $this->model->getKlassen());
        }
    }

    public function leerlingDetailsAction() {
        if(!empty($_GET['lid'])) {
            $id = intval($_GET['lid']);
            $gebruiker = $this->model->getGebruiker();
            $leerling = $this->model->getLeerlingById($id);
            $isMentor = $this->model->isMentor($gebruiker->getId(), $leerling->getKlas_id());

            if(!$this->model->isPostLeeg()) {
                switch($this->model->wijzigOpmerking($leerling->getId())) {
                    case REQUEST_SUCCESS:
                        $this->view->set('boodschap', 'Wijziging gelukt!');
                        break;
                    case REQUEST_FAILURE_DATA_INCOMPLETE:
                        $this->view->set('boodschap', 'De gegevens waren incompleet. Vul compleet in!');
                        break;
                    case REQUEST_NOTHING_CHANGED:
                        $this->view->set('boodschap', 'Er was niets te wijzigen!');
                        break;
                    case REQUEST_FAILURE_DATA_INVALID:
                        $this->view->set('boodschap', 'Fout Invoer');
                        break;
                }
            } elseif ($isMentor) {
                $this->view->set("boodschap","Voeg hier een opmerking voor een leerling");
            }

            $this->view->set('leerling', $leerling);
            $this->view->set('gebruiker', $gebruiker);
            $this->view->set('isMentor', $isMentor);
            $this->view->set('klassen', $this->model->getKlassen());
        }
    }
}
