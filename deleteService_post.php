<?php
require 'navbarReparateur.php';
?>
<body>
  <?php
  if (!isset($_SESSION['S_id_delete'])){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $id= $_SESSION['id'];
  $s_id=$_SESSION['S_id_delete'];
  $req= "DELETE FROM demande where id_service = :id";
  $req1 = "DELETE FROM service WHERE S_id = :id";
  $res = $bdd->prepare($req);
  $res1 = $bdd->prepare($req1);
  $res->bindParam(':id', $s_id, PDO::PARAM_STR);
  $res1->bindParam(':id', $s_id, PDO::PARAM_STR);
  try{
    $res -> execute();
    $res1 -> execute();
  }
  catch(Exception $e){
    oups("Erreur grave dans la suppression",$e->getMessage(),"1","reparateur.php");
  }
  $count = $res1->rowCount();
  if($count =='0'){
    oups("Erreur dans la suppression","","2","messervices.php");
  }
  else{
    echo "<h2 style='color:white'>Votre service a bien été supprimé !</h2><br>";
    echo "<p><a href='reparateur.php'>Retour à la liste des RDV</a><p>";
  }
?>
</body>
</html>
