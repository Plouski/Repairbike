<?php
require 'navbarReparateur.php';
?>
<body>
  <?php
  if (!isset($_POST['titre'])){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $path_to_picture = uploadPicture($_FILES['img']);
  $id= $_SESSION['id'];
  $s_id=$_SESSION['S_id_update'];
  $req = "UPDATE service SET titre = UPPER(:titre), description = :description, tarif = :tarif, rayon_intervention = :rayon,
  id_reparateur = :id, img = :img where  S_id= :s_id";
  $res = $bdd->prepare($req);
  $res->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
  $res->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
  $res->bindParam(':tarif', $_POST['tarif'], PDO::PARAM_STR);
  $res->bindParam(':rayon', $_POST['rayon_intervention'], PDO::PARAM_STR);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  $res->bindParam(':img', $path_to_picture, PDO::PARAM_STR);
  $res->bindParam(':s_id', $s_id, PDO::PARAM_STR);
  try{
    $res->execute();
  }
  catch (Exception $e){
    oups("Erreur grave dans la modification",$e->getMessage(),"1","<a href='messervices.php'>Retour à mes services</a>");
  }
  $count = $res->rowCount();
  if($count =='0'){
    oups("Erreur dans la modification","Aucune ligne n'a été modifiée","2","messervices.php");
  }
  else{
    echo "<h2 style='color:white'>Votre service a bien été modifié !</h2><br>";
    echo "<p><a href='messervices.php'>Voir mes services</a></p>";
  }
  ?>
</body>
</html>
