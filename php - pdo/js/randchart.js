function randchart_draw(nbmonths=12) {
    // console.log(nbmonths);
    var url = window.location.origin + '/public/api/randchart_getjson.php?nb_month=' + nbmonths;

    console.log(url);

    $.ajax({
    url: url,
    method: "GET",
    success: function(data) {

    console.log(data);
    var month = [];
    var temp = [];

    $(jQuery.parseJSON(data)).each(function() {
    month.push(this.month);
    temp.push(this.temp);
});

    var chartdata = {
    labels: month,
    datasets : [
        {
            label: 'Temperatures',
            fill: false,
            backgroundColor: 'rgba(254, 62, 35, 0.5)',
            borderColor: 'rgba(254, 62, 35, 0.5)',
            data: temp
        }
    ]
};

    document.getElementById("randchart_container_id").innerHTML = '&nbsp;';
    document.getElementById("randchart_container_id").innerHTML = '<canvas id="randchart_canvas_id"></canvas>';
    var ctx = document.getElementById("randchart_canvas_id").getContext("2d"); //endroit (le canvas) ou le graphique s'affiche
    var barGraph = new Chart(ctx, {
    type: 'line',
    data: chartdata
});

},
    error: function(data) {
    console.log(data);
}
});
};








// function randchart_draw(nbmonths=12) {
//si numero mois pas defini, sera 12//lance al hacer click en buton
//        //console.log(nbmonths); pour voir si fx recure nb mois
//       var url = window.location.origin + '/api/randchart_getjson.php?nbmonths=' + nbmonths; // cette appele retourne json
//       $.ajax({
//           url: url,
//           method: "GET",
//           success: function(data) { /*si requete a serveur se passe bien, si l'echange ajax s'est bien passe,
//           je recupere json en data*/
//
//               //console.log(data);
//           var month = [];
//           var temp = [];
//
//               $(jQuery.parseJSON(data)).each(function() { //pour prendre pour chaque mois json recu, et pour le mettre dans tableau
//                    month.push(this.month);
//                    temp.push(this.temp);
//               });
//             var chartdata = {
//                   labels: month,
//                   datasets : [
//                       {
//                           label: 'Temperatures',
//                           fill: false,
//                           backgroundColor: 'rgba(254, 62, 35, 0.5)',
//                           borderColor: 'rgba(254, 62, 35, 0.5)',
//                           data: temp //est un tableau
//                       }
//                   ]
//  			  document.getElementById("randchart_container_id").innerHTML = '&nbsp;'; //je mets rien ca s'est pour effacer graphique precedent
//         document.getElementById("randchart_container_id").innerHTML = '<canvas id="randchart_canvas_id"></canvas>';
//         var ctx = document.getElementById("randchart_canvas_id").getContext("2d"); //inserer graphique
//         var barGraph = new Chart(ctx, {
//             type: 'line',
//             data: chartdata
//               });
//
//           },
//           error: function(data) {
//               console.log(data);
//           }
//       });
//   }
// };
//
