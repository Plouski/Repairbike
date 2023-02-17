<?php
require 'header.php';
?>
<body>
  <?php
  session_start();
  if (!isset($_SESSION['id'])){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $id= $_SESSION['id'];
  $cp = $_POST["codepostal"];
  $ville = $_POST['ville'];
  $adress = $cp.' '.$ville;
  $latitude_longitude = getCoordinates($adress);
  list($latitude, $longitude) = explode(",", $latitude_longitude);
  $req = "UPDATE user SET nom = :nom, prenom = :prenom, email = :email, mdp = :mdp,
  tel = :tel, codepostal = :cp, ville = :ville, adresse = :adresse, latitude = :latitude, longitude = :longitude WHERE U_id = :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
  $res->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
  $res->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
  $res->bindParam(':mdp', crypt($_POST['mdp'], '$5$rounds=5000$usesomesillystringforalt$'), PDO::PARAM_STR);
  $res->bindParam(':tel', $_POST['tel'], PDO::PARAM_STR);
  $res->bindParam(':cp', $_POST['codepostal'], PDO::PARAM_STR);
  $res->bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
  $res->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
  $res->bindParam(':latitude', $latitude, PDO::PARAM_STR);
  $res->bindParam(':longitude', $longitude, PDO::PARAM_STR);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res -> execute();
  }
  catch(Exception $e){
    oups("Erreur grave dans la modification",$e->getMessage(),"1","<a href='index.php'>Retour à l'accueil</a>");
  }
  $count = $res->rowCount();
  if($count =='0'){
    oups("Erreur dans la modification","Aucune ligne n'a été modifiée","2","profil.php");
  }
  else{
    echo "<h2 style='color:white'>Votre profil a bien été modifié !</h2>";
    echo "<p><a href='index.php'>Retour à l'accueil</a><p>";
      $monPrenom=$util['prenom'];
      $monNom=$util['nom'];
      $authOK = true;
      $_SESSION['email']=$_POST['email'];
      $_SESSION['nom']=$_POST['nom'];
      $_SESSION['prenom']=$_POST['prenom'];
    }
  ?>
</body>
</html>
