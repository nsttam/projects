<?php
$page = __FILE__; //nom du fichier, balise reservéé
include "./header.php";
include "./navbar.php";
echo "<h3>fichier: $page</h3>";
var_dump ($page); //utile pour debuguer
var_dump ($_GET);

var_dump ($_COOKIE["name"]);



echo "<h2>By value</h2>";
function by_val(int $x) {
   $x++;
   echo "<h6>\$x= $x into call</h6>";
}
$x = 1;

echo "<h6>\$x = $x before call</h6>";
by_val($x);
echo "<h6>\$x = $x after call</h6>";

echo "<h2>By ref</h2>";
function by_val2(int &$x) { //&$x n'est pas une copie de $x=1 //PASSAGE PAR REFERENCE //ON PRENDRE VARIABLE? PAS SON VALEUR
   $x++;
   echo "<h6>\$x= $x into call</h6>";
}
$x = 1;
echo "<h6>\$x = $x before call</h6>";
by_val2($x);
echo "<h6>\$x = $x after call</h6>"; // 2, parce que garde valeur qui sort de fx







echo "<br/>";
   echo "<br/>";

   $toto = function ($x){
       echo "Hello
       $x + 3";
   };
   //call the closure
   $toto(3);

   echo "<br/>";

   $toto = function ($y){
          echo "Hello " . ($y + 3);
      };
      //call the closure
      $toto(4);

    echo "<br/>";

    $toto = function ($x){
            echo ($x + 5);
          };
          //call the closure
          $toto(3);
          echo "<br/>";

          $tab = [1, 2 ,3];
          array_walk($tab, $toto);  //resultat 6 7 8

          echo "<br/>";




    $toto = function ($x){
    echo ($x + 5);
    };
    //call the closure
    $toto(3);
    echo "<br/>";
    echo "<br/>";
    // Je déclare un tableau avec 3 éléments
    $tab = [1, 2 ,3];
    // Execute la fonction pour chaque élément du tableau.
    array_walk($tab, $toto);

    // Sans le array_walk il faudrait faire :
    echo "<br/>";
    foreach($tab as $key => $value){
        echo $toto($value);
    }

    echo "<br/>";

    $abc = function ($name) {
        echo "<br/>".ucwords(strtolower($name));
    };
    $joueurs = ["tOtO", "titi", "TATA"];
    array_walk($joueurs, $abc);















include "./footer.php";
?>
