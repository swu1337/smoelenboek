<?php
namespace smoelenboek\models\db;

class Persoon {
    private $id;
    private $vnaam;
    private $tv;
    private $anaam;
    private $gebrnaam;
    private $ww;
    private $email;
    private $telnummer;
    private $foto;
    private $opmerkingen;
    private $adres;
    private $plaats;
    private $klas_id;
    private $recht;

    public function __construct() {
        $this->id = filter_var($this->id, FILTER_VALIDATE_INT);
        $this->klas_id = filter_var($this->klas_id, FILTER_VALIDATE_INT);
    }

    public function getId() {
        return $this->id;
    }

    public function getVoornaam() {
        return $this->vnaam;
    }

    public function getTussenvoegsel() {
        return $this->tv;
    }

    public function getAchternaam() {
        return $this->anaam;
    }

    public function getGebruikersnaam() {
        return $this->gebrnaam;
    }

    public function getWachtwoord() {
        return $this->ww;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefoon() {
        return $this->telnummer;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getOpmerkingen() {
        return $this->opmerkingen;
    }

    public function getAdres() {
        return $this->adres;
    }

    public function getPlaats() {
        return $this->plaats;
    }
    public function getKlas_id() {
        return $this->klas_id;
    }
    
    public function getRecht() {
        return $this->recht;
    }

    public function getNaam() {
        return $this->vnaam . " " . $this->tv . " " . $this->anaam;
    }
}
