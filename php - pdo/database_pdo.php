<?php
$page = __FILE__;
include "./header.php";
include "./navbar.php";
var_dump($_GET);
?>


<?php
    // 1) specify your own database credentials
    $DB_PORT = '3306';
    $DB_HOST = 'localhost';
    $DB_USERNAME = 'root';
    $DB_PASSWORD = '';
    $DB_NAME ='testdrive';
    $table = 'car';

// ****************************2) get connection PDO
/* Connexion à une base MySQL*/
    $dsn ="mysql:dbname=$DB_NAME;host=$DB_HOST:$DB_PORT";
    $user ='root';
    $password ='';
    try {
    $conn = new PDO($dsn, $user, $password); //pour se connecter
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    print_alert("Connecte to $DB_NAME", "success");
    } catch (PDOException $e) {
    print_alert("Connexion échouée". $e->getMessage() , "danger");

    }


//     // 3) Create databasee

//
//     //4) Je me reconnecte a la bdd et a la database

    //5) Drop table avec methode query PDO*********************************************
   //     $sql = "DROP TABLE IF EXISTS $table";
   //     try{
   //       //$result = $conn->query($sql); on commente ppur eviter que drop table soit execute
   //       //var_dump ($result);
   //       print_alert("Suppression de la table $table OK.", "success");
   //     } catch (PDOException $e) {
   //     print_alert("Suppression de la table $table échouée" . $e->getMessage(), "danger");
   // }
   //
   //   // ///drop table avec exec - renvoi numero de lignes affectes *******************************************
   //   $sql = "DROP TABLE IF EXISTS $table";
   //  try {
   //      //$result = $conn->exec($sql);
   //      //var_dump ($result);
   //      print_alert("Suppression de la table $table OK.", "success");
   //  } catch (PDOException $e) {
   //      print_alert("Suppression de la table $table échouée" . $e->getMessage(), "danger");
   //  }



//     //6) Je cree ma table // PDO *******************************************************************
      $sql = "CREATE TABLE IF NOT EXISTS $table (
               id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
               title VARCHAR(30) NOT NULL,
               price DECIMAL (6,2) NOT NULL
           )";
          try {
           $result = $conn->query($sql); //$conn est un objet pdo
           var_dump ($result);
           print_alert("Création Table $table OK.", "success");
          } catch (PDOException $e) {
           print_alert("Erreur création table $table" . $e->getMessage(), "danger");
          }




// 7) Insertion données PDO*********************************************************************************

$car_name = "Voiture";
$car_price = '50';
$sql = $conn->prepare('INSERT INTO car (title, price) VALUES (:car_name, :car_price)');
$sql->bindParam('car_name', $car_name, PDO::PARAM_STR);
$sql->bindParam('car_price', $car_price, PDO::PARAM_INT);
try {
    $sql->execute();
    print_alert("Insert $car_name $car_price is OK ", "success");
} catch(PDOException $e) {
    print_alert("Insert $car_name $car_price is not OK ", "danger");
}

