<?php
require 'navbarReparateur.php';
?>
<body>
  <?php
  if (!isset($_SESSION['id_confirmer'])){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $id=$_SESSION['id_confirmer'];
  $req = "UPDATE demande SET etat_intervention = 'VALIDEE' where id= :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res->execute();
  }
  catch (Exception $e){
    oups("Erreur grave dans la confirmation",$e->getMessage(),"1","confirmer.php");
  }
  $count = $res->rowCount();
  if($count =='0'){
    oups("Erreur dans la confirmation","","2","reparateur.php");
  }
  else{
    echo "<h2 style='color:white'>Merci pour votre confirmation du RDV !</h2><br>";
    echo "<p><a href='reparateur.php'>Retour à la liste des RDV</a></p>";
  }
  ?>
</body>
</html>
