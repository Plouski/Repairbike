<?php
require 'header.php';
if (!isset($_SESSION['email'])) {
  oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
}
$id= $_SESSION['id'];
$req = "SELECT * FROM user WHERE U_id = :id";
$res = $bdd->prepare($req);
$res->bindParam(':id', $id, PDO::PARAM_STR);
try{
  $res -> execute();
}
catch(Exception $e){
  oups("Erreur de selection", $e->getMessage(),"1","index.php");
}
while($user = $res->fetch(PDO::FETCH_ASSOC)) {
//echo $user['nom'] . '<br> ' . $user['prenom'] . ' <br>' . $user['email'] . '<br>' . $user['mdp'] . '<br>' . $user['tel'] . '<br>' . $user['codepostal'] . '<br>' ;
//echo $user['ville'] . '<br> ' . $user['adresse'];
$nom=$user['nom'];
$prenom=$user['prenom'];
$email=$user['email'];
$mdp=$user['mdp'];
$tel=$user['tel'];
$cp=$user['codepostal'];
$ville=$user['ville'];
$adresse=$user['adresse'];
}
?>
<body>
  <h1 style="color:white">Mise à jour du profil</h1>
  <div class="container">
    <form action="profil_post.php" method='post' oninput='mdp2.setCustomValidity(mdp2.value != mdp1.value ? "Mot de passe pas identique" : "")'>
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" value="<?php echo $nom?>" name="nom">
      </div>
      <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" id="prenom" value="<?php echo $prenom?>" name="prenom">
      </div>
      <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" id="adresse" value="<?php echo $adresse?>" name="adresse">
      </div>
      <div class="form-group">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" id="ville" value="<?php echo $ville?>" name="ville">
      </div>
      <div class="form-group">
        <label for="cp">Code postal</label>
        <input type="text" class="form-control" id="cp" value="<?php echo $cp?>" name="codepostal">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" value="<?php echo $email?>" name="email">
      </div>
      <div class="form-group">
        <label for="phone">Téléphone</label>
        <input type="text" class="form-control" id="phone" value="<?php echo $tel?>" name="tel">
      </div>
      <div class="form-group">
        <label>Mot de passe</label>
        <div class="input-group margin-bottom-sm">
          <span class="input-group-addon" onclick="showPassword();"><i class="fa fa-eye"></i></span>
          <input type="password" class="form-control formtexte" name="mdp" placeholder="Veuillez saisir votre mot de passe"required>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <br>
  </body>
</html>
