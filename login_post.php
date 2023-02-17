<?php
require 'header.php';
?>
<body>
<?php
  $req = "SELECT * FROM user WHERE email=?";
  $res = $bdd->prepare($req);
  $res->bindParam(1, $_POST['email']);
  try{
    $res -> execute();
    $laLigne = $res->fetch(PDO::FETCH_ASSOC);
    if(hash_equals($laLigne['mdp'], crypt($_POST['mdp'], '$5$rounds=5000$usesomesillystringforalt$'))){
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['nom'] = $laLigne['nom'];
      $_SESSION['prenom'] = $laLigne['prenom'];
      $_SESSION['id'] = $laLigne['U_id'];
      $_SESSION['reparateur'] = $laLigne['reparateur'];
      $_SESSION['adresse'] = $laLigne['adresse'];
      $_SESSION['tel'] = $laLigne['tel'];
      $_SESSION['codepostal'] = $laLigne['codepostal'];
      $_SESSION['ville'] = $laLigne['ville'];
      $_SESSION['statut'] = $laLigne['statut'];
      $_SESSION['mdp'] = $laLigne['mdp'];
      header("location:index.php");
    }
    else{
      oups("Utilisateur inconnu","","3","login.php");
      return $laLigne;
    }
  }
  catch(Exception $e){
    oups("Erreur grave",$e->getMessage(),"1","inscription.php");
  }

?>
</body>
</html>
