<?php
include "./header.php";

if(isset($_GET['action'])) {

		$db_config = array();
        $db_config['PDO_SGBD']      = 'mysql';
        $db_config['PDO_PORT']      = '3306';
        $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
        $db_config['PDO_DB_NAME']   = 'tamara_ravagnan';
        $db_config['PDO_USER']      = 'root';
        $db_config['PDO_PASSWORD']  = '';
        $db_config['PDO_OPTIONS']   = array(

            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
		$TB_USERS = 'users';


		try {
			$db = new PDO(
				$db_config['PDO_SGBD'] . ':host=' .
				$db_config['PDO_HOST'] .
				';dbname='. $db_config['PDO_DB_NAME'],
				$db_config['PDO_USER'],
				$db_config['PDO_PASSWORD'],
				$db_config['PDO_OPTIONS']
			);
		} catch (PDOException $e) {

			
		} finally {
			// On supprime ce tableau par sécurité
			unset($db_config);
		}


	// Suppression d'une ligne
	if($_GET['action'] === 'delete' && !empty($_GET['id'])) {
		 try {
			$request = $db->prepare("DELETE FROM $TB_USERS WHERE id = ?");
			$request->execute(array($_GET['id']));
			// Alerte
			header('location:./seed_php.php?return=Suppression ligne réussie&type=success');
		} catch (PDOException $e) {
			header('location:./seed_php.php?return=Suppression ligne échouée&type=danger&message=' . urlencode($e->getMessage()));
		}
	}

}

?>
