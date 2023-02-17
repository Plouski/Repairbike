<?php
require 'header.php';
$req = "SELECT * FROM user inner join service on user.U_id = service.id_reparateur";
$res = $bdd->prepare($req);
try{
  $res->execute();
  $data   = $res->fetchAll();
}
catch(Exception $e){
  oups("Erreur grave",$e->getMessage(),"1","login.php");
}
?>
<head>
  <style>
  #map {
    height: 70%;
  }
  html, body {
    height: 100%;
  }
</style>
</head>
<body>
<h1 style="color:white">Les réparateurs</h1><br>
<div id="map"></div>
<script>
  // Initialisation de la map
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: new google.maps.LatLng(46.6167, 1.85),
    zoom: 6
  });

  var results = <?= json_encode($data); ?>

  setMarkers(map,results);
}

function setMarkers(map,locations) {
  for(var i=0; i<locations.length; i++){
    var station = locations[i];
    var myLatLng = new google.maps.LatLng(station['latitude'], station['longitude']);
    var infoWindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
      position: myLatLng,
      //icon:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
      map: map,
    });

    (function(i){
      google.maps.event.addListener(marker, "click",function(){
        var station = locations[i];
        infoWindow.close();
        infoWindow.setContent(
          "<div id='infoWindow'>"+
          "<h4>"+station['prenom']+" "+station['nom']+"</h4>"+
          "<a href=\"mailto:"+station['email']+"\">"+station['email']+"</a><br><br>"+
          +station['tel']+
          "</div>"
        );
        infoWindow.open(map,this);
      });
    })(i);
  }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDF97xgWtVSdeElsdfbPj1-j6rCSFSX2Vc&callback=initMap"></script>
</body>
</html>
