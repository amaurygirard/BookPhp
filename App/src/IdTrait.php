<?php

/**
 * Génère les ID des instances de classes utilisant le trait
 * Nécessite attribut statique $idCounter et attribut d'objet $id
 */

trait IdTrait {

  public function getId(){
    return $this->id;
  }

  public function setId(){
    self::$idCounter++;
    $this->id = self::$idCounter;
  }

}
