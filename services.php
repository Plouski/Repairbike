<?php
require 'navbarReparateur.php';
if (!isset($_SESSION['id'])) {
  oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  header("location:index.php");
}
if($_SESSION['reparateur'] == 1){
?>
<body>
  <h1 style="color: white">Ajouter un service</h1>
  <div class="container">
    <form action = "services_post.php" method ="post" enctype="multipart/form-data" >
      <div class="form-group formtexte">
        <label>Votre titre de service?</label>
        <input type="text" class="form-control formtexte" name="titre" placeholder="Ex: Veuillez donner le titre de votre service" required >
      </div>
      <div class="form-group formtexte">
        <label>Description de service</label>
        <input type="text" class="form-control formtexte" name="description" placeholder="Veuillez décrire votre travail" >
      </div>
      <div class="form-group formtexte">
        <label for="montant">Votre tarif</label>
        <input name="tarif"  class="form-control formtexte" type="number" size="5" placeholder="Veuillez donner votre tarif" required >
      </div>
      <div class="form-group formtexte">
        <label>Votre rayon d'intervention</label>
        <input type="number" class="form-control formtexte" name="rayon_intervention" placeholder="Veuillez donner votre rayon d'intervention" required >
      </div>
      <div class='form-group'>
      <label>Ajouter une image</label>
      <input type='file' class='form-control' name='img' required>
      </div>
      <button type="submit" class="btn btn-primary">Terminer</button>
    </form>
  </div>
  <?
}
else {
  header("location:espacereparateur.php");
}
?>
</body>
</html>
