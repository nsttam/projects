<?php
      //  //pour emulate browser
      //  $context = stream_context_create(
      //      array(
      //          "http" => array(
      //              "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
      //          )
      //      )
      //  );
      //
      // $url = 'https://nominatim.openstreetmap.org/search?q=1%20place%20Bellecour&format=json&addressdetails=1';
      // echo file_get_contents("$url", false, $context);

?>

<?php //CORRECTION CHARLOTTE
       $context = stream_context_create(
           array(
               "http" => array(
                   "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
               )
           )
       );
       $address = urlencode($_GET['address']);
       $url = "https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&q=$address";
    // Return the json !
	echo file_get_contents($url, false, $context);
  ?>
