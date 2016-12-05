<?php

class MetaData{

  protected static $everyInstanceOfClass = [];

  protected $adresse;
  protected $cp;
  protected $pays;
  protected $siret;
  protected $dateDebut;
  protected $latitude;
  protected $longitude;


  /**
  *
  * CONSTRUCTEUR
  *
  */

  public function __construct($adresse, $cp, $pays, $siret, $dateDebut = 'now') {

    $this->setAdresse($adresse)
      ->setCp($cp)
      ->setPays($pays)
      ->setSiret($siret)
      ->setDateDebut($dateDebut);

    array_push(self::$everyInstanceOfClass, $this);

  }


  /**
  *
  * GETTERS & SETTERS
  *
  */

  // adresse
  public function getAdresse()
  {
      return $this->adresse;
  }

  public function setAdresse($adresse)
  {
      $this->adresse = $adresse;

      return $this;
  }

  // cp
  public function getCp()
  {
      return $this->cp;
  }

  public function setCp($cp)
  {
      // vérifie le format du cp
      if (!preg_match('/[0-9][0-9a-z] ?[0-9]{3}/i', $cp)){
        throw new Exception('Le format du code postal n\'est pas valide');
      }

      $this->cp = $cp;

      return $this;
  }

  // pays
  public function getPays()
  {
      return $this->pays;
  }

  public function setPays($pays)
  {
      $this->pays = $pays;

      return $this;
  }

  // siret
  public function getSiret()
  {
      return $this->siret;
  }

  public function setSiret($siret)
  {
      // controle le format du siret
      if (!preg_match('/^(([0-9]{3} ?){3}[0-9]{5})|([0-9] [0-9]{5} [0-9]{8})$/', $siret)){
        throw new Exception('Le siret n\'est pas valide');
      }

      $this->siret = $siret;

      return $this;
  }

  // dateDebut
  public function getDateDebut()
  {
      return $this->dateDebut;
  }

  public function setDateDebut($dateDebut = 'now')
  {
      $this->dateDebut = new DateTime($dateDebut);

      return $this;
  }

  // latitude
  public function getLatitude()
  {
      return $this->latitude;
  }

  public function setLatitude($latitude)
  {
      $this->latitude = $latitude;

      return $this;
  }

  // longitude
  public function getLongitude()
  {
      return $this->longitude;
  }

  public function setLongitude($longitude)
  {
      $this->longitude = $longitude;

      return $this;
  }

  /**
  *
  * METHODES
  *
  */

  public function getDepartement(){
    return substr($this->cp, 0, 2);
  }

  public function isTurningDecade($decade){
    // vérifie si l'âge est bien un nombre
    if (!is_numeric($decade)){
      throw new Exception('Merci de rentrer un nombre en paramètre');
    }

    // calcule l'âge
    $age = ((time() - date_timestamp_get($this->dateDebut)) / 3600 / 24 / 365.25);

    // si l'âge est égal à 50, renvoie true
    return ($age == $decade) ? true : false;
  }

}
