<?php
$page = __FILE__; //nom du fichier, balise reservéé
include "./header.php";
include "./navbar.php";
echo "<h3>fichier: $page</h3>";
var_dump ($page); //utile pour debuguer
var_dump ($_GET);
?>
<?php

// function isMajeur($age){
//   return $age >= 18;
// }

// $results = isMajeur (15);
// var_dump($results);

//function isMajeur (int $age): bool{
  //return $age >=18;
//}


//var_dump(isMajeur(22));

//FONCTION AVEC IF ET ELSE - example bien indente

// function isMajeur (int $age): string{ //string au lieu du boolean
//   if($age>=18){
//     return "Je suis majeur";
//   } else {
//     return "Je suis mineur";
//   }
// }
//
// echo "age = 20" . " " . isMajeur(20);

// function isMajeur (int $age, string $pays = 'fr'): bool{
//   if($pays == 'usa'){
//     return $age >= 16;
//   } else {
//     return $age >=18;
//   }
// }
//
// var_dump(isMajeur(19, 'fr')); //true
// var_dump(isMajeur(15, 'usa')); //false


// function isMajeurString (int $age, string $pays): string{
//       switch ($pays){
//         case 'france':
//             if($age >= 18){
//               return "A $age ans vous etes majeur à $pays";
//             } else {
//               return "A $age ans vous etes mineur à $pays";
//             }
//        case 'usa':
//             if($age >=21){
//               return "A $age ans vous etes majeur à $pays";
//             } else {
//               return "A $age ans vous etes mineur à $pays";
//             }
//       case 'japon':
//             if ($age >=18){
//               return "A $age ans vous etes majeur à $pays";
//             } else {
//               return "A $age ans vous etes mineur à $pays";
//             }
//      default:
//             if ($pays == ''){
//                return "Merci de donner un paramètre";
//              } else {
//               return "Ce pays : $pays n'existe pas";
//               break;
//             }
//       }
// }
//
//     var_dump(isMajeurString(17, ''));
//     var_dump(isMajeurString(17, 'france'));
//     var_dump(isMajeurString(25, 'usa'));
//
//
//     function isMajeurBool (int $age, string $pays = 'fr'): bool{
//       if($pays == 'usa'){
//         return $age >= 16;
//       } else {
//         return $age >=18;
//       }
//     }
//
//     // "? A : B" renvoi un booléen.
//   // A renvoi la valeur True.
//   // B renvoi la valeur false.
//   //Decla de la variable
//     $age = 17;
//
//     $majeur = isMajeurBool($age, "france") ? "Adulte":"Enfant"; // si isMajeur true, adulte. Sinon, Enfant
//     echo $majeur;
//
//     echo "</br>";
//
//     $majeur = isMajeurBool($age, 'usa') ? 'Adulte':'Enfant';
//
//     //EQUIVALENT A CODIGO ENCIMA DE ESTE
//     // if (isMajeur($age,'usa')){
//     //   $majeur='Adulte';
//     // }
//     // else{
//     //   $majeur = 'Enfant'
//     // }
//
//
//     echo $majeur;
//
// //CALCULE PUISSANCE NUMERO
//     // function nbCarre(int $numero):int{
//     //   return $numero*$numero;
//     // }
//
//     // var_dump (nbCarre(2));
//
//     //OU
//
//     function nbCarre(int $numero):int{
//       $a = $numero*$numero;
//       echo "$numero, sa puissance est $a";
//       return $a;
//     }
//
//       var_dump (nbCarre(2));
//
//    // $nbr = $_GET["nombre"]; //je le donne valeur a "nombre"dans l'url http://localhost/public/fonctions.php?nombre=3
//    function racineCarre (float $Arg_nbr) : float{
//      return sqrt ($Arg_nbr); //square root
//    }
//
//    // var_dump (racineCarre (65));
//    var_dump (racineCarre($_GET["nombre"])); // ou var_dump (racineCarre());
//
//    //Sino seulement
//    echo sqrt ($_GET["nombre"])
//
//    //methode=post pour recuperer $_post
//    //function lacerMajeur recupere age et pays a partir de name de champ dans formulaire
?>


<!-- Formulaire -->
<div class="container p-3 mb-2 bg-secondary text-white text-center" >
  <form method="post">
    <div class="form-group">
      <label for="insertNumber" class = "font-weight-bold">Puissance Nombre</label>
      <input type="number" name="valeur" class="form-control" placeholder="Inserez nombre ">
    </div>
    <button type="submit" class="btn btn-danger">Envoyer</button>
  </form>




<?php
//function calcule puissance
function puissance(int $valeur):int{
  return $valeur*$valeur;
  }
//si nombre insere dans formulaire et different ''
if ( isset($_POST['valeur']) && $_POST['valeur'] != '') {
  //affiche
    echo "le resultat est: " . puissance( (int)$_POST['valeur']); //php transforme int ou float en string pour concatener
    } else {
    echo "Veuillez entrer un nombre.";
}







 ?>
</div>























<?php
include "./footer.php";
?>
