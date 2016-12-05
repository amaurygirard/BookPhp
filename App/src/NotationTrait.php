<?php

trait NotationTrait{

  public function getNote()
  {
      return $this->note;
  }

  public function setNote($note)
  {
      if ($note < 0 || $note > 20){
        throw new Exception('La note doit être comprise entre 0 et 20');
      }

      $this->note = $note;

      return $this;
  }

}
