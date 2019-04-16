<?php
$page = __FILE__;
include "./header.php";
include "./navbar.php";
?>


<?php
  // 1) specify your own database credentials
    $DB_PORT = '3306';
    $DB_HOST = 'localhost';
    $DB_USERNAME = 'root';
    $DB_PASSWORD = '';
    $DB_NAME ='testdrive';

// 2) get connection
    $mysqli = new mysqli("$DB_HOST:$DB_PORT", $DB_USERNAME, $DB_PASSWORD);
    if(!$mysqli){
        die("Connection failed: " . $mysqli->error);
    } else {
        print_alert("Connection to $DB_HOST:$DB_PORT OK", "success"); //print alert est fx dans fichier functiondb.php, on l'a ajouté dans le header
    }

    // 3) Create databasee
    $query = sprintf("CREATE DATABASE IF NOT EXISTS $DB_NAME");

    try {
        //execute query
        $result = $mysqli->query($query);
    ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success_alert">
            <?php echo "Database $DB_NAME created."?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php

    } catch (Exception $e) {
        //echo '<br>Exception received: ',  $e->getMessage(), "\n"; //e est messge d'erreur
        print_alert("Database $DB_NAME not created.", "danger"); //Fx sur fichier functonbd
    } finally {
    }
    $mysqli->close(); // pOUR SE DECONNECTER de bdd

    //4) Je me reconnecte a la bdd et a la database
    $mysqli = new mysqli("$DB_HOST:$DB_PORT", $DB_USERNAME, $DB_PASSWORD, $DB_NAME);//On ajoute nom bdd
    if(!$mysqli){
        die("Connection failed: " . $mysqli->error);
    } else {
        print_alert("Connection to $DB_HOST:$DB_PORT $DB_NAME OK", "success");
    }

    //5) Je drop ma table car
    $table = "car";
    $query = sprintf("DROP TABLE $DB_NAME.$table");
    try{
        //excute query
        $result = $mysqli->query($query);
        print_alert("Table $DB_NAME.$table dropped.", "success");
        //var_dump($result);
    } catch (Exception $e){
        //echo '<br>Exception received: ', $e->getMessage(), "\n";
        print_alert("Table $DB_NAME.$table not dropped." . $e->getMessage(), "danger");
    } finally {
        //echo "<br>Table $table created.";
    }



    //6) Je cree ma table
    $table = "car";
    $query = sprintf("  CREATE TABLE IF NOT EXISTS $DB_NAME.$table(
                            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            price DECIMAL(6,2) NOT NULL,
                            title VARCHAR(30) NOT NULL,
                            created_at TIMESTAMP DEFAULT NOW(),
                            updated_at TIMESTAMP DEFAULT NOW()
                        )"
                    );
    try{
        //excute query
        $result = $mysqli->query($query);
        print_alert("Table $DB_NAME.$table created.", "success");
        //var_dump($result);
    } catch (Exception $e){
        echo '<br>Exception received: ', $e->getMessage(), "\n";
    } finally {
        //echo "<br>Table $table created.";
    }

    //7) Je mets des donnes dans ma table

//créer quatre voitures avec quatre prix sur une requete sql
    $sql = "INSERT INTO $table
                (title, price)
            VALUES
                ('Ford', 15.00),
                ('Honda', 120.00),
                ('Renault', 3200.00)
            ";

    if ($mysqli->query($sql) === TRUE) {
        echo "Nouvelle ligne créée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $mysqli->error;
    }

    //8) query to get data from table
    $query = sprintf("SELECT id, title, price FROM $table ORDER BY id LIMIT 10");
    //execute $query

    //$result = $mysqli->query($query);

    try{
        //excute query
        $result = $mysqli->query($query);
        print_alert("Table $DB_NAME.$table exists.", "success");
        //var_dump($result);
    } catch (Exception $e){
        echo '<br>Exception received: ', $e->getMessage(), "\n";
    } finally {
        //echo "<br>Table $table created.";
    }

    $cars_count = $result->num_rows;
    $cars_id = array();
    $cars_title = array();
    $cars_price = array();


    //loop through the return data with fetch_assoc
    // while ($row = $result->fetch_assoc()){
       // $cars_id[] = $row["id"];
       // $cars_title[] = $row["title"];
       // $cars_price[] = $row["price"];
    //    echo "</br>" .$row["id"]." ".$row["title"]." ". $row["price"];
    // }
    //var_dump ($cars_title);
