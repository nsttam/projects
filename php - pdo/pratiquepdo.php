<?php
  $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>
<?php
	// 1) Connexion to BDD
	try {
        // specify your own database credentials
        $db_config = array();
        $db_config['PDO_SGBD']      = 'mysql';
        $db_config['PDO_PORT']      = '3306';
        $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
        $db_config['PDO_USER']      = 'root';
        $db_config['PDO_PASSWORD']  = '';
        $db_config['PDO_OPTIONS']   = array(
            // Activation des exceptions PDO :
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $conn = new PDO(    $db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . ";",
                        //. 'dbname='. $db_config['PDO_DB_NAME'],
                        $db_config['PDO_USER'],
                        $db_config['PDO_PASSWORD'],
                        $db_config['PDO_OPTIONS']
                    );
        print_alert($db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . "Connexion is OK ", "success");
    } catch(PDOException $e) {
		print_alert($db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . "Connexion is KO " . $e->getMessage(), "danger");
    } finally {
        unset($db_config);
    }

	// 2) Create database
	$DB_NAME = "testpdo";
    $sql = sprintf("CREATE DATABASE IF NOT EXISTS $DB_NAME");
    try {
        $conn->exec($sql);
        print_alert("Database $DB_NAME CREATE is OK ", "success");
    } catch(PDOException $e) {
        //trigger_error($e->getMessage(), E_USER_ERROR);
        print_alert("Database $DB_NAME CREATE is KO " . $e->getMessage(), "danger");
    }

	// 3) Close connexion
	$conn = null;

    // 4) Connexion on dbname testdrive
    try {
        // specify your own database credentials
        $db_config = array();
        $db_config['PDO_SGBD']      = 'mysql';
        $db_config['PDO_PORT']      = '3306';
        $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
        $db_config['PDO_DB_NAME']   = 'testpdo';
        $db_config['PDO_USER']      = 'root';
        $db_config['PDO_PASSWORD']  = '';
        $db_config['PDO_OPTIONS']   = array(
			// Activation des exceptions PDO :
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $conn = new PDO(    $db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . ";"
                        . 'dbname='. $db_config['PDO_DB_NAME'],
                        $db_config['PDO_USER'],
                        $db_config['PDO_PASSWORD'],
                        $db_config['PDO_OPTIONS']
                    );
        print_alert($db_config['PDO_DB_NAME'] . " database connexion is OK ", "success");
    } catch(PDOException $e) {
        print_alert($db_config['PDO_DB_NAME'] . " database connexion is KO " . $e->getMessage(), "danger");
    } finally {
        unset($db_config);
    }

	// 5) Create table...
  $TB_NAME = 'persons';
  $sql = "CREATE TABLE IF NOT EXISTS $TB_NAME (
           id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
           name VARCHAR(30) NOT NULL,
           surname VARCHAR(30) NOT NULL,
           age INT (2) NOT NULL
       )";
      try {
       $result = $conn->query($sql); //$conn est un objet pdo
       print_alert("Création Table $TB_NAME OK.", "success");
      } catch (PDOException $e) {
       print_alert("Erreur création table $TB_NAME" . $e->getMessage(), "danger");
      }

 //6)insertion des donnéels

      // try{
      // //	Connexion	in	a	php file	with require_once !!!
      // require_once('pratiquepdo.php');
      // $sql =	"INSERT	INTO	$TB_NAME	(name, surname, age)	VALUES('Tamara', 'Ravagnan', 31)";
      // $result =	$conn->query($sql);
      // //$result =	$db->exec($sql);
      // var_dump($result);
      // }	catch	(Exception	$e)	{
      // $error =	$e->getMessage();
      // echo "Errors :	".	$error;
      // }


      //INSERTON DONNES AVEC FORM************************************
      if( isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['age']) ){ //http://localhost/public/database_pdo.php?ftitle=Voiture%4&fprice=110
          try{
              $sql = "INSERT INTO $TB_NAME (name, surname, age) VALUES (:name, :surname, :age)";
              $result = $conn->prepare($sql);
              $result->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
              $result->bindValue(':surname', $_POST['surname'], PDO::PARAM_STR);
              $result->bindValue(':age', $_POST['age'], PDO::PARAM_INT);
              $res = $result->execute();
              //$conn->commit;
              var_dump($res);
              print_alert("Ajout ligne dans table $TB_NAME OK.", "success");
          } catch (Exception $e) {
              print_alert("Erreur ajout ligne dans table $TB_NAME" . $e->getMessage(), "danger");
          }
      }

      var_dump($_POST);

      //POUR EFFACER AVEC BUTTON DELETE METHODE GET
          if( isset($_GET['id_delete'])){ //http://localhost/public/database_pdo.php?ftitle=Voiture%4&fprice=110
              try{
                  $sql = "DELETE FROM $TB_NAME where id = ?";
                  $result = $conn->prepare($sql);
                  $result->bindValue(1, $_GET['id_delete'], PDO::PARAM_INT);

                  $res = $result->execute();

                  print_alert("Suppression ligne dans table $TB_NAME OK.", "success");
              } catch (Exception $e) {
                  print_alert("Erreur Suppression ligne dans table $TB_NAME" . $e->getMessage(), "danger");
              }
          }

          // 7) Essai de supprimer une ligne grace au formulaire POST
      if(isset($_POST['id_delete']) && $_POST['id_delete'] !== "" ){ //si get est trouvé et pas vide
          //echo $_POST['id_delete'];
              try{
                  $sql = "DELETE FROM $TB_NAME WHERE  id = ? ";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindValue(1, $_POST['id_delete'], PDO::PARAM_INT);
                  $res = $stmt->execute();
                  print_alert("suppression de ma ligne dans ma table $TB_NAME OK.", "success");
              }catch (PDOException $e) {
                  print_alert("Erreur suppression de ma ligne dans ma table $TB_NAME" . $e->getMessage(), "danger");
              }
      }


	// etc.

	// En of PHP script : close connexion
