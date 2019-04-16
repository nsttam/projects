// // Int map center with Paris latitude and longitude
// var lat = 48.852969;
// var lon = 2.349903;
// var macarte = null;
// var markerClusters; // To stocker groups of markers
//
// // Init some markers in a list
// var villes = {
//     "Paris": {
//         "lat": 48.852969,
//         "lon": 2.349903
//     },
//     "Brest": {
//         "lat": 48.383,
//         "lon": -4.500
//     },
//     "Quimper": {
//         "lat": 48.000,
//         "lon": -4.100
//     },
//     "Bayonne": {
//         "lat": 43.500,
//         "lon": -1.467
//     }
// };
// // Inti map
// function initMap() {
//     var markers = []; // Marker list initialisation
//     // Create map objet "macarte" and insert it in HTML element with ID "map"
//     macarte = L.map('map').setView([lat, lon], 11);
//     markerClusters = L.markerClusterGroup(); // Markers groups initialisation
//     // Leaflet never ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous sou
//     L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
//         // Il est toujours bien de laisser le lien vers la source des données
//         attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM FRANCE</a>',
//         minZoom: 1,
//         maxZoom: 20
//     }).addTo(macarte);
//     // Nous parcourons la liste des villes
//     for (ville in villes) {
//         //var marker = L.marker([villes[ville].lat, villes[ville].lon]).addTo(macarte);
//         // Nous ajoutons la popup. A noter que son contenu (ici la variable ville) peut être du HTML
//         //marker.bindPopup(ville);
//         var marker = L.marker([villes[ville].lat, villes[ville].lon]); // pas de addTo(macarte), l'affichage sera géré
//         marker.bindPopup(ville);
//         markerClusters.addLayer(marker); // Nous ajoutons le marqueur aux groupes
//         markers.push(marker); // Nous ajoutons le marqueur à la liste des marqueurs
//     }
//     var group = new L.featureGroup(markers); // Nous créons le groupe des marqueurs pour adapter le zoom
//     macarte.fitBounds(group.getBounds().pad(0.5)); // Nous demandons à ce que tous les marqueurs soient visibles, et aj
//     // Add marker Cluster to map
//     macarte.addLayer(markerClusters);
// }
// window.onload = function () {
//     // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
//     initMap();
// };
//




// Int map center with Paris latitude and longitude
var lat;
var lon;
//var macarte = null;
var markerClusters; // To stocker groups of markers

//fonction longitude latitude pour l'adresse
function getLongLat() {
    /* console.log("hello"); */
    address = document.getElementById("address_id").value;
    console.log("address=" + address);
    // On complète le GET avec le nb_name
    var url = window.location.origin + '/public/api/map_api.php?address=' + address;

    $.ajax({
	  url: url,
	  method: "GET",
		success: function(data) {
            console.log(url);
            console.log(data);

			$(jQuery.parseJSON(data)).each(function() {
               lat = this.lat;
               lon = this.lon;
            });
            initMap(lat, lon);

		},
		error: function(data) {
			console.log(data);
		}
	});
};
    //console.log(address);


// Init map
function initMap(latArg, lonArg) {
    console.log("latitude : " + latArg);
    console.log("longitude : " + lonArg);

    if(typeof(macarte) === 'undefined') {
        //var markers = []; // Marker list initialisation
        // Create map objet "macarte" and insert it in HTML element with ID "map"
        macarte = L.map('map').setView([latArg, lonArg], 11);
        // markerClusters = L.markerClusterGroup(); // Markers groups initialisation
        // Leaflet never ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous sou
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM FRANCE</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(macarte);
        console.log(typeof(macarte));
    }
    // Nous parcourons la liste des villes
    L.marker([latArg, lonArg]).addTo(macarte); // pas de addTo(macarte), l'affichage sera géré
}
