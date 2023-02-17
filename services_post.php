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
  $req = "INSERT INTO service (titre, description, tarif, rayon_intervention, id_reparateur, img) VALUES (UPPER(:titre), :description, :tarif, :rayon, :id, :img)";
  $res = $bdd->prepare($req);
  $res->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
  $res->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
  $res->bindParam(':tarif', $_POST['tarif'], PDO::PARAM_STR);
  $res->bindParam(':rayon', $_POST['rayon_intervention'], PDO::PARAM_STR);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  $res->bindParam(':img', $path_to_picture, PDO::PARAM_STR);
  try{
    $res->execute();
    echo "<h2 style='color:white'>Votre service a bien été créé !</h2><br>";
    echo "<p><a href='messervices.php'>Voir mes services</a></p>";
  }
  catch (Exception $e){
    oups("Erreur grave dans les services",$e->getMessage(),"1","reparation.php");
  }
  ?>
</body>
</html>
