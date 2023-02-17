<?php
require 'header.php';
?>
<body>
  <?php
  if (!isset($_SESSION['id_update'])){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $id=$_SESSION['id_update'];
  $req = "UPDATE demande SET date_intervention = :date, adresse_intervention = :adresse, message = :message where id= :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  $res->bindParam(':date', $_POST['date_intervention'], PDO::PARAM_STR);
  $res->bindParam(':adresse', $_POST['adresse_intervention'], PDO::PARAM_STR);
  $res->bindParam(':message', $_POST['message'], PDO::PARAM_STR);
  try{
    $res->execute();
  }
  catch (Exception $e){
    oups("Erreur grave dans la modification",$e->getMessage(),"1","<a href='mesdemandes.php'>Retour à mes demandes</a>");
  }
  $count = $res->rowCount();
  if($count =='0'){
    oups("Erreur dans la modification","Aucune ligne n'a été modifiée","2","mesdemandes.php");
  }
  else{
    echo "<h2 style='color:white'>Votre demande a bien été modifiée !</h2><br>";
    echo "<p><a href='mesdemandes.php'>Voir mes demandes</a><p>";
  }
?>
</body>
</html>
