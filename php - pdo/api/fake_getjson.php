<?php
$data = [];

//BOUCLE POUR AFFICHER 3 NOMS
for($i = 1; $i <= 3; $i++){

  $name = htmlspecialchars(stripslashes(file_get_contents('http://faker.hook.io/?property=name.lastName&locale=fr')));
  //parce qu'il y a des characteres especiaux qui s'affichent avec le nom
  $name = preg_replace('/[^a-zA-Z0-9"]/', '', $name);
  $name = preg_replace('[quot]', '', $name);
  //je declare que la key de l'array sera 'name' pour avoir, par example name:rodriguez
  $array = array('name' => "$name");
  //Je mets donnes d'array dans tableau data
  array_push($data, $array);
}

echo json_encode($data);


//BOUCLE MATEO********************
// $data = [];
//
//         //Le nb_name est récupéré depuis le formulaire dans faker.php après avori transité par le fake.js
//         for($i = 1; $i <= $_GET['nb_name']; $i++) {
//
//             $name = htmlspecialchars(stripslashes(file_get_contents('http://faker.hook.io/?property=name.lastName&locale=fr')));
//
//            $name = preg_replace('/[^a-zA-Z0-9"]/', '', $name);
//
//            $name = preg_replace('[quot]', '', $name);
//
//            $array = array('name' => "$name");
//
//             array_push($data, $array);
//
//         }
//
//
//     echo json_encode($data);

?>
