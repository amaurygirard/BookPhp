<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<?php

  include "App/src/DateFrInterface.php";
  include "App/src/NotationInterface.php";
  include "App/src/NotationTrait.php";
  include "App/src/IdTrait.php";

  include "App/src/MetaData.php";
  include "App/src/Book.php";
  include "App/src/Ecrivain.php";
  include "App/src/Edition.php";


  // création d'un éditeur
  try {
    $gallimard = new Edition('Gallimard', 'Un éditeur de livres très connu', '54 rue de la république', '69001', 'France', '215 236 214 00075', '3-2-1954', 17);
  }
    catch (Exception $e) {
      echo '<p style="color:red;">'.$e->getMessage().'</p>';
    }

  // création de livres
  try {
    $monLivre = new Book("autant en emporte le vent", "une belle histoire d'amour", 20.2, $gallimard, 1000, '02/20/1982', true);

    $hp = new Book('Harry Potter', 'une histoire de sorciers', 12.00, $gallimard, 500, '12/25/1995', true);}
  catch (Exception $e) {
    echo '<p style="color:red;">'.$e->getMessage().'</p>';
  }

  // création d'auteurs
  try {
    $jkrowling = new Ecrivain("JK Rowling", "jkr@gmail.com", "Oullins", "3 rue des bleuets", "69600", "France", "2 21547 25200025", "10/25/1966");

    $MargaretMitchell = new Ecrivain("Margaret Mitchell", "mm@gmail.com", "Orléans", '1 rue de la gare', "45 000", "France", "712 215 245 00023", "2/21/1926");
  }
  catch (Exception $e) {
    echo '<p style="color:red;">'.$e->getMessage().'</p>';
  }

  $monLivre->addWriter($MargaretMitchell);
  $hp->addWriter($jkrowling);
  $hp->addWriter($MargaretMitchell);

  // echo "<pre>";
  // var_dump($monLivre);
  // echo "</pre>";

  echo "<p>" . $MargaretMitchell->getNom() . " est née le " . $MargaretMitchell->formatDateFr() . " à " . $MargaretMitchell->formatTimeFr() . "</p>";

  echo "<p>Age de {$monLivre->getTitre()} : {$monLivre->ageDuLivre()} ans</p>";
  echo "<p>Age de {$hp->getTitre()} : {$hp->ageDuLivre()} ans</p>";
  // echo "<p>{$monLivre->isOlderThanSeventies()}</p>";
  // echo "<p>{$monLivre->prixFrancais()}</p>";
  // echo "<p>".$monLivre->shortenResumeWord(3)."</p>";

  echo "<p>Age moyen des livres de " . $MargaretMitchell->getNom() . " : ".$MargaretMitchell->ageMoyenBooks()." ans</p>";

  echo "<p>" . $jkrowling->getNom() . " attribue une note moyenne de " . $jkrowling->donneDesNotesAuxAutres($MargaretMitchell, 10, 19) . " aux livres de " . $MargaretMitchell->getNom() . "</p>";


?>
</body>
</html>
