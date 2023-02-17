<?php
require 'header.php';
?>
<body>
  <?php
  if (!isset($_SESSION['id_delete'])){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $id= $_SESSION['id'];
  $s_id=$_SESSION['id_delete'];
  $req= "DELETE FROM demande where id = :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $s_id, PDO::PARAM_STR);
  try{
    $res -> execute();
  }
  catch(Exception $e){
    oups("Erreur grave dans la suppression",$e->getMessage(),"1","index.php");
  }
  $count = $res->rowCount();
  if($count =='0'){
    oups("Erreur dans la suppression","","2","mesdemandes.php");
  }
  else{
    echo "<h2 style='color:white'>Votre demande a bien été supprimée !</h2><br>";
    echo "<p><a href='index.php'>Retour à l'accueil</a><p>";
  }
?>
</body>
</html>
