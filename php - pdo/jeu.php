<?php
$page = __FILE__; //nom du fichier, balise reservéé
include "./header.php";
include "./navbar.php";
echo "<h3>fichier: $page</h3>";
var_dump ($page); //utile pour debuguer
var_dump ($_GET);
?>

<!-- $card = 1;
$valueCards = array (2, 3, 4, 5, 6, 7, 8, 9, 10, 'J', 'Q', 'K', 'A');
$typeCards = array ('♠', '♥', '♦', '♣');
$players = array ('player 1', 'player 2', 'player 3', 'player 4' )

$cards = array();
foreach ($valueCards as $valueCard) {
			foreach ($typeCards as $typeCard) {
				$cards[] = $valueCard . $typeCard;
			}
		}
  var_dump ($cards);
//melanger les cartes
  shuffle($cards);

  //creation de jouers
  players = [];
  players = [];

echo "<h5>Player 1</h5>";
$playerRandomCards = array_rand($cards, 5);

foreach ($playerRandomCards as $playerRandomCard){
  $cards[] = $playerRandomCard;
}

var_dump ($playerCards);

echo "<h5>Joueur 2</h5>";

echo "<h5>Joueur 3</h5>";

echo "<h5>Joueur 4</h5>";

 -->

 <?php

    $signs = ["♣","♥","♦","♠"];
    $values = ["Deux","Trois","Quatre","Cinq","Six","Sept","Huit","Neuf","Dix","Valet","Dame","Roi","As"];
    $points = [2,3,4,5,6,7,8,9,10,11,12,13,14];
    $deck = [];
    //CREATION DES CARTES
    // Boucle des signes
    for ($sign=0; $sign < count($signs); $sign++) {
       // Boucle des valeurs
       for ($value=0; $value < count($values); $value++) {
         //Création tableau
          $deck[] = array(
             $values[$value],
             $signs[$sign],
             $points[$value] //quantite de values = quantite de points
          );
       }
    }

    var_dump($deck);

    for ($i=0; $i < 2; $i++) { //car on a deux cartes joker

     $deck[] = array(
         "Joker",
         "☺",
         15
      );

    }

    shuffle($deck);

    //Création des joueurs
    $playerNames = ['Romain','Greg nul','Som','Roland'];
    foreach ($playerNames as $playerName) {
        //Chaque joueur a un [] de cartes
     $playersCards[$playerName] = array(); //$playerName key pour $playerCards?
     $sums[$playerName] = 0; ////$playerName key pour $sums?
    }

    //Distribution des cartes
    for ($tour=0; $tour < 4; $tour++) {
        // array push ajoute la carte au joueur / pop retirer la carte du deck et la retourne
        //array_push(tableau, variable);

                     //Méthode 1
                     // $carte = array_pop($deck);
                     // array_push($playersCards[0], $carte);

                     // array_push($playersCards[1], array_pop($deck)); //Tomo carta de deck y la meto en cartas jugador
                     // array_push($playersCards[2], array_pop($deck));
                     // array_push($playersCards[3], array_pop($deck));

                     //Méthode 2
                     // for ($player=0; $player < count($playersCards); $player++) {
                     //     array_push($playersCards[$player], array_pop($deck));
                     // }

         foreach ($playersCards as $key => $player) {
             array_push($playersCards["$key"], array_pop($deck)); //enleve
         }
    }
    var_dump($playersCards);
    // count(deck) , compte le nombre d'elements dans le tableau
    echo "Il reste " . count($deck) . " cartes";
    echo "<div class='row'>";
    // On crée la somme de points des joueurs en parcourant leur cartes

     //Boucle d'affichage des cartes
     //POur chaque joueur on recupere chaque main
     foreach ($playersCards as $key => $playerHand) {
         echo "<div class='col-md-2 text-center'>";
         echo "Joueur ". $key;


         //Pour chaque main je recupere chaque cartes
         foreach ($playerHand as $card) {
             //Affichage 'nom' et 'symbol'
             echo "<p> $card[0]  $card[1] $card[2] </p>"; //card[0]=nom carte,card[1]= signe card[2]=valeur
             $sums[$key] += $card[2];
         }

         var_dump($playersCards);
         echo "</div>'";
     }
     echo "</div>'";
     // affichage des sommes
     foreach ($sums as $key => $sum) {
         echo "<p class='m-2'>Joueur  $key :  $sum </p>";
     }
     var_dump($sums["Som"]);

//pour comprendre utilite de key
     $a=["a","b"];
     foreach ($a as $key => $value) {
       echo "<br>key=$key and value=$value";
       // code...
     }
     var_dump($a);
     $b=array_flip($a);
     var_dump($b);


     $table[$playerNames] = array(); //on a une table pour chaque joueur
     foreach ($playerNames as $playerName){
       foreach ($playerHand as $card){
         array_push($table, array_pop($deck));


       }
     }

     var_dump($table)






 ?>
























<?php
include "./footer.php";
?>
