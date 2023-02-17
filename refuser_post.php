<?php
require 'navbarReparateur.php';
?>
<body>
  <?php
  if (!isset($_SESSION['id_refuser'])){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $id=$_SESSION['id_refuser'];
  $req = "UPDATE demande SET etat_intervention = 'REFUSEE' where id= :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res->execute();
  }
  catch (Exception $e){
    oups("Erreur grave dans l'annulation",$e->getMessage(),"1","reparateur.php");
  }
  $count = $res->rowCount();
  if($count =='0'){
    oups("Erreur dans l'annulation","","2","reparateur.php");
  }
  else{
    echo "<h2 style='color:white'>Merci pour votre annulation du RDV !</h2><br>";
    echo "<p><a href='reparateur.php'>Retour à la liste des RDV</a></p>";
  }
  ?>
</body>
</html>
