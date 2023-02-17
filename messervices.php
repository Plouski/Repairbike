<?php
require 'navbarReparateur.php';
if (!isset($_SESSION['id'])) {
  oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  header("location:index.php");
}
if($_SESSION['reparateur'] == 1){
$id= $_SESSION['id'];
$mesServices = getMesServices($bdd, $id);
?>
<body>
  <h1 style="color:white">Mes services</h1><br>
  <div class='container'>
  <?php
    foreach($mesServices as $service) {
  ?>
  <div class="card mb-3 " style="max-width: 540px;" >
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="<?= $service['img']; ?>" class="card-img" alt="Card image">
      </div>
      <div class="col-md-8">
        <div class="card-body" style="color: white">
          <h5 class="card-title"><strong><?= $service['titre']; ?></strong></h5>
          <div class="card-text"><?= $service['description']?></div><br>
          <div class="card-text"><?= $service['tarif']. ' euros'?></div>
          <br>
          <a href="updateService.php?S_id=<?=$service['S_id']?>" class="btn btn-primary">Modifier</a>
          <a href="deleteService.php?S_id=<?=$service['S_id']?>" class="btn btn-danger">Supprimer</a>
        </div>
      </div>
    </div><br>
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
