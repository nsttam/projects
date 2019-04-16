<?php
  $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>

<!-- creation formulaire -->
  <form method="post">
    <div class="form-group">
      <label for="to" class = "font-weight-bold">To</label>
      <input type="string" name="to" class="form-control" placeholder="To">
    </div>
    <div class="form-group">
      <label for="CC" class = "font-weight-bold">cc</label>
      <input type="text" name="cc" class="form-control" placeholder="From">
    </div>
    <div class="form-group">
      <label for="objet_mail" class = "font-weight-bold">Objet</label>
      <input type="text" name="objet_mail" class="form-control" placeholder="Objet">
    </div>
    <div class="form-group">
      <label for="message" class = "font-weight-bold">Message</label>
      <textarea type="string" name="message" class="form-control">
      </textarea>
    </div>
    <button type="submit" class="btn btn-danger">Envoyer</button>
  </form>


<?php
//from est constante , doit etre la meme addresse mail qu'on a mis sur  fichier sendmail.ini
if ( isset($_POST['to']) && isset($_POST['objet_mail']) &&
      isset($_POST['message']) && $_POST['to'] != '' && $_POST['message'] != '' &&
      isset($_POST['cc']) && $_POST['cc'] != '' && $_POST['objet_mail'] != '' ) {

      $header = "From:mbrunetti@humanbooster.com \r\n";
      $header .= "Cc:".$_POST['cc']."\r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";

    $result = mail($_POST['to'], $_POST['objet_mail'],$_POST['message'], $header);
} else {
    // Si ce n'est pas correct on affiche une erreur.
    echo "Completez les champs";
}



 //  $to = "travagnan@humanbooster.com";
 //  $subject = "This is a subject";
 //
 //  $message = "<b>This is an html message </b>";
 //  $message .= "<h1>This is a headline</h1>";
 //
 //  $header = "From:abc@somedomain.com \r\n";
 //  $header .= "Cc:afgh@somedomain.com \r\n";
 //  $header .= "MIME-Version: 1.0\r\n";
 //  $header .= "Content-type: text/html\r\n";
 //
 //   // Envoi du mail avec destinataire, titre, message et envoyeur
 // $result = mail($to,$subject,$message,$header);
 //    if ($result){
 //        echo "success";
 //    }else{
 //        echo "failed";
 //    }


?>
















<?php
include "./footer.php";
?>
