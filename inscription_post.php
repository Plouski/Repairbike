<?php
require 'header.php';
?>
<body>
  <?php
  if (!isset($_POST['email'])){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
    $ville = $_POST["ville"];
    $cp = $_POST["codepostal"];
    $adress = $cp.' '.$ville;
    $latitude_longitude = getCoordinates($adress);
    list($latitude, $longitude) = explode(",", $latitude_longitude);
  $req = "INSERT INTO user (nom, prenom, email, mdp, adresse, tel, codepostal, ville, latitude, longitude) VALUES (:nom, :prenom, :email, :mdp, :adresse, :tel, :cp, :ville, :latitude, :longitude)";
  $res = $bdd->prepare($req);
  $res->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
  $res->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
  $res->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
  $res->bindParam(':mdp', crypt($_POST['mdp'], '$5$rounds=5000$usesomesillystringforalt$'), PDO::PARAM_STR);
  $res->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
  $res->bindParam(':tel', $_POST['tel'], PDO::PARAM_STR);
  $res->bindParam(':cp', $_POST['codepostal'], PDO::PARAM_STR);
  $res->bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
  $res->bindParam(':latitude', $latitude, PDO::PARAM_STR);
  $res->bindParam(':longitude', $longitude, PDO::PARAM_STR);
  try{
    $res->execute();
  }
  catch (Exception $e){
    oups("Erreur grave dans l'inscription",$e->getMessage(),"1","inscription.php");
  }
  if (isset($_POST['email']) ) {
    $req = "SELECT * FROM user WHERE email= :email AND mdp= :mdp";
    $res = $bdd->prepare($req);
    $res->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $res->bindParam(':mdp', crypt($_POST['mdp'], '$5$rounds=5000$usesomesillystringforalt$'), PDO::PARAM_STR);
    try{
      $res -> execute();
    }
    catch(Exception $e){
      oups("Erreur grave",$e->getMessage(),"1","login.php");
    }
    $count = $res->rowCount();
    if($count == 0){
      oups("Utilisateur inconnu","","3","login.php");
    }
      $util = $res->fetch(PDO::FETCH_ASSOC) ;
      $monPrenom = $util['prenom'];
      $monNom = $util['nom'];
      $id = $util['U_id'];
      $rep = $util['reparateur'];
      $authOK = true;
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['nom'] = $monNom;
      $_SESSION['prenom'] = $monPrenom;
      $_SESSION['id'] = $id;
      $_SESSION['reparateur'] = $rep;
  }
  if (isset($authOK)) {
    //echo "<p>Bonjour " . $monPrenom . " !<br><br>";
    //echo '<a href="index.php">Poursuivre vers la page d\'accueil</a></p>';
    header("location:index.php");
  }
    ?>
</body>
</html>
