<?php
require 'header.php';
  if (isset($_GET['S_id'])){
    $id= $_GET['S_id'];
  }
  else {
  oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $req = "SELECT * FROM user inner join service on user.U_id = service.id_reparateur where S_id= :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res->execute();
  }
  catch(Exception $e){
    oups("Erreur grave",$e->getMessage(),"1","login.php");
  }
  while($correspondant = $res->fetch(PDO::FETCH_ASSOC)) {
  $titre = $correspondant['titre'];
  $latitude = $correspondant['latitude'];
  $longitude = $correspondant['longitude'];
  $rayon = $correspondant['rayon_intervention'];
?>
  <style>
    #laCarte{
      height: 400px;
      width:700px;
      margin : auto;
    }
  </style>
</head>
<body>
  <div id="laCarte"></div>
  <script>
  function initMap(){
    var options = {
      zoom:13,
      center : {lat:<?=$latitude?>,lng: <?=$longitude?>}
    }

    var maCarte = new google.maps.Map(document.getElementById('laCarte'), options);

    var monMarker = new google.maps.Marker({
      position:{lat:<?=$latitude?>,lng: <?=$longitude?>},
      map:maCarte,
    });

    var circle = new google.maps.Circle({
      map: maCarte,
      //radius: 3000,
      radius : <?=$rayon?>000,
      fillColor: '#AA0000'
    });

    circle.bindTo('center', monMarker, 'position');

    var monInfoWindow = new google.maps.InfoWindow({
      content:"<p><?=$titre?></p>"
    });
    
    monMarker.addListener('click',function(){
      monInfoWindow.open(laCarte,monMarker);
    });
  }
  <?
}
?>
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDF97xgWtVSdeElsdfbPj1-j6rCSFSX2Vc&callback=initMap">
</script>
</body>
</html>
