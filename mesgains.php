<?php
require 'navbarReparateur.php';
if (!isset($_SESSION['id'])) {
  oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  header("location:index.php");
}
if($_SESSION['reparateur'] == 1){
$id= $_SESSION['id'];
$mesGains = getMesGains($bdd, $id);
?>
<style>
.clignote {
  color:green;
  animation: clignote 3s linear infinite;
}
@keyframes clignote {
  50% { opacity: 0; }
}
</style>
<body>
<h1 style="color: white">Mes gains</h1>
<div class='container'>
  <?php
    foreach($mesGains as $gain) {
  ?>
  <h2 class="clignote" style="text-align:center; color: white; background-color: black;line-height: 100px;">Votre compte est à : <?= $gain['sum(demande.tarif_demande)']?> euros</h2>
  <p style='color: black; margin: 10px 40% 10px 40%'><a href="#demo" style="color:white" data-toggle="collapse">Voir détails</a></p>
  <div id="demo" class="collapse">
    <?
    $lesDetails =  getMesDetails($bdd,$id);
    ?>
    <div class='container'><br>
    <?php
      foreach($lesDetails as $details) {
    ?>
    <div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="<?= $details['img_service']; ?>" class="card-img" alt="Card image">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><strong><?= $details['titre_service'] ?></strong></h5>
          <div class="card-text">Date : <?= $details['date_intervention'] ?></div>
          <div class="card-text">Tarif : <?= $details['tarif_demande'] ?> euros</div>
          <div class="card-text">Client : <? echo $details['prenom_client']. ' '. $details['nom_client'] ?></div>
        </div>
      </div>
    </div><br>
  </div>
    <?php
  }
  ?>
  </div>
</div>
  <?php
}
  ?>
</div>
<?
}
else {
  header("location:espacereparateur.php");
}
?>
</body>
</html>