//	$conn = null;

?>
<!-- Creation formulaire -->
    <div class="container">
        <form method="post">
          <div class="form-group">
            <label for="addName"><h6>Add a name</h6></label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Add a name">
          </div>
          <div class="form-group">
            <label for="addSurname"><h6>Add a surname</h6></label>
            <input type="text" name="surname" class="form-control" id="surname" aria-describedby="surnameHelp" placeholder="Add a surname">
          </div>
          <div class="form-group">
            <label for="addAge">Add age</label>
            <input type="number" name="age" class="form-control" id="age" aria-describedby="ageHelp" placeholder="Add a price ">
          </div>
          <button type="submit" class="btn btn-primary">Add person</button>
        </form>
    </div>
  </br>
<!-- Creation tableau -->
    <?php
    $query = "SELECT id, name, surname, age FROM $TB_NAME";
    try {
        //execute query
        $result = $conn->query($query);
     ?>

        <table class="table">
           <thead class="thead-dark">
                 <tr>
                     <th scope="col">id</th>
                     <th scope="col">Name</th>
                     <th scope="col">Surname</th>
                     <th scope="col">Age</th>
                     <th scope="col">Delete avec GET</th>
                     <th scope="col">Delete avec POST</th>
                </tr>
          </thead>
        <tbody>

        <?php
            while ($row = $result->fetch()) {
                    echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"]. "</td>";
                        echo "<td>" . $row["surname"] . "</td>";
                        echo "<td>" . $row["age"] . "</td>";
                        echo "<td>";
                        echo '<a class="btn btn-outline-danger btn-sm" href="pratiquepdo.php?id_delete=' . $row["id"] . '">Delete GET</a>';
                        echo "</td>";
                        //DELTE POST
                        echo '<td>
                            <form method="post" action="pratiquepdo.php">
                                <input  type="hidden" value="' . $row['id'] . '" name="id_delete" class="form-control" id="id_delete" aria-describedby="names">
                                <button type="submit" value="add" class="btn btn-success">delete_POST</button>
                                </form>
                            </td>
                            </tr>';
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
        include "./footer.php";
  ?>
