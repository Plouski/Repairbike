<?php
require 'header.php';
if (!isset($_SESSION['id'])) {
  oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
}
$id= $_SESSION['id'];
//var_dump($id);
$lesDemandes =  getMesDemandes($bdd,$id);
$count = calcDemandes($bdd,$id);
?>
<body>
  <h1 style="color:white">Mes <? echo $count ?> demandes</h1><br>
  <div class='container'>
  <?php
    foreach($lesDemandes as $demande) {
  ?>
  <div class="card mb-3 " style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?= $demande['img']; ?>" class="card-img" alt="Card image">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><strong><?= $demande['titre'] ?></strong></h5>
        <div class="card-text">Demande effectuée le : <?= $demande['date_demande'] ?></div>
        <div class="card-text">Statut : <?= $demande['etat_intervention'] ?></div>
        <div class="card-text">Tarif : <?= $demande['tarif'] ?> euros</div>
        <div class="card-text">Pour le : <?= $demande['date_intervention'] ?></div>
        <div class="card-text"><?= $demande['adresse_intervention'] ?></div>
        <?
        if ($demande['etat_intervention'] == 'ENVOYEE'){
          ?>
          <a href="updateDemande.php?id=<?=$demande['id']?>" class="btn btn-primary">Modifier</a>
          <?
        }
        if ($demande['etat_intervention'] == 'ENVOYEE' || $demande['etat_intervention'] == 'VALIDEE' || $demande['etat_intervention'] == 'REFUSEE' ){
          ?>
          <a href="deleteDemande.php?id=<?=$demande['id']?>" class="btn btn-danger">Supprimer</a>
          <?
        }
        ?>
      </div>
    </div>
  </div><br>
</div>
  <?php
}
?>
</div>
<p style='color: black; margin: 10px 40% 10px 40%'><a href="#demo" style="color:white" data-toggle="collapse">Voir les demandes terminées</a></p>
<div id="demo" class="collapse">
  <div class='container'>
  <?php
  $lesDemandes1 =  getMesDemandes1($bdd,$id);
    foreach($lesDemandes1 as $demande1) {
  ?>
  <div class="card mb-3 " style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?= $demande1['img']; ?>" class="card-img" alt="Card image">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><strong><?= $demande1['titre'] ?></strong></h5>
        <div class="card-text">Demande effectuée le : <?= $demande1['date_demande'] ?></div>
        <div class="card-text">Statut : <?= $demande1['etat_intervention'] ?></div>
        <div class="card-text">Tarif : <?= $demande1['tarif'] ?> euros</div>
        <div class="card-text">Pour le : <?= $demande1['date_intervention'] ?></div>
        <div class="card-text"><?= $demande1['adresse_intervention'] ?></div>
      </div>
    </div>
  </div><br>
</div>
  <?php
}
?>
</div>
</div>
</body>
</html>