?>
<table class="table">
    <thead class="thead-dark">
          <tr>
              <th scope="col">id</th>
              <th scope="col">Title</th>
              <th scope="col">Price</th>
          </tr>
    </thead>
    <tbody>
      <?php
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>";
                  echo "<td>" . $row["id"] . "</td>";
                  echo "<td>" . $row["title"]. "</td>";
                  echo "<td>" . $row["price"] . "</td>";
                  $cars_title[]=$row["title"]; //on met row dans tableau
                  $cars_price[]=$row["price"];
              echo "</tr>";
          }
      ?>
    </tbody>
</table>


<?php
//CHERCHER UN MOT ET UN PRIX*************************************************************************
// $search_title = "%honda%";
// $search_price = 120;
// if ($stmt = $mysqli->prepare("SELECT title, price FROM car WHERE title LIKE ? AND price < ? LIMIT 1")){
//   // Lecture des marqueurs
//   // float 'd'
//   // integer 'l'
//   // string 's'
//   // blob 'b'
//   $stmt->bind_param("sd", $search_title, $search_price);
//   //Executio de la requete
//   $stmt->execute();
//   //Lecture des vaiables resultantes
//   $stmt->bind_result($title,$price);
//   //recuperation des valeurs
//   $stmt->fetch();
//   $message = sprintf("The car '%s' which costs %d is in my car store", $title, $price);
//   print_alert("$message", "info");
//   //fermeture du traitement
//   $stmt->close();
//}

// 9) créer une requête préparée
    $search_title = "%ond%";
    $search_price = 110;
    if($stmt = $mysqli->prepare("SELECT title, price FROM car WHERE title LIKE ? AND price > ?")) { //je peux mettre $table au lieu de car
        //Lecture des marqueurs
        // float    'd'
        // integer  'i'
        // string   's'
        // blob     'b'
        $stmt->bind_param("sd", $search_title, $search_price);
        // Execution de la requête /
        $stmt->execute();
        // Lecture des variables résultantes /
        $stmt->bind_result($title, $price);
        // Récupération des variables résultantes /
        $stmt->fetch();
        $message = sprintf("The car '%s' which cost %d is in my garage.", $title, $price);
        print_alert("$message", "info");
        // Fermeture du traitement */
        $stmt->close();
    }



?>
<div class="container">
 <!-- <div class="row">
   <div class="col-sm-3"></div>
    <div class "col-sm-6"> -->
      <canvas id="myChart"></canvas>
    <!-- </div>
   <div class="col-sm-3"></div> -->
 <!-- </div> -->
</div>
<script>
      var ctx = document.getElementById('myChart').getContext('2d');
      var chart = new Chart(ctx, {
          // The type of chart we want to create
          type: 'horizontalBar',

          // The data for our dataset
          data: {
              labels: <?php echo json_encode($cars_title);?>,
              datasets: [{
                  label: 'My First dataset',
                  backgroundColor: [
                      <?php

                      $avg = get_average($cars_price);
                      for ($i=0; $i<count($cars_price); $i++) {
                          if ($cars_price[$i] > $avg) {
                              echo "'rgba(254, 62, 35, 0.3)',";
                          } else {
                              echo "'rgba(54, 162, 235, 0.3)',";
                          }
                      }
                      ?>
                  ],
                  borderColor: 'rgb(255, 99, 132)',
                  data: <?php echo json_encode($cars_price);?>
              }]
          },

          // Configuration options go here
          options: {}
      });
 </script>


<?php

   function get_average( array $array_arg) :float {
       $sum = 0;
       foreach ($array_arg as $value) {
           $sum += $value;
       }
       return $sum/count($array_arg);
   }
?>

<?php

$mysqli->close(); // pOUR SE DECONNECTER de la bdd
include "./footer.php";
?>
