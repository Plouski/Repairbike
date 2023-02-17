<!DOCTYPE html>
<html>
<head>
  <title>RepearBike</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="MesStyles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php include ("fonctions.php");
session_start();
$bdd = connexionBD();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
  $monNom = $_SESSION['nom'];
  $monPrenom = $_SESSION['prenom'];
  $rep = $_SESSION['reparateur'];
  if($rep=1){
    $monrep="(réparateur)";
  }
?>
<nav class="navbar navbar-inverse">
  <div class='prenom-nom'>
  <?= $monPrenom . " " . $monNom." ".$monrep ?>
  </div>
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">RepairBike</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="reparateur.php">Home</a></li>
        <li><a href="mesgains.php">Mes gains</a></li>
        <li><a href="gagner_mois.php">Gagnant mois</a></li>
        <li><a href="messervices.php">Mes services</a></li>
        <li><a href="services.php">Ajouter un service</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">Espace client</a></li>
        <li><a href="profil.php">Voir mon profil</a></li>
        <li><a href="deconnexion.php">Déconnexion</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<video playsinline autoplay muted loop poster id="bgvid">
  <source src="img/video3.mp4" type="video/mp4">
</video>
<?php
}
else{
  require 'navbarPasConnecte.php';
}
