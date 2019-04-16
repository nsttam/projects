<?php

function print_alert($message, $class = "danger") {
    echo "<div class=\"alert alert-$class alert-dismissible fade show\" role=\"alert\">";
            echo $message;
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
        echo '</div>';
}

//FUNCTION CONNECT
function cnxbdd(){
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
        $pdo = new PDO(    $db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . ";",
                        //. 'dbname='. $db_config['PDO_DB_NAME'],
                        $db_config['PDO_USER'],
                        $db_config['PDO_PASSWORD'],
                        $db_config['PDO_OPTIONS']
                    );
        print_alert($db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . "Connexion is OK ", "success");
        return $pdo;//ON AJOUTE RETURN
    } catch(PDOException $e) {
		print_alert($db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . "Connexion is KO " . $e->getMessage(), "danger");
    return null;//ON AJOUTE RETURN
    } finally {
        unset($db_config);
    }


}

//FUNCTION CREATE Database
function createdb(){
  $DB_NAME = "testpdo";
  $sql = sprintf("CREATE DATABASE IF NOT EXISTS $DB_NAME");
        try {
            cnxbdd()->exec($sql); //avant c'etait $conn->exec($sql)
            print_alert("Database $DB_NAME CREATE is OK ", "success");
        } catch(PDOException $e) {
            //trigger_error($e->getMessage(), E_USER_ERROR);
            print_alert("Database $DB_NAME CREATE is KO " . $e->getMessage(), "danger");
        }
}

//FUNCTION CONNECT bdd
function cnxbdtestpdo(){
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
        $pdo = new PDO(    $db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . ";"
                        . 'dbname='. $db_config['PDO_DB_NAME'],
                        $db_config['PDO_USER'],
                        $db_config['PDO_PASSWORD'],
                        $db_config['PDO_OPTIONS']
                    );
        print_alert($db_config['PDO_DB_NAME'] . " database connexion is OK ", "success");
        return $pdo;
    } catch(PDOException $e) {
        print_alert($db_config['PDO_DB_NAME'] . " database connexion is KO " . $e->getMessage(), "danger");
    } finally {
        unset($db_config);
    }
}

//FUNCTION CREATE Table
function createtable(){
$TB_NAME = 'persons';
$sql = "CREATE TABLE IF NOT EXISTS $TB_NAME (
         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(30) NOT NULL,
         surname VARCHAR(30) NOT NULL,
         age INT (2) NOT NULL
     )";
    try {
     cnxbdtestpdo()->query($sql); //$conn est un objet pdo
     print_alert("Création Table $TB_NAME OK.", "success");
    } catch (PDOException $e) {
     print_alert("Erreur création table $TB_NAME" . $e->getMessage(), "danger");
    }
  }

  function adddata (){
    try{
    //	Connexion	in	a	php file	with require_once !!!
    require_once('pratiquepdo.php');
    $sql =	"INSERT	INTO	$TB_NAME	(name, surname, age)	VALUES('Tamara', 'Ravagnan', 31)";
    cnxbdtestpdo()->query($sql);
    //$result =	$db->exec($sql);
    //var_dump($result);
    }	catch	(Exception	$e)	{
    $error =	$e->getMessage();
    echo "Errors :	".	$error;
    }
  }


?>
