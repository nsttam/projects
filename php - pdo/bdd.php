<?php
$page = __FILE__;
include "./header.php";
include "./navbar.php";


$server = "localhost";
$user = "root";
$password = "";
$database = "testdrive";

// 1) connexion à la base de donnée
$mysqli = new mysqli($server, $user, $password, $database); //je suis connecte seulement a mysqm
if (mysqli_connect_error()){
    die('Erreur de connexion (' .mysqli_connect_errno().')'
    .mysqli_connect_error());
}
echo 'Succès...'.$mysqli->host_info."\n";


/*Requête "SELECT" retoure un jeu de résultat*/

$sql = "SELECT title FROM Book LIMIT 10";
if($result = $mysqli->query($sql)) {
    printf("SELECT a retourné %d lignes.\n", $result->num_rows);

    /*Libération du jeu de résultats*/

    $result->close();
}


//Lecture de lignes
$sql = "SELECT title, price FROM Book LIMIT 10"; //
if($result = $mysqli->query($sql)) {
    while($row = $result->fetch_assoc()){
    printf("%s(%s)\n", $row["title"], $row["price"]);
    //affihce et apres chaque virgule, on a des variables %s chaine de carachteres, pour eviter des erreur
}

    /*Libération du jeu de résultats*/

    $result->close();
}


// 2) Drop table car
$table = "car";
//sprintf enlève tous les caractères spéciaux
$query = sprintf("DROP TABLE IF EXISTS $database.$table");
try {
    //excute query
    //on essaie de faire la requete
    $result = $mysqli->query($query);
    echo '<br>Table $database.$table bien effacée';
    var_dump($result);
    //s'il y a une erreur, on tombe dans le catch
} catch (Exception $e){
    echo '<br>Exception received: ', $e->getMessage(), "\n";
} finally {
    //echo "<br>Table $table created.";
}

// 3) Create table car
$table = "car";
$query = sprintf("  CREATE TABLE IF NOT EXISTS $database.$table(
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        price DECIMAL(5,2) NOT NULL,
                        title VARCHAR(30) NOT NULL,
                        created_at TIMESTAMP DEFAULT NOW(),
                        updated_at TIMESTAMP DEFAULT NOW()
                    )"
                );
try{
    //excute query
    $result = $mysqli->query($query);
    //var_dump($result);
} catch (Exception $e){
    echo '<br>Exception received: ', $e->getMessage(), "\n";
} finally {
    //echo "<br>Table $table created.";
}



    // 4) Insertion données
    //créer quatre voitures avec quatre prix sur une requete sql
    //recopier le code du dessus et le modifier

?>




<?php
include "./footer.php";
?>
