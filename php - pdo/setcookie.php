<?php
$page = __FILE__; //nom du fichier, balise reservéé
include "./header.php";
include "./navbar.php";



//Creation cookie
    setcookie("name",	"Tamara Ravagnan",	time()+10,	"/","",	0);
    setcookie("age",	"31",	time()+10,	"/",	"",	0); //+10 temps en secondes que le cookie sera valable

    var_dump($_COOKIE);



























include "./footer.php";
?>
