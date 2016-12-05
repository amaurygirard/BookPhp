<?php

class Edition extends MetaData {

  protected static $idCounter = 0;

  protected $id;
  protected $nom;
  protected $activite;
  protected $createDate;
  protected $note;

  /**
  *
  * CONSTRUCTEUR
  *
  */

  public function __construct($nom, $activite, $adresse, $cp, $pays, $siret, $createDate = 'now', $note = 10) {

    $this->setId();

    $this->setNom($nom)
      ->setActivite($activite)
      ->setCreateDate($createDate)
      ->setNote($note);

    parent::__construct($adresse, $cp, $pays, $siret, $createDate);

  }

  /**
  *
  * GETTERS & SETTERS
  *
  */

  // id
  use IdTrait;

  // nom
  public function getNom()
  {
      return $this->nom;
  }

  public function setNom($nom)
  {
      $this->nom = $nom;

      return $this;
  }

  // activite
  public function getActivite()
  {
      return $this->activite;
  }

  public function setActivite($activite)
  {
      $this->activite = $activite;

      return $this;
  }

  // createDate
  public function getCreateDate()
  {
      return $this->createDate;
  }

  public function setCreateDate($createDate)
  {
      $this->createDate = new DateTime($createDate);

      return $this;
  }

  // note
  use NotationTrait;

  /**
  *
  * METHODES
  *
  */


}
