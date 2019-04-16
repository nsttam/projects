<?php
  $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>


    <!-- Formulaire avec méthode post -->
    <div class="container">
        <form method="post">
          <div class="form-group">
            <label for="exampleInputAge">Age</label>
            <input type="number" name="age" class="form-control" id="age" aria-describedby="ageHelp" placeholder="Entrez votre âge ">
          </div>
          <div class="form-group">
            <label for="exampleInputPays">Pays</label>
            <input type="text" name="pays" class="form-control" id="pays" aria-describedby="paysHelp" placeholder="Entrez votre pays ">
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>


<?php

    // Fonction qui vérifie si on est majeur selon le pays.
    function isMajeur($age, $pays){

            // Switch qui vérifie si le pays est correct.
            switch($pays){
                case "fr":
                    $majeur = 18;
                    break;
                case "usa":
                    $majeur = 21;
                    break;
                case "yemen":
                    $majeur = 15;
                    break;
                default :
                    $majeur = 0;
                    break;
            }

            // If qui vérifie si on est majeur ou mineur.
            if ($age >= $majeur){
                // Ici on est majeur.
                echo "On est majeur quand on a $age ans dans le pays $pays.";
            }else if($age == 1){
                // Ici on est mineur avec 1 an (pour orthographe).
                echo "On est mineur quand on a $age an dans le pays $pays.";
            }else if($age < 0){
                // Ici l'âge est incorrect (en négatif).
                echo "Veuillez entrer un âge correct";
            }else{
                // Ici on est mineur.
                echo "On est mineur quand on a $age ans dans le pays $pays.";
            }
     }


    //  If qui vérifie si l'âge et le pays sont entrés et corrects.
    if ( isset($_POST['age']) && isset($_POST['pays']) && $_POST['pays'] != '' && $_POST['age'] != '') {

        /* Si tout est correct on lance la fonction. On récupère l'âge et le pays du formulaire.
        strtolower pour mettre tout en minuscule. */

        isMajeur( (int)$_POST['age'], strtolower($_POST['pays']) );
    } else {
        // Si ce n'est pas correct on affiche une erreur.
        echo "Veuillez entrer un âge et un pays.";
    }

?>
    <!-- Fin du container -->
    </div>

<?php
    include "./footer.php";
?>
