<?php
       // $page = basename(__FILE__);
       // include "./header.php";
       // include "./navbar.php";
   ?>
   <!-- links map -->
   <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
      integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
      crossorigin="" />
   <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
   <link rel="stylesheet" type="text/css"
      href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
   <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
      integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
      crossorigin=""></script>
   <script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'>
   </script>
   <script src="js/map.js"></script>


<style type="text/css">
    #map {
        /* Map must have a with and an height */
        height: 400px;
        width: 400px;
    }
</style>
<title>Carte</title>
<div id="map">
    <!-- The map will be here -->
<!-- </div>
<div>
  <form method="post">
    <div class="form-group mt-2 text-center">
      <label for="inputMois">Inserez une addresse</label>
      <input type="text" name="address" class="form-control" id="addressId" aria-describedby="addressHelp" placeholder="Inserez une addresse">
    </div>
    <button type="submit" class="btn btn-primary">Obtenir Latitude et longitude</button>
  </form>
  <div class ="mt-4 mb-4">
        <p>Latitude:
            <input type="text" id="latitude" readonly />
        </p>
        <p>Longitude:
            <input type="text" id="longitude" readonly />
        </p>
    </div>
</div> --> -->


<?php
    // include "./footer.php";
  ?>



  <?php     //EXERCISE CHARLOTTE
    $page = basename(__FILE__);
    include "./header.php";
    include "./navbar.php";
  ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    <script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'></script>
    <script src="js/map.js"></script>
    <style type="text/css">
      #map {
          /* Map must have a with and an height */
          height: 400px;
          width: 400px;
      }
  </style>
  <title>Carte</title>
  <div id="map">
      <!-- The map will be here -->
  </div>
  <!--ajout d'un bouton pour appeler le js et ajax)  -->
  <form method="post">
      <div class="form-group">
          <input id="address_id" name="text" type="text" class="form-control" placeholder="Entrez une adresse">
      </div>
  </form>
  <button class="btn btn-outline-danger" onclick="getLongLat()">Entrer une Adresse</button>



  <?php
      include "./footer.php";
    ?>
