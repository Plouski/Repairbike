<?php
require 'header.php';
?>
<body>
  <?php
  if (!isset($_SESSION['idS'])){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }

  $id= $_SESSION['id'];
  $idS=$_SESSION['idS'];

  //Date
  $date = $_POST['date_intervention'];
  $today=date("Y-m-d");
  $dateTimestamp1 = strtotime($today);
  $dateTimestamp2 = strtotime($date);

  //Adresse
  $adresse = $_SESSION['adresse'];
  $ville = $_SESSION['ville'];
  $cp = $_SESSION['codepostal'];
  $rayon = $_SESSION['rayon_intervention'];
  $depart = $_POST['adresse_intervention'];
  $arrivee   = $adresse.' '.$ville.' '.$cp;
  $distance = calcDistance($depart, $arrivee);

//Verfier si la date n'est pas avant aujourd'hui
  if ($dateTimestamp2 < $dateTimestamp1 ){
  echo "<h1 style='color: red'>Date invalide : elle ne peut pas être antérieure à la date du jour</h1><br>";
  echo "<p><a href='javascript:history.back()'>Retour</a></p>";
}

//Verfier si l'adresse ne depasse pas le rayon
  else if ($distance > $rayon){
  echo "<h1 style='color: red'>Intervention impossible : votre adresse est au delà du rayon d'intervention</h1><br>";
  echo "<p><a href='javascript:history.back()'>Retour</a></p>";
}

   else {
    $req = 'INSERT into demande (date_intervention, adresse_intervention, id_service, id_client, remise_demande, message, tarif_demande)
    VALUES (:dateI,:adresse,:idS,:idC, :remise, :message, :tarif)';
    $res = $bdd->prepare($req);
    // $res->bindParam(':dateD', $_POST['date_demande'], PDO::PARAM_STR);
    $res->bindParam(':dateI', $_POST['date_intervention'], PDO::PARAM_STR);
    $res->bindParam(':adresse', $_POST['adresse_intervention'], PDO::PARAM_STR);
    // $res->bindParam(':etat', 'ENVOYEE', PDO::PARAM_STR);
    $res->bindParam(':idS', $idS, PDO::PARAM_STR);
    $res->bindParam(':idC', $id, PDO::PARAM_STR);
    $res->bindParam(':remise', $_POST['remise_demande'], PDO::PARAM_STR);
    $res->bindParam(':message', $_POST['message'], PDO::PARAM_STR);
    $res->bindParam(':tarif', $_POST['tarif_demande'], PDO::PARAM_STR);
    try{
      $res->execute();
      echo "<h2 style='color:white'>Merci pour votre réservation !</h2><br>";
      echo "<p><a href='mesdemandes.php'>Voir mes demandes</a></p>";
    }
    catch (Exception $e){
      oups("Erreur grave dans la réservation",$e->getMessage(),"1","index.php");
    }
  }
  ?>
</body>
</html>
