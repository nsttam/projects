<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="/public/"> <!--/public/ pour rester sur page d'accueil quand on clique sur photo-->
    <img src="photo.jpg" class="rounded-circle" width="30" height="30" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">


    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item <?php echo ($page == "index" ? "active" : "") ?>">
        <a class="nav-link" href="/public/index.php">Home</a>
      </li>

      <li class="nav-item <?php echo ($page == "info" ? "active" : "") ?>">
        <a class="nav-link" href="/public/info.php">Info</a>
      </li>


      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Part 1
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/public/index.php">Index</a>
            <a class="dropdown-item" href="/public/info.php">Info</a>
            <a class="dropdown-item" href="/public/variable.php">Variable</a>
            <a class="dropdown-item" href="/public/estructure.php">Estructure</a>
            <a class="dropdown-item" href="/public/jeu.php">Jeu</a>
            <a class="dropdown-item" href="/public/fonctions.php">Fonctions</a>
            <a class="dropdown-item" href="/public/formulaire.php">Formulaire</a>
            <a class="dropdown-item" href="/public/parametres.php">Parametres fonctions</a>
            <a class="dropdown-item" href="/public/fichier.php">Fichier</a>
            <a class="dropdown-item" href="/public/setcookie.php">Cookie</a>
            <a class="dropdown-item" href="/public/mail.php">Mail</a>
            <a class="dropdown-item" href="/public/gestionerreurs.php">Gestion erreurs</a>
            <a class="dropdown-item" href="/public/chart.php">Chart</a>
            <a class="dropdown-item" href="/public/fxrecursive.php">Recursive</a>
            <a class="dropdown-item" href="/public/xml.php">XML</a>
            <a class="dropdown-item" href="/public/json.php">JSON</a>
            <a class="dropdown-item" href="/public/api.php">API</a>
            <a class="dropdown-item" href="/public/fichier.php">Fichier</a>
            <a class="dropdown-item" href="/public/fake.php">Fake Test</a>
            <a class="dropdown-item" href="/public/map.php">Map</a>
            <a class="dropdown-item" href="/public/exam.php">Examen</a>

          </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Part 2
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/public/books.php">Books</a>
          <a class="dropdown-item" href="/public/bdd.php">BDD</a>
          <a class="dropdown-item" href="/public/database.php">BDD Example</a>
          <a class="dropdown-item" href="/public/database_pdo.php">PDO</a>
          <a class="dropdown-item" href="/public/pratiquepdo.php">Pratique PDO</a>
          <a class="dropdown-item" href="/public/index_php.php">Example create/update/delete PDO</a>
        </div>
      </li>

      <li class="nav-item <?php echo ($page == "seed" ? "active" : "") ?>">
        <a class="nav-link" href="/public/seed_php.php">EXAMEN PDO</a>
      </li>


    </ul>


    <form class="form-inline my-2 my-lg-0">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    </ul>
    <?php
      echo '<span class="badge badge-info">User: ';
      if (isset($_SESSION['user'])) {
        echo $_SESSION['user'] . "</span>";
      } else {
        echo "anonymous</span>";
      }
      ?>
    </form>
    <form class="form-inline my-2 my-lg-0">
      <?php echo '<span class="badge badge-info">Visited: ' . $_SESSION['counter'] . '</span>'; ?>
    </form>
  </div>
</nav>

<div id="messages">
</div>
