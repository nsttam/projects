<?php
/**
 * Created by PhpStorm.
 * User: HB
 * Date: 03/04/2019
 * Time: 09:26
 */

	$data = [];

	for($i = 1; $i <= $_GET['nb_month']; $i++){
		$month = date('F', mktime(0, 0, 0, $i, 10));
		$temp = rand(-20,40);
		$array = array('month' => "$month", 'temp' => "$temp");
		array_push($data, $array);
	}

	echo json_encode($data);
    //COMENTAIRES TOUJOUS DANS LA BALISE PHP, avant fermeture balise
    // $data = array(); // on cree variable data de type array
    // for ($i = 1; $i <= $_GET['nbmonths']; $i++) { //$_GET['nbmonths'] on recupere le nombre de mois
    //     $month = date('F', mktime(0, 0, 0, $i, 10)); //recupere mois actuel
    //     $temp = rand(-20,40);
    //     $array = array('month' => "$month", 'temp' => "$temp"); //tableau ou je mets months et temp
    //     array_push($data, $array);
    // }
    //
    // //var_dump($data); //http://localhost/public/api/randchart_getjson.php?nbmonths=4 on affiche array
    //  echo json_encode($data); //pour afficher en json // on le vois bien grace a json viewer extension en navegador -->
?>
