<?
require 'header.php';
?>
<body>
  <?php
  session_start();
  if (!isset($_SESSION['id'])){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  if ((!isset($_POST['mdp'])) || (!isset($_POST['mdpVerif']))){
    oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
$mdp = $_POST["mdp"];
$mdpVerif = $_POST["mdpVerif"];
echo $_SESSION['id'];

$req = "UPDATE user SET mdp = :mdp WHERE U_id = :id";
$res = $bdd->prepare($req);
$res->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
$res->bindParam(':mdp', crypt($mdp, '$5$rounds=5000$usesomesillystringforalt$'), PDO::PARAM_STR);
try{
  $res -> execute();
}
catch(Exception $e){
  oups("Erreur grave dans la modification",$e->getMessage(),"1","<a href='index.php'>Retour à l'accueil</a>");
}
$count = $res->rowCount();
if($count =='0'){
  oups("Erreur dans la modification","mot de passe déjà utilisé auparavant","2","changer_mdp.php");
}
else{
  echo "<h2 style='color:white'>Votre mot de passe a bien été modifié !</h2>";
  echo "<p><a href='index.php'>Retour à l'accueil</a><p>";
  }
?>
</body>
</html>
