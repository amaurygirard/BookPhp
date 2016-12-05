<?php

class Ecrivain extends MetaData implements DateFrInterface, NotationInterface {

  protected static $idCounter = 0;
  protected static $moyenneNote;

  const LIVRESMAX = 10;

  protected $id;
  protected $nom;
  protected $email;
  protected $ville;
  protected $collection = [];
  protected $note;

  /**
  *
  * CONSTRUCTEUR
  *
  */

  public function __construct($nom, $email, $ville, $adresse, $cp, $pays, $siret, $dateDebut = 'now') {

    $this->setId();

    $this->setNom($nom)
      ->setEmail($email)
      ->setVille($ville);

    parent::__construct($adresse, $cp, $pays, $siret, $dateDebut);

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

  // email
  public function getEmail()
  {
      return $this->email;
  }

  public function setEmail($email)
  {
    // regex pour valider l'email de l'écrivain
      if (!preg_match('/^[a-z0-9\.\-\_]+@[a-z0-9\.\-\_]+\.[a-z]{2,}$/i', $email)){
        throw new Exception('Le format de l\'email n\'est pas correct');
      }

      $this->email = $email;

      return $this;
  }

  // ville
  public function getVille()
  {
      return $this->ville;
  }

  public function setVille($ville)
  {
      $this->ville = $ville;

      return $this;
  }

  // collection
  public function getCollection()
  {
      return $this->collection;
  }

  public function setCollection($collection)
  {
      $this->collection = $collection;

      return $this;
  }

  // note
  use NotationTrait;

  /**
  *
  * METHODES
  *
  */

  // pour ajouter un nouveau livre à la collection
  public function addBookToCollection(Book $book){
    if (count($this->collection) >= self::LIVRESMAX){
      throw new Exception('Le nombre maximum de ' . self::LIVRESMAX . 'livres a déjà été atteint pour ' . $this->nom);
    }

    array_push($this->collection, $book);
  }

  // pour supprimer un livre de la collection
  public function deleteBookFromCollection(Book $book){
    $ind = array_search($book, $this->collection);
    array_splice($this->collection, $ind, 1);
  }

  // ajouter un livre à la vente
  public function mettreEnVenteBook(){
    foreach(func_get_args() as $book){
      // vérifie que les arguments soient des instances de Book
      if (!is_a($book, Book)) {
        throw new Exception('Cette fonction n\'accepte que des instances de Book en arguments');
      }

      // autorise la vente en passant le paramètre aVendre à true
      $book->setAVendre(true);
    }
  }

  // retirer un livre de la vente
  public function retirerDeLaVenteBook(){
    foreach(func_get_args() as $book){
      // vérifie que les arguments soient des instances de Book
      if (!is_a($book, Book)) {
        throw new Exception('Cette fonction n\'accepte que des instances de Book en arguments');
      }

      // retire de la vente en passant le paramètre aVendre à false
      $book->setAVendre(false);
    }
  }

  // retourne l'âge moyen des livres de l'écrivain courant
  public function ageMoyenBooks(){
    $tousLesAges = [];
    foreach($this->collection as $book){
      array_push($tousLesAges, $book->ageDuLivre());
    }
    return (array_sum($tousLesAges) / count($tousLesAges));
  }

  // change le prix et l'édition d'un livre
  public function changeBookEditionPrix(Book $book, $prix, Edition $edition){
    // vérifie que l'écrivain ait droit de modification sur le livre
    if (!in_array($book, $this->collection)){
      throw new Exception('Un écrivain ne peut pas modifier les attributs d\'un livre qui n\'est pas le sien');
    }

    // change le prix
    $book->setPrix($prix);

    // change l'édition
    $book->setEdition($edition);

    // change la date de modification à maintenant
    $book->setDateModified();

  }

  // un écrivain peut léguer sa collection à un autre écrivain
  public function leguerSaCollectionA(Ecrivain $ecrivain){
    foreach($this->collection as $book){

      // on vérifie que le livre ne soit pas déjà dans la collection de l'écrivain destinataire
      if (!in_array($book, $ecrivain->getCollection())){
        // ajoute le livre à l'écrivain destinataire
        $ecrivain->addBookToCollection($book);

        // retire le livre de l'écrivain expéditeur
        $this->deleteBookFromCollection($book);
      }
    }
  }

  // pour formater la date en français
  public function formatDateFr(){
    return $this->dateDebut->format('d/m/Y');
  }

  // pour formater l'heure en français
  public function formatTimeFr(){
    return $this->dateDebut->format('H\hi');
  }

  // donne des notes aux livres des autres auteurs
  public function donneDesNotesAuxAutres(Ecrivain $ecrivain){
    // récupère tous les arguments passés dans la fonction
    // et enlève le premier, qui est un objet
    $mesNotes = func_get_args();
    array_splice($mesNotes, 0, 1);

    // attribue les notes aux livres par ordre d'index
    for($i = 0; $i < count($mesNotes); $i++){
      $ecrivain->getCollection()[$i]->setNote($mesNotes[$i]);
    }

    // retourne la moyenne des notes
    return (array_sum($mesNotes) / count($mesNotes));

  }

}
