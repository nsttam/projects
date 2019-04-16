<?php
  $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>

<!-- pas negative, pas majeur a 170 // input type="number" / le form no accepta chaine de caracteres-->
<div class="container mb-5 bg-info">
    <form method="post">
      <div class="form-group mt-2 text-center">
        <label for="inputNb" class="text-dark font-weight-bold">Calculer factorielle</label>
        <input type="number" name="inputNb" class="form-control" id="inputNb" aria-describedby="inputNbHelp" placeholder="Inserez un nombre">
      </div>
      <button type="submit" class="btn btn-success">Envoyer</button>
    </form>


<?php
//RECURSIVE fx = calls itself over and over until end condition arrives (quand elle arrive a 1 dans ce cas)
function fact($n)
{
  if($n==0) {
    return 1;
  } else {
    return $n*fact($n-1); //s'apelle elle meme
  }
}
//echo fact(10);

//POUR FORMULAIRE pour que l'user rendre un nombre (pas négatif, qui ne dépasse pas 170)
if ( isset($_POST['inputNb']) && $_POST['inputNb'] < 170 && $_POST['inputNb'] > 0){

    echo "Le resultat est ". fact((int)$_POST['inputNb']);

    } else {

    echo "Inserez un numero entre 1 et 160"; //SI QUEREMOS NUMEROS MAYORES A 160? HAY QUE DESCARGAR EXTENSION PHP BCMATH
    }

?>
</div>

<?php
  //voici un exemple de VALIDATION DE FORMULAIRE.
  //expliquer ce que signifie trim, stripslashes et htmlspecialchars
	// define variables and set to empty values
	$nameErr = $emailErr = $genderErr = $websiteErr = ""; //EGAL CHAINE VIDE? POUR INITIALIZER VARIABLE
	$name = $email = $gender = $comment = $website = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") { //ON TESTE SI FORMULAIRE BIEN ENVOYE
		if (empty($_POST["name"])) {
			$nameErr = "Name is required"; //SI NOM DANS FORMULAIRE VIDE
		}else {
			$name = test_input($_POST["name"]); //CE QU4ON RECUPERE DU FORMULAIRE? FX TEST_INPUT
		}

		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		}else {
			$email = test_input($_POST["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format";
			}
		}

		if (empty($_POST["website"])) {
			$website = "";
		}else {
			$website = test_input($_POST["website"]);
		}

		if (empty($_POST["comment"])) {
			$comment = "";
		}else {
			$comment = test_input($_POST["comment"]);
		}

		if (empty($_POST["gender"])) {
			$genderErr = "Gender is required";
		}else {
			$gender = test_input($_POST["gender"]);
		}
	}

	function test_input($data) {
		$data = trim($data); //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
		$data = stripslashes($data);//stripslashes — Supprime les antislashs d'une chaîne
		$data = htmlspecialchars($data);//htmlspecialchars — Convertit les caractères spéciaux en entités HTML
		return $data;
	}
  ?>

<!-- //*******EXAMPLE AUTRE FACON DE FAIRE*******//// -->
<?php
// function fact($n) {
//     if ($n == 0) {
//         return 1;
//     } else {
//         return $n*fact($n-1);
//     }
// }
//echo fact(6);
?>

<!-- <form method="post">
    <div class="form-group">
        <input name="number" type="text" class="form-control" placeholder="Entrez un nombre">
    </div>
    <button type="submit" class="btn btn-primary">Ok</button>
</form> -->

<?php
// // Au lancement du formulaire, si le formulaire est vide on affiche le message "Entrez un nombre compris entre 1 et 170"
// if ( !isset($_POST['number']) || $_POST['number'] == '' ) {
//     echo "Entrez un nombre compris entre 1 et 170";
//     //On teste que l'utilisateur rentre bien un nombre ou un chiffre et non une chaîne de caractère ou un caractère.
// } else if (!is_numeric($_POST['number'])) {
//         echo "Les lettres ne sont pas acceptées, vous devez entrer un chiffre";
// //On teste que l'utilisateur entre un nombre supérieur à 0. Dans le cas contraire on affiche le message.
// } else if (($_POST['number']) <= 0) {
//     echo"Entrez un nombre supérieur à 0";
// //On teste que l'utilisateur rentre un nombre inférieur à 170. Dans le cas contraire on affiche le message.
// } else if (($_POST['number']) > 170) {
//     echo"Entrez un nombre inférieur à 170";
// //On lance la fonction pour calculer le factoriel.
// } else {
//     echo fact($_POST['number']);
// }
//


 ?>










<?php
// function fact($n)
// {
//   if($n==0) {
//     return 1;
//   } else {
//     return $n*fact($n-1); //s'apelle elle meme
//   }
// }
// echo fact(10);
?>










<?php
    include "./footer.php";
?>
