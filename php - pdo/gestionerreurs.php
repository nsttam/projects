<?php
  $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>

<!-- FUNCTION DIE -->
<?php
    // if (!file_exists("/tmp/test.txt")) {
    //   //die("File not found"); //apres fx die, rien s'affiche, meme pas le footer// Elle coupe le script
    //   echo "File not Found"; //coupe pas script
    // } else{
    //   $file = fopen("/tmp/test.txt", "r");
    //   print "Opened file successfully";
    // }

//TRY CATCH FINALLY
    // try
    // {
    //   $fileName= "/tmp/test.txt";
    //   if (!file_exists($fileName)){
    //     throw new Exception("File not found");
    //
    //   }
    //
    // } catch (Exception $e){ //on recupere erreur
    //     //var_dump($e);
    //     echo "Exception line :", $e->getLine() ," on File : ", $e->getFile() ," Error : ", $e->getMessage() ;
    // } finally {
    //     echo "Test Finally";
    // }

    // function division(number $dividend, number $divisor): number{
    //   echo $dividend/$divisor;
    //   }
// function inverse($x)
//     {
//       if (!$x) { //if $x different 0!!! if $x faux
//           throw new Exception('Division par zéro.');
//       }
//       return 1/$x;
// try {
//         echo inverse(5) . "\n";
//     } catch (Exception $e) {
//         echo 'Exception reçue : ',  $e->getMessage(), "\n";
//     } finally {
//         echo "<br> Première fin.\n";
//     }
//
// try {
//         echo inverse(0) . "\n";
//     } catch (Exception $e) {
//         echo 'Exception reçue : ',  $e->getMessage(), "\n";
//     } finally {
//         echo "<br> Seconde fin.\n";
//     }
//
// // On continue l'exécution
//       echo "Bonjour le monde !\n";
//
function inverse($x) {
    if (!$x) {
        throw new Exception('Division par zéro.');
    }
    return 1/$x;
}

try {
    echo inverse(5) . "\n";
} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
} finally {
    echo "Première fin.\n";
}

try {
    echo inverse(0) . "\n";
} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
} finally {
    echo "Seconde fin.\n";
}

// On continue l'exécution
echo "Bonjour le monde !\n";

?>
<?php
  include "./footer.php";
?>
