<?php
  $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>

<?php


$json = '{
  "root": {
    "artist": [
      {
        "id": "1",
        "lastname": "John",
        "firstname": "Coltrane",
        "instrument": "Saxophone"
      },
      {
        "id": "2",
        "lastname": "Miles",
        "firstname": "Davis",
        "instrument": "Trumpet"
      }
    ]
  }
}';

// echo "<h3>vardump json</h3>";
// var_dump($json); //simple
// echo "<h3>vardump json_decode</h3>";
// var_dump(json_decode($json));//objets d'objets
// echo "<h3>vardump json_decode (\$json = true)</h3>";
// var_dump(json_decode($json, true));//array
echo "<h3>Parse json</h3>";
$parsed_json = json_decode($json);
echo "<h3>Parse json</h3>";
// echo "<p>". $parsed_json->{'root'}->{'artist'}[0]->{'instrument'}."</p>";
// echo "<p>". $parsed_json->{'root'}->{'artist'}[1]->{'instrument'}."</p>";

foreach ($parsed_json->{'root'}->{'artist'} as $value){ //para no repetir 0 1 2 etc, pour simplifier le code d'avant
  echo "<p>". $value->{'instrument'}. $value->{'id'}."</p>";
}


exit;



?>









<?php
    include "./footer.php";
?>
