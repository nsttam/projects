<?php
  $page = __FILE__;
  include "./header.php";
  include "./navbar.php";
?>
<?php
    class Book {
      //member variables
        var $price;
        var $title;
        function __construct($par1, $par2){ //permets de definir parametres d'objet
          $this->title=$par1;
          $this->price=$par2;
        }

        //Setter functions
        function setPrice($par) {
            $this -> price = $par;
        }
        function getPrice() {
            echo $this->price. "</b>";
        }
        function setTitle ($par) {
            $this -> title = $par;
        }
        function getTitle() {
            echo $this->title. '</br>';
        }

        function __destruct() {
          echo("Destruction de l'objet"); //Pour detruir les objets
        }
    }



    $physics = new Book ("kllljk", 20); //il s'attend d'avoir 2 parametres quand on utilise constructeur
    $maths = new Book ("",1);
    // $chemistry = new Book;
    echo "<br/>Retourne le nom de la classe d'un objet";
    echo"</br>". get_class($maths);

      echo "<br/>Retourne le nom des methodes d'une classe";
      foreach (get_class_methods($maths) as $method_name){
        echo"</br>$method_name";
            }





    $physics->setTitle ("Atoms");
    $maths->setTitle ("Algebra");
    $physics->setPrice (10);
    $maths->setPrice (7);
    var_dump ($physics, $maths);

    $physics->getTitle();
    $physics->getPrice();






















    // $datas = ["php",5, "Python", 10,"Css", 12,"Javascript", 9, "Algorithm", 6];
    // $books = [];
    // for ($i=0; $i < 10; $i+=2) {
    //     array_push($books,new Book($datas[$i],$datas[$i+1]));
    // }
    // var_dump($books);



?>
<?php
    include "./footer.php";
?>
