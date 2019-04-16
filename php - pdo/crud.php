<?php // Traitement des actions utilisateur
include "./header.php";

if(isset($_GET['action'])) {
	// 1) Definition des variables
		$db_config = array();
        $db_config['PDO_SGBD']      = 'mysql';
        $db_config['PDO_PORT']      = '3306';
        $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
        $db_config['PDO_DB_NAME']   = 'tamara_ravagnan';
        $db_config['PDO_USER']      = 'root';
        $db_config['PDO_PASSWORD']  = '';
        $db_config['PDO_OPTIONS']   = array(
			// Activation des exceptions PDO :
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
		$TB_NAME = 'test';

	// Se connecter à la base de données nicolas_meunier
		try {
			// Connexion
			$db = new PDO(
				$db_config['PDO_SGBD'] . ':host=' .
				$db_config['PDO_HOST'] .
				';dbname='. $db_config['PDO_DB_NAME'],
				$db_config['PDO_USER'],
				$db_config['PDO_PASSWORD'],
				$db_config['PDO_OPTIONS']
			);
		} catch (PDOException $e) {
			// Alerte
			header('location:./index_php.php?return=Connexion bdd echouée&type=danger&message=' . urlencode($e->getMessage()));
		} finally {
			// On supprime ce tableau par sécurité
			unset($db_config);
		}

	// Insertion d'une nouvelle ligne
	if($_GET['action'] === 'create' && !empty($_GET['brand']) && !empty($_GET['price']) && !empty($_GET['km'])) {
		 try {
			$request = $db->prepare("INSERT INTO $TB_NAME(brand, price, km) VALUES(?, ?, ?)");
			$request->execute(array($_GET['brand'], $_GET['price'], $_GET['km']));
			// Alerte
			header('location:./index_php.php?return=Insertion ligne réussie&type=success');
		} catch (PDOException $e) {
			header('location:./index_php.php?return=Insertion ligne échouée&type=danger&message=' . urlencode($e->getMessage()));
		}
	}

	// Suppression d'une ligne
	if($_GET['action'] === 'delete' && !empty($_GET['id'])) {
		 try {
			$request = $db->prepare("DELETE FROM $TB_NAME WHERE id = ?");
			$request->execute(array($_GET['id']));
			// Alerte
			header('location:./index_php.php?return=Suppression ligne réussie&type=success');
		} catch (PDOException $e) {
			header('location:./index_php.php?return=Suppression ligne échouée&type=danger&message=' . urlencode($e->getMessage()));
		}
	}

	// Modification d'une ligne
	if($_GET['action'] === 'update' && !empty($_GET['id'])) {
		if(!empty($_GET['brand']) && !empty($_GET['price']) && !empty($_GET['km'])) {
			 try {
				$request = $db->prepare("UPDATE $TB_NAME SET brand = ?, price = ?, km = ? WHERE id = ?");
				$request->execute(array($_GET['brand'], $_GET['price'], $_GET['km'], $_GET['id']));
				// Alerte
				header('location:./index_php.php?return=Modification ligne réussie&type=success');
			 } catch (PDOException $e) {
				header('location:../index_php.php?return=Modification ligne échouée&type=danger&message=' . urlencode($e->getMessage()));
			}
		} else {
			// Selection de la ligne
			try {
				$select_car = $db->prepare("SELECT * FROM $TB_NAME WHERE id = ?");
				$select_car->execute(array($_GET['id']));
				$car = $select_car->fetch();
			} catch(PDOException $e) {
				header('location:../index_php.php?return=Selection ligne échouée&type=danger&message=' . urlencode($e->getMessage()));
			}

			if($car) {?>
				<div class="container">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Id</th>
								<th scope="col">Marque</th>
								<th scope="col">Prix</th>
								<th scope="col">Kilométrage</th>
								<th scope="col">Option</th>
							</tr>
						</thead>
						<tbody>
							<form>
								<tr>
									<input type="hidden" name="action" value="update" />
									<input type="hidden" name="id" value="<?=$car['id']?>" />
									<th scope="row">
										<input type="number" class="form-control" placeholder="Prix" step="0.01" min="0" max="9999,99" name="price" value="<?=$car['id']?>" />
									</th>
									<td>
										<input type="text" class="form-control" placeholder="Marque" name="brand" value="<?=$car['brand']?>" />
									</td>
									<td>
										<input type="number" class="form-control" placeholder="Prix" step="0.01" min="0" max="9999,99" name="price" value="<?=$car['price']?>" />
									</td>
									<td>
										<input type="number" class="form-control" placeholder="Kilométrage" step="0.01" min="0" max="9999999" name="km" value="<?=$car['km']?>" />
									</td>
									<td>
										<input type="submit" class="btn btn-primary" value="Modifier" />
										<button class="btn btn-light" onclick="window.location.href='index_php.php'; return false;">Annuler</button>
									</td>
								</tr>
							</form>
						</tbody>
					</table>
				</div><?php
			}
		}
	}

	// Selection d'une seule ligne
	if($_GET['action'] === 'read' && !empty($_GET['id'])) {
		// Selection de la ligne
		try {
			$select_car = $db->prepare("SELECT * FROM $TB_NAME WHERE id = ?");
			$select_car->execute(array($_GET['id']));
			$car = $select_car->fetch();
		} catch(PDOException $e) {
			header('location:./index_php.php?return=Selection ligne échouée&type=danger&message=' . urlencode($e->getMessage()));
		}

		if($car) {?>
			<div class="container">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Marque</th>
							<th scope="col">Prix</th>
							<th scope="col">Kilométrage</th>
							<th scope="col">Option</th>
						</tr>
					</thead>
					<tbody><?php echo'
							<tr>
								<th scope="row">' . $car['id'] . '</th>
								<td>' . $car['brand'] . '</td>
								<td>' . $car['price'] . '</td>
								<td>' . $car['km'] . '</td>
								<td>
									<a href="./index_php.php" class="btn btn-primary">Retour à la liste</a>
								</td>
							</tr>
						';?>
					</tbody>
				</table>
			</div><?php
		}
	}

} else {
	header('location:./index_php.php?return=Aucune action specifiée&type=danger');
}
