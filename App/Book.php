<?php

class Book {

  protected static $idCounter = 0;
  protected static $bookCounter = 0;
  protected static $bookLibrary = [];

  protected $id;
  protected $titre;
  protected $resume;
  protected $prix;
  protected $edition;
  protected $nbPag;
  protected $dateRedac;
  protected $ecrivains = [];
  protected $aVendre;

  /**
  *
  * CONSTRUCTEUR
  *
  */

public function __construct($titre, $resume, $prix, $edition, $nbPag, $dateRedac, $aVendre = false){

  $this->setId();
  $this->setTitre($titre);
  $this->setResume($resume);
  $this->setPrix($prix);
  $this->setEdition($edition);
  $this->setNbPag($nbPag);
  $this->setDateRedac($dateRedac);
  $this->setAVendre($aVendre);

  // incrémente le compteur de livres créés
  self::$bookCounter++;

  // ajoute le nouveau livre au tableau d'instances Book
  array_push(self::$bookLibrary, $this);

}


  /**
  *
  * GETTERS & SETTERS
  *
  */

  //id
  public function getId(){
    return $this->id;
  }

  public function setId(){
    self::$idCounter++;
    $this->id = self::$idCounter;
  }

  // titre
  public function getTitre(){
    return $this->titre;
  }

  public function setTitre($titre){
    // remplace les espaces par des _ et met la première lettre en majuscule
    $titreFormate = ucfirst(preg_replace('/\ /', '_', $titre));

    $this->titre = $titreFormate;
  }

  // resume
  public function getResume(){
    return $this->resume;
  }

  public function setResume($resume){
    $this->resume = $resume;
  }

  // prix
  public function getPrix(){
    return $this->prix;
  }

  public function setPrix($prix){
    // si le nombre n'est pas décimal
    if (!is_float($prix)){
      throw new Exception('Le prix doit être un nombre décimal');
    }

    $this->prix = $prix;
  }

  // edition
  public function getEdition(){
    return $this->edition;
  }

  public function setEdition($edition){
    $this->edition = $edition;
  }

  // nbPag
  public function getNbPag(){
    return $this->nbPag;
  }

  public function setNbPag($nbPag){
    $this->nbPag = $nbPag;
  }

  // dateRedac
  public function getDateRedac(){
    return $this->dateRedac;
  }

  public function setDateRedac($dateRedac){
    $this->dateRedac = new DateTime($dateRedac);
  }

  // ecrivains
  public function getEcrivains(){
    return $this->ecrivains;
  }

  public function setEcrivains(array $ecrivains){
    $this->ecrivains = $ecrivains;
  }

  // aVendre
  public function getAVendre(){
    return $this->aVendre;
  }

  public function setAVendre($aVendre){
    $this->aVendre = $aVendre;
  }

  /**
  *
  * METHODES STATIQUES
  *
  */

  public static function prixMoyenBooks(){
    $tousLesPrix = [];
    foreach($bookLibrary as $book){
      array_push($tousLesPrix, $book->prix);
    }
    return (array_sum($tousLesPrix) / count($tousLesPrix));
  }


  /**
  *
  * METHODES
  *
  */

  // quel est l'âge du livre
  public function ageDuLivre(){
    $age = ((time() - date_timestamp_get($this->dateRedac)) / 3600 / 24 / 365.25);
    return sprintf('%u', $age);
  }

  // est-ce que le livre a été écrit après 1970
  public function isOlderThanSeventies(){
    // retourne true si oui
    return (date_timestamp_get($this->dateRedac) >= 0) ? false : true;
  }

  // NE FONCTIONNE PAS SOUS WINDOWS
  // formate le prix à un format français
  // public function prixFrancais(){
  //   setlocale(LC_MONETARY, 'fr_FR');
  //   return money_format('%i', $this->prix);
  // }

  // ALTERNATIVE SOUS WINDOWS
  // formate le prix à un format français
  public function prixFrancais(){
    $prixFormate = number_format($this->prix, 2, ',', ' ');
    return sprintf('%s €', $prixFormate);
  }


  // tronque le résumé à 20 caractères
  public function shortenResumeChar(){
    return sprintf('%.20s...', $this->resume);
  }

  // tronque le résumé à 5 mots
  public function shortenResumeWord($nbMots){
    $tab = explode(' ', trim($this->resume), ($nbMots + 1));
    // le dernier élément du tableau est le reste de la chaîne de caractères
    // on l'enlève
    array_pop($tab);

    return implode(' ', $tab);

  }

  // donne le nombre de mots dans une chaîne de caractères
  public function howManyWords($string){
    return substr_count(trim($string));
  }

  // pour savoir si le livre est petit, moyen ou gros
  public function howBigIsTheBook(){
    if ($this->nbPag < 200){
      $taille = 'petit';
    }
    else if($this->nbPag > 400){
      $taille = 'gros';
    }
    else{
      $taille = 'moyen';
    }

    return $taille;
  }

  // pour ajouter un humain parmi la liste des auteurs
  public function addWriter(Humain $humain){
    array_push($this->ecrivains, $humain);
  }

  // pour supprimer un humain de la liste des auteurs
  public function removeWriter(Humain $humain){
    $ind = array_search($humain, $this->ecrivains);
    array_splice($this->ecrivains, $ind, 1);
  }
}