// for ($k=0; $k<100; $k++){
//   $car_name = "Car$k";
//   $car_price = rand(10,100);
//   try {
//       $sql->execute();
//       //print_alert("Insert $car_name $car_price is OK ", "success");
//   } catch(PDOException $e) {
//     //print_alert("Insert $car_name $car_price is KO ", "success");
//   }
//
// }



























   // $sql = "INSERT INTO $table
   //             (title, price)
   //         VALUES
   //             ('Voiture 1', 80),
   //             ('Voiture 2', 40),
   //             ('Voiture 3', 150),
   //             ('Voiture 4', 110)
   //         ";
   //


   // try {
   //     $result = $conn->exec($sql); //exec envoie quantite des lignes affectes, query envoie la commande qui a ete utilise
   //     // $last_id = $conn->lastInsertID();
   //     // echo "last_id= $last_id";
   //     var_dump ($result);
   //     print_alert("Création ligne dans table $table OK.", "success");
   //     } catch (PDOException $e) {
   //         print_alert("Erreur création ligne dans table $table" . $e->getMessage(), "danger");
   //     }

       //POUR AJOUTER AVEC METHODE POST*****************************************************************************

       if( isset($_POST['carname']) && isset($_POST['carprice']) ){ //http://localhost/public/database_pdo.php?ftitle=Voiture%4&fprice=110
           try{
               $sql = "INSERT INTO $table (title, price) VALUES (:title, :price)";
               $result = $conn->prepare($sql);
               $result->bindValue(':title', $_POST['carname']);
               $result->bindParam(':price', $_POST['carprice']);
               $res = $result->execute();
               //$conn->commit;
               var_dump($res);
               print_alert("Ajout ligne dans table $table OK.", "success");
           } catch (Exception $e) {
               print_alert("Erreur ajout ligne dans table $table" . $e->getMessage(), "danger");
           }
       }

       var_dump($_POST);


   //POUR EFFACER AVEC BUTTON DELETE METHODE GET
       if( isset($_GET['id_delete'])){ //http://localhost/public/database_pdo.php?ftitle=Voiture%4&fprice=110
           try{
               $sql = "DELETE FROM $table where id = ?";
               $result = $conn->prepare($sql);
               $result->bindValue(1, $_GET['id_delete'], PDO::PARAM_INT);

               $res = $result->execute();

               print_alert("Suppression ligne dans table $table OK.", "success");
           } catch (Exception $e) {
               print_alert("Erreur Suppression ligne dans table $table" . $e->getMessage(), "danger");
           }
       }

       // 7) Essai de supprimer une ligne grace au formulaire POST
   if(isset($_POST['id_delete']) && $_POST['id_delete'] !== "" ){ //si get est trouvé et pas vide
       //echo $_POST['id_delete'];
           try{
               $sql = "DELETE FROM $table WHERE  id = ? ";
               $stmt = $conn->prepare($sql);
               $stmt->bindValue(1, $_POST['id_delete'], PDO::PARAM_INT);
               $res = $stmt->execute();
               print_alert("suppression de ma ligne dans ma table $table OK.", "success");
           }catch (PDOException $e) {
               print_alert("Erreur suppression de ma ligne dans ma table $table" . $e->getMessage(), "danger");
           }
   }






     //Pour ajouter avec get PDO ******************************************************************************

       /*if( isset($_GET['ftitle']) && isset($_GET['fprice']) ){ //http://localhost/public/database_pdo.php?ftitle=Voiture%4&fprice=110
           try{
               $sql = "INSERT INTO $table (title, price) VALUES (:title, :price)";
               $result = $conn->prepare($sql);
               $result->bindValue(':title', $_GET['ftitle']);
               $result->bindParam(':price', $_GET['fprice']);
               $res = $result->execute();
               var_dump($res);
               print_alert("Ajout ligne dans table $table OK.", "success");
           } catch (Exception $e) {
               print_alert("Erreur ajout ligne dans table $table" . $e->getMessage(), "danger");
           }
       }*/


// 8) Afficher les données avec un fetch dans un while PDO****************************************
    $query = "SELECT id, title, price FROM $table ORDER BY id LIMIT 8";
    try {
        //execute query
        $result = $conn->query($query);
//        $count = $result->rowCount();
        while($row = $result->fetch()) {
            // withassociative or numeric
            // var_dump ($row);
            echo "(" . $row['id'] . ")" ." ". $row[1] . " => ". $row['price'] . "€" ."<br>";
        }
    } catch (PDOException $e) {
        //echo '<br>Exception received: ',  $e->getMessage(), "\n";
        print_alert("Query $query not executed." . $e->getMessage(), "danger");
    } finally {
    }

    echo "<br>";

    // 8) Afficher les données avec fetchAll dans un foreach PDO*************************************************
     // $query = "SELECT id, title, price FROM $TB_NAME ORDER BY id LIMIT 5";
     // try {
     //     //execute query
     //     $result = $conn->query($query);
     //     $count = $result->rowCount();
     //     $all = $result->fetchAll();
     //     foreach($all as $value){
     //         echo "(" . $value['id'] . ")" ." ". $value[1] . " => ". $value['price'] . "€" ."<br>";
     //     }
     // } catch (PDOException $e) {
     //     //echo '<br>Exception received: ',  $e->getMessage(), "\n";
     //     print_alert("Query $query not executed." . $e->getMessage(), "danger");
     // } finally {
     // }
     //
     // echo "<br>";


    // 8) Afficher les données avec fetchAll dans un foreach FETCH COLUMN************************************
    $query = "SELECT title FROM $table ORDER BY id LIMIT 8";
    try {
        //execute query
        $result = $conn->query($query);
        //$count = $result->rowCount();
        //$all = $result->fetchAll();
        // foreach($all as $value){
        //     echo "(" . $value['id'] . ")" ." ". $value[1] . " => ". $value['price'] . "€" ."<br>";
        // }
        $cars_title = $result->fetchAll(PDO::FETCH_COLUMN,0);

        echo "DEBUG";
        var_dump($cars_title);

    } catch (PDOException $e) {
        //echo '<br>Exception received: ',  $e->getMessage(), "\n";
        print_alert("Query $query not executed." . $e->getMessage(), "danger");
    } finally {
    }



    $query = "SELECT price FROM $table ORDER BY id LIMIT 8";
    try {
        //execute query
        $result = $conn->query($query);
        //$count = $result->rowCount();
        //$all = $result->fetchAll();
        // foreach($all as $value){
        //     echo "(" . $value['id'] . ")" ." ". $value[1] . " => ". $value['price'] . "€" ."<br>";
        // }
        $cars_price = $result->fetchAll(PDO::FETCH_COLUMN,0);

        echo "DEBUG";
        var_dump($cars_price);

    } catch (PDOException $e) {
        //echo '<br>Exception received: ',  $e->getMessage(), "\n";
        print_alert("Query $query not executed." . $e->getMessage(), "danger");
    } finally {
    }



    echo "<br>";

    // 8) Afficher les colonnes avec un fetchColumn
    $query = "SELECT id, title, price FROM $table ORDER BY id LIMIT 8";
    try {
        //execute query
        $result = $conn->query($query);
        // $count = $result->rowCount();
        while($col = $result->fetchColumn(1)) {
            // withassociative or numeric
             var_dump ($col);
        }
    } catch (PDOException $e) {
        //echo '<br>Exception received: ',  $e->getMessage(), "\n";
        print_alert("Query $query not executed." . $e->getMessage(), "danger");
    } finally {
    }

    // 8) Récuperer toutes les données id, brand, price avec fetchAll
    $query = "SELECT id, title, price FROM $table ORDER BY id LIMIT 10";
    try {
        //execute query
        $result = $conn->query($query);
        $cars_all = $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print_alert("Query $query not executed." . $e->getMessage(), "danger");
    } finally {
    }



