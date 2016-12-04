<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<?php

  include "App/Book.php";

  $monLivre = new Book("autant en emporte le vent", "une belle histoire d'amour", 20.2, "Gallimard", 1000, '02/20/1982', true);

  echo "<pre>";
  var_dump($monLivre);
  echo "</pre>";

  echo "<p>{$monLivre->ageDuLivre()}</p>";
  echo "<p>{$monLivre->isOlderThanSeventies()}</p>";
  echo "<p>{$monLivre->prixFrancais()}</p>";
  echo "<p>".$monLivre->shortenResumeWord(3)."</p>";

/**
* Révisions
*/
// + Créer une classe Book avec pour attributs:
//
//   - id (auto incrémentéé quand on créer un book)
//   - titre
//   - resume
//   - prix (nb à virgule)
//   - edition
//   - nbPag
//   - date de rédaction
//   - ecrivains (tableau d'Humain vide par défaut)
//   - dispo à la vente (par defaut false)
//
//   + Créer une méthode qui permet de formatter le titre les espaces remplacer par des tirets et juste la 1ere lettre en majuscule
//   + Créer un compteur qui comptera le nombre de livre crée
//   + Créer un moyen de stocker le prix moyen des livres crées
//   + Créer une méthode permettant de calculer l'age du livre à parti de sa date de création
//   + Créer une méthode qui dit si oui ou non ce livre a été écris entre 1970 et aujourd'hui
//   + Créer une methode qui formatera le prix à un format français 000 000,00 €
//   + Créer une méthode qui permet de tronquer le resumé par rapport au nb de mot voulu( Bonus: on tronquera au mot pret...)
//   + Créer une méthode permettant de retourner le nombre d mot que comporte le titre
//   + Créer une méthode qui permet de dire si le livre est un gros livre (nb page > 400), moyen (200 à 400), petit : moin de 200 pages
//   + Créer une méthode permettant d'ajouter un humain ou de supprimer un humain parmis la liste d'écrivain



?>
</body>
</html>
