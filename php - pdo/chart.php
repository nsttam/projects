<?php
  $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>
<!-- Formulaire pour inserer quantite des mois souhaite -->
<div class="container mb-5">
    <form method="post">
      <div class="form-group mt-2 text-center">
        <label for="inputMois">Nombre des mois à afficher</label>
        <input type="number" name="monthQuantity" class="form-control" id="mois" aria-describedby="moisHelp" placeholder="Inserez un nombre">
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>


<!-- On insere le graphique -->
<canvas id="myChart"></canvas>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> IL EST DANS LE FICHIER HEADER-->



<?php
$months = array ();
$datas = array ();
$currentMonth = date ('n');

//Boucle pour avoir les 12 mois, et une donnée par mois
// for($i=1); $i<=12; $i++){ //IMPORTANT
//     array_push($months, date('F', mktime(0, 0, 0, $i, 10)));
//     array_push($datas, rand(-20,45));
// }

//On repile à la fin du tableau tous les mois avant le mois actuel
// for($i=1; $i<$currentMonth; $i++){ //IMPORTANT
//     // array_push($months, date('F', mktime(0, 0, 0, $i, 1)));
//     // array_push($datas, rand(-20,45));
//     $month = array_shift($months); //month stock la premiere valeur de months
//     array_push($months, $month);
//
//     array_push($datas, array_shift($datas)); // meme que faire de la façon comme on a fait $month..//il fait d'abord array_shift, puis array_push
// }

if ( isset($_POST['monthQuantity']) && $_POST['monthQuantity'] != ''){ //Si
  for($i=1; $i<=12; $i++){ //IMPORTANT
      array_push($months, date('F', mktime(0, 0, 0, $i, 1)));
      array_push($datas, rand(-20,45));
  }

//Je decale le tableau
  for($i=1; $i<$currentMonth; $i++){ //IMPORTANT
      // array_push($months, date('F', mktime(0, 0, 0, $i, 1)));
      // array_push($datas, rand(-20,45));
      $month = array_shift($months); //month stock la premiere valeur de months
      array_push($months, $month);
      array_push($datas, array_shift($datas)); //Para pasar el primer elemento de un tableau al final del mismo // meme que faire de la façon comme on a fait $month..//il fait d'abord array_shift, puis array_push
  }
  //Je enleve les elements innecesaires
  $nbPop = count($months) - intval($_POST['monthQuantity']);
  var_dump($nbPop);
  for($i=1; $i<=$nbPop; $i++){
    array_pop($months);
    array_pop($datas);
  }
}

















/////**********VERSION SIMPLIFIE******************//
// $months= [];
// $datas= [];
//
// for ($i=1; $i<=12; $i++){
//    //afficher les mois en dur pour la graphique
//    array_push($months, date('F', mktime(0, 0, 0, $i, 1)));
//    array_push($datas, rand(-20, 30));
// }
//
// $numMois = date("n");
// for($i=1; $i< $numMois; $i++){
//   //Première méthode en deux lignes.
//   $month = array_shift($months);
//   array_push($months,$month);
//
//   //Deuxième méthode en deux lignes et mise à jour des datas.
//   //on enlève la première du tableau et on la réinsère à la fin
//    array_push($datas,array_shift($datas));
//
// }
//
// if (isset($_POST['nbMois']))
// {
//    //valeur que le user a entré dans le formulaire
//    $nbMoisUser= $_POST['nbMois'];
//    //si l'utilisateur n'a rien rentré dans le formulaire
// } else{
//    $nbMoisUser=12;
// }
//
// for ($nbMois=12; $nbMois>$nbMoisUser;$nbMois--){
//    //enlever un mois a chaque fin de tableau
//    array_pop($months);
//    array_pop($datas);
// }

///////////****FIN VERSION SIMPLIFIE***///////////

// $month = array_shift($months); //month stock la premiere valeur de months
// array_push($months, $month);
//function calculer mois actuel (4) - faire boucle mettre janver a la fin pour arriver a avoir le premier mois avril

//EXEMPLE
// $numMois = date("n");
// var_dump($numMois);
// for($i=1; $i< $numMois; $i++){
//    //Première méthode en deux lignes.
//    //$month = array_shift($labels);
//    //array_push($labels,$month);
//
//    //Deuxième méthode en deux lignes et mise à jour des datas.
//    array_push($labels,array_shift($labels));
//    array_push($datas,array_shift($datas));
//
// }



// ***********************CODE ROMAIN AVEC GET********************
// //$arrayMonth = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
// //$arrayData = [2, 3, 13, 29, 48, 3, 7];
// $labels = [];
// $datas = [];
//
// for ($i=1; $i <= 12 ; $i++){
//    array_push($labels, date('F', mktime(0, 0, 0, $i, 10)));
//    array_push($datas, rand(-45, 45));
// }
//
// $numMois = date("n");
// var_dump($numMois);
// for($i=1; $i< $numMois; $i++){
//    //Première méthode en deux lignes.
//    //$month = array_shift($labels);
//    //array_push($labels,$month);
//
//    //Deuxième méthode en deux lignes et mise à jour des datas.
//    array_push($labels,array_shift($labels));
//    array_push($datas,array_shift($datas));
//
// }
// ?>
<!-- // <html>
//
// <head>
//    <title>Sending HTML email using PHP</title>
// </head>
//
// <body>
//
// <form>
//    <div class="form-group">
//        <label for="exampleInputPassword1">Nombre de mois</label>
//        <input name="numberOfMonth" type="number" class="form-control" id="exampleInputPassword1" placeholder="Entrez un nombre de mois">
//    </div>
//    <button type="submit" class="btn btn-primary">Ok</button>
// </form>
//  -->
// <?php
// if($_GET['numberOfMonth']){
//    $nmbMonthUser = $_GET['numberOfMonth'];
// }else{
//    $nmbMonthUser = 12;
// }
// for($i=12; $i>$nmbMonthUser; $i--){
//    array_pop($labels);
//    array_pop($datas);
// }
//
// ?>
//
// <canvas id="myChart"></canvas>
//
// <script>
//    var ctx = document.getElementById('myChart').getContext('2d');
//    var chart = new Chart(ctx, {
//        // The type of chart we want to create
//        type: 'radar',
//
//        // The data for our dataset
//        data: {
//            labels: <?php echo json_encode($labels); ?>,
//            datasets: [{
//                label: 'My First dataset',
//                backgroundColor: 'rgb(20, 180, 0)',
//                borderColor: 'rgb(2, 99, 12)',
//                data: <?php echo json_encode($datas); ?>
//
//            }]
//        },
//
//        // Configuration options go here
//        options: {}
//    });
//
//
// </script>

?>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: <?php echo json_encode($months); //json_encode pour transformer php en js?>,
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?php echo json_encode ($datas); ?>
            }]
        },

        // Configuration options go here
        options: {}
    });
</script>









</div>





















<?php
    include "./footer.php";
?>
