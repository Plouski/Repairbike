<?php
require 'header.php';
?>
<body>
  <h1 style="color:white">Inscription</h1>
  <div class="container">
    <form action = "inscription_post.php" method ="post" >
      <div class="form-group formtexte">
        <label>Prénom</label>
        <input type="text" class="form-control formtexte" name="prenom" placeholder="Veuillez saisir votre prénom" required >
      </div>
      <div class="form-group formtexte">
        <label>Nom</label>
        <input type="text" class="form-control formtexte" name="nom" placeholder="Veuillez saisir votre nom" required >
      </div>
      <div class="form-group formtexte">
        <label>Adresse</label>
        <input type="text" class="form-control formtexte" name="adresse" placeholder="Veuillez saisir votre adresse" required >
      </div>
      <div class="form-group formtexte">
        <label for=codepostal>Code postal</label>
        <input pattern="[0-9]{5}" type="text" class="form-control formcp" name="codepostal" placeholder="ex: 75019" required>
      </div>
      <div class="form-group formtexte">
        <label>Ville</label>
        <input type="text" class="form-control formtexte" name="ville" placeholder="Veuillez saisir le nom de la ville" required >
      </div>
      <div class="form-group formtexte">
        <label for="email">Email</label>
        <input type="email" class="form-control formtexte" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" placeholder="exemple@gmail.com" required>
      </div>
      <div class="form-group formtexte">
        <label for=portable>Numéro de Portable</label>
        <input type="tel" class="form-control formtexte" name="tel"
        pattern="0[1-68]([-. ]?[0-9]{2}){4}"
        placeholder="Veuillez saisir le numéro de portable" required>
      </div>
      <div class="form-group formtexte">
        <label for=portable>Mot de passe</label>
        <input type="password" class="form-control formtexte" name="mdp"
        title= 'Au moins 10 caractères, un chiffre et une lettre majuscule'
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}"
        placeholder="Veuillez saisir le mot de passe"required>
      </div>
      <div class="checkbox">
        <label><input type="checkbox" name="remember" required>Vous acceptez nos Conditions générales</label>
      </div>
      <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form><br>
  </div>
</body>
</html>
