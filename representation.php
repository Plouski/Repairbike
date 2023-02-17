<?php
require 'header.php';
$Representations =  getRepresentation($bdd);
//var_dump($Representations);
?>
<body>
  <h1 style="color:white">Représentation des services</h1><br>
  <div class='container'>
  <?php
  if (is_array($Representations) || is_object($Representations)){
    foreach ($Representations as $representation) {
      //echo $representation['img'];
  ?>
  <div class="card mb-3 " style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?= $representation['img']; ?>" class="card-img" alt="Card image">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><strong><?= $representation['titre'] ?> de <?= $representation['nom']?></strong></h5>
        <div class="card-text">Il y a eu <?= $representation['nombre_demande'] ?> demandes</div>
      </div>
    </div>
  </div><br>
</div>
  <?php
}
}
?>
</div>
</body>
</html>
