<?php
require 'header.php';
if (!isset($_SESSION['email'])) {
  oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
}
?>
<h1 style="color:white">Changer mon mot de passe</h1><br>
<div class="container">
  <form action = "changer_mdp_post.php" method ="post" oninput='mdpVerif.setCustomValidity(mdpVerif.value != mdp.value ? "Mot de passe pas identique" : "")'>
    <div class="form-group formtexte">
      <label>Nouveau mot de passe</label>
      <input type="password" class="form-control formtexte"
      name="mdp" title= 'Au moins 10 caractères, un chiffre et une lettre majuscule'
      pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}"
      placeholder="Veuillez saisir le nouveau mot de passe" maxlength="100" required>
    </div>
    <div class="form-group formtexte">
      <label>Vérification de mot de passe</label>
      <input type="password" class="form-control formtexte" name="mdpVerif" placeholder="Les mots de passe doivent être identiques" maxlength="100" required>
    </div>
    <button type="submit" class="btn btn-primary">Créer</button>
  </form>
</div>
</body>