// ?>


<?php

?>

<?php




 ?>


<!--Form ajoute voiture**********************************************-->
<div class="container">
    <form method="post">
      <div class="form-group">
        <label for="inputVoiture">Car</label>
        <input type="text" name="carname" class="form-control" id="carname" aria-describedby="carnameHelp" placeholder="Add a brand">
      </div>
      <div class="form-group">
        <label for="inputPrice">Price</label>
        <input type="number" name="carprice" class="form-control" id="carprice" aria-describedby="priceHelp" placeholder="Add a price ">
      </div>
      <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>





<!-- CHART*********************************************************** -->

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
          options: {
       scales: {
           yAxes: [{
               ticks: {
                   beginAtZero: true
               }
           }]
       }
   }
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
$query = "SELECT id, title, price FROM $table ORDER BY id LIMIT 150"; //Je limite numero de donnes affiches au tableau
try {
    //execute query
    $result = $conn->query($query);
    // $count = $result->rowCount();
    // $all = $result->fetchAll();
    // foreach($all as $value){
    //     echo "(" . $value['id'] . ")" ." ". $value[1] . " => ". $value['price'] . "€" ."<br>";
    // } ?>
    <table class="table">
       <thead class="thead-dark">
             <tr>
                 <th scope="col">id</th>
                 <th scope="col">Title</th>
                 <th scope="col">Price</th>
                 <th scope="col">Delete avec GET</th>
                 <th scope="col">Delete avec POST</th>
            </tr>
      </thead>
    <tbody>
    <?php

        while ($row = $result->fetch()) {
                echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["title"]. "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>";
                    echo '<a class="btn btn-outline-danger btn-sm" href="database_pdo.php?id_delete=' . $row["id"] . '">Delete</a>';
                    echo "</td>";
                    //DELTE POST
                    echo '<td>
                        <form method="post" action="database_pdo.php">
                            <input  type="hidden" value="' . $row['id'] . '" name="id_delete" class="form-control" id="id_delete" aria-describedby="brandcar">
                            <button type="submit" value="add" class="btn btn-success">delete_POST</button>
                            </form>
                        </td>
                        </tr>';


                     $cars_title[]=$row["title"]; //on met row dans tableau
                     $cars_price[]=$row["price"];
                echo "</tr>";
            }

    ?>
      </tbody>
   </table>

<?php } catch (PDOException $e) {
    //echo '<br>Exception received: ',  $e->getMessage(), "\n";
    print_alert("Query $query not executed." . $e->getMessage(), "danger");
} finally {
}


echo "<br>";

?>





<?php

//$mysqli->close(); // pOUR SE DECONNECTER de la bdd
include "./footer.php";
?>
