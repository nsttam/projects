<?php
$page = __FILE__; //nom du fichier, balise reservéé
include "./header.php";
include "./navbar.php";
echo "<h3>fichier: $page</h3>";
var_dump ($page); //utile pour debuguer
var_dump ($_GET);

$a = 3;
$b = 2;

if ($a !== $b){
    echo "$a pas egal a $b";
} else {
    echo "$a egal a $b";
}

echo "<p>";

if (TRUE) {
    echo "c'est vrai";
} else{
    echo "c'est faux";
}

echo "</p>";


setlocale(LC_TIME, "fra_FRA");
$day = strftime('%A');  //POUR AFFICHER DATE DU JOUR
var_dump($day);

//Boucle pour afficher le jour de la semaine d'aujourd'hui
switch($day){
    case "lundi":
        echo "aujourd'hui c'est lundi";
        //break;


    case "Samedi":
        echo "aujourd'hui c'est samedi";
        break;

    case "Dimanche":
        echo "aujourd'hui c'est dimanche";
        break;

    default:
        echo "Aujourd'hui c'est un autre jour"; //mettre toujours DEFAULT

}

echo "</br>";

$a1 = "2";
$b1 = 2;

if ($a1 === $b1){
echo "$a1 and $b1 ==";
} else {
echo "$a1 and $b1 !==";
}

/*$C=0;
$D=0;

for ($i=0; $i<10; $i++){
   //si $i sup à 5, je sors de la boucle
   if ($i>5) break;
   echo "<br>$i -> $C";
   $C +=10;
   $D +=5;
}
echo "Ma variable C = $C";*/

echo "</br>";


//boucle avec break
for ($i=0; $i<10; $i++){
    if ($i>5){
    break;
    }

    echo "$i";

    }


//boucle dans une boucle
$i = 0;
$j = 0;
for ($j=0; $j <=5 ; $j++) {
 for ($i=0; $i <= 10; $i++) {
   if ($i >= 6 ) {
     break;
   }
   echo "<br>boucle 1 :  $i";
 }
 echo "<br>boucle 2 :  $j";
}

echo "</p>";


$i = 0;
$j = 0;
for ($j=0; $j <=5 ; $j++) {
 for ($i=0; $i <= 10; $i++) {
   if ($i >= 6 ) {
     break 2;
   }
   echo "<br>boucle 1 :  $i";
 }
 echo "<br>boucle 2 :  $j";
}

echo "</p>";

//Inserer valeurs de 1 a 12 dans un tableau
$i = 1;
$myArray = array ();
while ($i <= 12) {
  $myArray[] = $i;
  $i++;
}

var_dump ($myArray); //pour afficher tableau

//Pour melanger valeurs dans tableau
shuffle ($myArray);
// foreach ($myArray as $i) {
//   //echo "$i";
// }

var_dump ($myArray);

//pour compter elements
echo "il y a ". count($myArray)." elements";














include "./footer.php";
?>
