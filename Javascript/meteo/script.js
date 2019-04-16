document.addEventListener("DOMContentLoaded", function () {

    /*########################################################
       Créer une fonction qui récupère les données en AJAX puis affiche le résultat dans la div myDiv
    ########################################################*/
    function meteoVille(endURL) {
        // Création de la variable url en fonction de la ville qui sera utilisée dans request.open
        var url = `https://www.prevision-meteo.ch/services/json/${endURL}`;
        /*#################################
                Création de la requete AJAX
        #################################*/
        // Requète AJAX qui requepere les données météos dans un Json
        var request = new XMLHttpRequest();
        // Préparation de la requête
        request.open("GET", url);
        // Préparation de la requête
        request.send();

        /*#################################
                Gestion du DOM
        #################################*/
        // Récupération de la div ou on écrira les données
        var myDiv = document.getElementById("myDiv");
        // Je vide la div et je lui attribut un message
        myDiv.innerHTML = "<br /><br />Réception des données...";

        /*#################################
                Gestion de la réponse à la requete
        #################################*/
        request.onreadystatechange = function () {

            //    console.log("Code du changement d'etat de la requete : " + this.readyState);

            if (this.readyState == 4) {
                if (this.status == 200) {
                    onsuccess(this.responseText);
                } else {
                    console.log("Error", this.status, this.statusText);
                }
            }
        };


        // Fonction onsuccess qui fera qq chose si le json est bien récupéré
        function onsuccess(responseText) {
            var jsobject = JSON.parse(responseText);
            /*########################################################
                Vide la div avec id="myDiv dans fichier html
            ########################################################*/
            myDiv.innerHTML = "";

            /*########################################################
                Créer le titre qui afficher la nom de la ville
            ########################################################*/
            //Créer un titre qui contient le nom de la ville
            var cityName = document.createElement("h2");
            //Ajouter le nom de la ville dans le contenu du titre (var cityName)
            cityName.innerHTML = jsobject.city_info.name;
            //Ajoutyer cityName en tant qu'enfant de myDiv
            myDiv.appendChild(cityName);

            /*########################################################
                Crée une boucle qui affichera les valeurs pour tous les jours
            ########################################################*/
            for (var object in jsobject) {
                // Si le sous objet de l'objet jsobject
                if (jsobject[object].day_long) {
                    // Création du contenu des différents paragraphes
                    var contentDay = jsobject[object].day_long + " " + jsobject[object].date + " | " + jsobject[object].condition + " | temp max : " + jsobject[object].tmax + " | temp min : " + jsobject[object].tmin;
                    // Création du paragraphe, puis injection du contenu et enfin insertion en tant qu'enfant de myDiv
                    var newP = document.createElement("p");
                    newP.innerHTML = contentDay;
                    myDiv.appendChild(newP);
                }
            }
        }
    }


    /*########################################################
       Affichage de la carte => https://leafletjs.com/
    ########################################################*/

    function initMap() {
        var mymap = L.map('mapid').setView([45.427702286483154, 4.404432305730991], 9);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoiZ3JlZ2Rlc3BsYWNlcyIsImEiOiJjanF6N2RnMjUwYWlyNDRwbzByM2w2bXI4In0.q3hMtLnKUGWZAVWI90UKiQ'
        }).addTo(mymap);

        //Création de trois markers pour les trois villes de la carte
        var markerSaintEtienne = L.marker([45.427702286483154, 4.404432305730991]).addTo(mymap);
        var markerMontbrison = L.marker([45.6083962, 4.0765466]).addTo(mymap);
        var markerAnnonay = L.marker([45.2399639, 4.6675475]).addTo(mymap);

        markerAnnonay.addEventListener("click", function () {
            meteoVille("annonay");
        });
        markerMontbrison.addEventListener("click", function () {
            meteoVille("montbrison");
        });
        markerSaintEtienne.addEventListener("click", function () {
            meteoVille("saint-etienne-42");
        });

    }
    
    initMap();


});
