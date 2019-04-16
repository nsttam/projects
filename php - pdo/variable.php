<?php
$page = __FILE__;
include "./header.php";
include "./navbar.php";
echo "fichier: $page";
var_dump ($page); //utile pour debuguer
var_dump ($_GET);

$var1 = 4;
var_dump ($var1); //pour voir type variable de var1
$var2 = "5";
//echo $var1 + $var2;
var_dump ($var2);

$var3 = $var1 + $var2;
var_dump ($var3); //resultat est 9, 4+5. meme si on a mis 5 comme chaine, php le prends comme number car il y a +

$var4 = $var1 . $var2;
var_dump ($var4); //le resultat est 45, car concatenation de chaine de carcteres, tranforme number en string


$array = [];
  $sum = 0;
  for ($i=0; $i < 100; $i++) { //$i+=2, affiche 0,2,4 etc
      $array[] = $i;
  }
  foreach ($array as $var) {
    if ($var % 10 === 0) {
          echo "<br>";
    }
    echo "<span class='text-primary'>$var</span>" . " ";
    $sum += $var;
  }
  echo "<p>$sum</p>";



include "./footer.php";
?>
