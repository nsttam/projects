<?php
$page = __FILE__;
include "./header.php";
include "./navbar.php";
//Affichage nom du fichier
echo "fichier: $page";
echo "</br>";
//Affichage nom
echo "<h6>Tamara Ravagnan</h6>";

//Affichage date actuel
$today = date("F j, Y");
echo "Date: ". $today;

//Declaration tableau months
$months = array ();
$temp = array ();

// //Boucle pour generer et inserer les 12 mois dans le tableau
//     for($i=1; $i<13; $i++){
//         array_push($months, date('F', mktime(0, 0, 0, $i, 10)));
//     }
//
//
// //Boucle pour generer et inserer données temperature dans le tableau temp
//
//     for($i=1; $i<13; $i++){
//         array_push($temp, rand(-10,30));
//     }


// //Boucle pour simplifier et avoir les deux boucles precedents ensemble

    for($i=1; $i<13; $i++){
       array_push($months, date('F', mktime(0, 0, 0, $i, 10)));
       array_push($temp, rand(-10,30));
   }

//var_dump($months);
//var_dump($temp);


echo "</br>";
echo "</br>";


//Fonction anonyme pour afficher le numero de mois en lettres
$monthName = function (int $x){
    echo date('M', mktime(0, 0, 0, $x, 10));
};

//On affiche le resultat de la foncion anonyme pour les valeurs $x=3 et $x=9
echo "<h6>Months from Anonymous Function</h6>";
$monthName(3);
echo "</br>";
$monthName(9);
echo "</br></br>";

//Fonction anonyme pour generer des mois comme bouton radio
$monthNameButton = function (int $x){
  echo '<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio'.$x.'" value="'.$x.'">
        <label class="form-check-label" for="inlineRadio'.$x.'">'.date('M', mktime(0, 0, 0, $x, 10)).'</label>';
};

/*Comme dans ma function anonyme j'ai besoin de integer et pas de string, je cree un tableau monthsInt ou
j'auras les mois en numero entier*/
$monthsInt = array();
//j'insere dans mon tableau les mois de 1 a 12
for($i=1; $i<13; $i++){
    array_push($monthsInt, date('n', mktime(0, 0, 0, $i, 10)));
}
?>

<form method="post">
  <div class="form-check form-check-inline">

      <?php array_walk($monthsInt, $monthNameButton); ?>

      <button type="submit" class="btn btn-primary">Find Temp</button>'
  </div>
</form>

<?php

//Si on fait une choix pour un mois et on click sur bouton radio:
if ( isset($_POST['inlineRadioOptions'])) { //Si bouton radio a été choisi:

    echo $temp[$_POST['inlineRadioOptions']]; //On affiche la temperature pour le mois

} else {

     echo "Choose a month"; //Sinon, on demande à l'utilisateur de choisir un mois
 }


//Tableau 
echo'<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Index</th>
      <th scope="col">Month</th>
      <th scope="col">Temperature</th>
    </tr>
  </thead>
<tbody>';

   for ($i=0; $i < 12; $i++) {
     echo "
    <tr>
        <th scope='row'>".$i."</th>
        <td>".$months[$i]."</td>
        <td>".$temp[$i]."</td>
    </tr>";
 }


  echo'</tbody>
 </table>';






?>






<?php
include "./footer.php";
?>
