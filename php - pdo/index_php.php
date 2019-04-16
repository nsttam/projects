<?php
	$page = basename(__FILE__);
	include "./header.php";
	include "./navbar.php";
?>
<div class="container"><br /><?php
	// Si on a reçu une reponse de la page crud
	if(!empty($_GET['return']) && !empty($_GET['type'])){
		if(!empty($_GET['message'])) {
			$erreur = '<br /><br />' . urldecode($_GET['message']);
		}else {
			$erreur = '';
		}
		print_alert($_GET['return'] . $erreur, $_GET['type']);
	}

	// PDO
	// se connecter a la base
	// creer une database a son nom_prenom
	// se deconnecter de la base
	// se reconnecter a la bonne base
	// create, read, delete ligne



	// 1) Definition des variables
        $db_config = array();
        $db_config['PDO_SGBD']      = 'mysql';
        $db_config['PDO_PORT']      = '3306';
        $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
        $db_config['PDO_DB_NAME']   = '';
        $db_config['PDO_USER']      = 'root';
        $db_config['PDO_PASSWORD']  = '';
        $db_config['PDO_OPTIONS']   = array(
			// Activation des exceptions PDO :
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );


	// BDD
		// Connexion à la base de données
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
				// Alerte
				print_alert("Connexion bdd réussie", "success");
				var_dump($db);
			} catch (PDOException $e) {
				// Alerte
				print_alert("Connexion bdd échoué" . $e->getMessage(), "danger");
			}


		// Defintion du nom de la base de données
        	$db_config['PDO_DB_NAME'] = 'tamara_ravagnan';
			$bdd=$db_config['PDO_DB_NAME'];


		// Creer un base de données nicolas_meunier
			$sql = "
				CREATE DATABASE IF NOT EXISTS $bdd
				CHARACTER SET utf8
				COLLATE utf8_general_ci
			";
			try {
				$request = $db->query($sql);
				// Alerte
				print_alert("Création bdd réussie", "success");
				var_dump ($request);
			} catch (PDOException $e) {
				print_alert("Création bdd échoué" . $e->getMessage(), "danger");
			} finally {
				// On supprime cette variable par sécurité
				unset($bdd);
			}


		// Se deconnecter de la base de données
			try {
				$db = null;
				// Alerte
				print_alert("Deconnection bdd réussie", "success");
				var_dump($db);
			} catch (PDOException $e) {
				print_alert("Deconnection bdd échoué" . $e->getMessage(), "danger");
			}


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
				// Alerte
				// print_alert("Connexion bdd réussie", "success");
				// var_dump($db);
			} catch (PDOException $e) {
				// Alerte
				print_alert("Connexion bdd échoué" . $e->getMessage(), "danger");
			} finally {
				// On supprime ce tableau par sécurité
				unset($db_config);
			}


	// TABLE
		// Definition du nom de table
			$TB_NAME = 'test';


		// Supprimer la table si elle existe
			$sql = "DROP TABLE IF EXISTS $TB_NAME";
			try {
				$request = $db->query($sql);
				// Alerte
				print_alert("Suppression table reussie", "success");
				var_dump($request);
			} catch (PDOException $e) {
				print_alert("Suppression table échouée" . $e->getMessage(), "danger");
			}


		// Creer une table
			$sql = "
				CREATE TABLE IF NOT EXISTS $TB_NAME (
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					brand VARCHAR(30) NOT NULL,
					price DECIMAL (6,2) NOT NULL,
					km INT(7) NOT NULL
				)
			";
			try {
				$request = $db->query($sql);
				// Alerte
				print_alert("Creation table reussie", "success");
				var_dump($request);
			} catch (PDOException $e) {
				print_alert("Creation table échouée" . $e->getMessage(), "danger");
			}


	// LIGNE
		// Insertion d'une nouvelle ligne test
			$sql = "
				INSERT INTO $TB_NAME(brand, price, km)
				VALUES('test 1', 9999.99, 100),
					  ('test 2', 200, 200)
			";
			 try {
				$request = $db->query($sql);
				// Alerte
				print_alert("Insertion ligne réussie", "success");
				var_dump($request);
			} catch (PDOException $e) {
				print_alert("Insertion ligne échouée" . $e->getMessage(), "danger");
			}


		// Suppression d'une ligne test
			$sql = "
				DELETE FROM $TB_NAME
				WHERE brand = 'test 1'
			";
			 try {
				$delete = $db->query($sql);
				// Alerte
				print_alert("Suppression ligne réussie", "success");
				var_dump($delete);
			} catch (PDOException $e) {
				print_alert("Suppression ligne échouée" . $e->getMessage(), "danger");
			}



		// Selection des lignes
		try {
			$select_cars = $db->query("SELECT * FROM $TB_NAME ORDER BY id");
			// Alerte
			// print_alert("Selection lignes réussie", "success");
			// var_dump($select_cars);
		} catch(PDOException $e) {
			print_alert("Selection lignes échouée" . $e->getMessage(), "danger");
		}

	$all_cars = $select_cars->fetchAll();
	$brands = $prices = $kms = [];

	foreach($all_cars as $car){
		array_push($brands, $car['brand']);
		array_push($prices, $car['price']);
		array_push($kms, $car['km']);
	}?>

	<div class="row">
		<div class="col-10 offset-1">
			<canvas id="myChart" width="512" height="256"></canvas>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script>
	var ctx = document.getElementById('myChart');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: <?=json_encode($brands)?>,
			datasets: [{
				label: 'Prix',
				data: <?=json_encode($prices)?>,
				backgroundColor: '#2980b9',
				borderColor: '#3498db',
				borderWidth: 0
			},
			{
				label: 'Kilométrage',
				data: <?=json_encode($kms)?>,
				backgroundColor: '#c0392b',
				borderColor: '#e74c3c',
				borderWidth: 0
			}]
		},
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

	<br/>

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
		<tbody><?php
			foreach($all_cars as $car){echo'
				<tr>
					<th scope="row">' . $car['id'] . '</th>
					<td>' . $car['brand'] . '</td>
					<td>' . $car['price'] . '</td>
					<td>' . $car['km'] . '</td>
					<td>
						<a href="./crud.php?action=read&id=' . $car['id'] . '" class="btn btn-primary"> Lire l\'article </a>
						<a href="./crud.php?action=update&id=' . $car['id'] . '" class="btn btn-secondary w-25" data-toggle="tooltip" data-placement="top" title="Modifier"><i class="fas fa-pen"></i></a>
						<a href="./crud.php?action=delete&id=' . $car['id'] . '" class="btn btn-danger w-25" onclick="return validation(' . $car['id'] . ')" data-toggle="tooltip" data-placement="top" title="Supprimer"><i class="fas fa-times"></i></a>
					</td>
				</tr>
			';}?>
		</tbody>
		<tfoot>
			<form action="./crud.php">
				<tr>
					<th scope="row">Nouvelle<br />voiture</th>
					<input type="hidden" name="action" value="create" />
					<td>
						<input type="text" class="form-control" id="input1" placeholder="Marque" name="brand" />
					</td>
					<td>
						<input type="number" class="form-control" id="input2" placeholder="Prix" step="0.01" min="0" max="9999,99" name="price" />
					</td>
					<td>
						<input type="number" class="form-control" id="input3" placeholder="Kilométrage" step="0.01" min="0" max="9999999" name="km" />
					</td>
					<td>
						<button type="submit" class="btn btn-primary w-100">Ajouter</button>
					</td>
				</tr>
			</form>
		</tfoot>
	</table>


	<br /> <br /> <br />

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			Etes-vous sûr de vouloir supprimer cette ligne ?
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
			<button type="button" class="btn btn-primary" onclick="validation(0)">Oui</button>
		  </div>
		</div>
	  </div>
	</div>
</div>

<script>
	var id;
	function validation(val) {
		if(val > 0) {
			id=val;
			$("#exampleModal").modal("show");
			return false;
		} else {
			window.location.href = "crud?action=delete&id=" + id;
		}
	}
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>
</div>
<?php
  include "./footer.php";
?>*/
