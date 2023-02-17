<!DOCTYPE html>
<html>
<head>
  <title>RepairBike</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="MesStyles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php
include ("fonctions.php");
session_start();
$bdd = connexionBD();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
  $monNom = $_SESSION['nom'];
  $monPrenom = $_SESSION['prenom'];
  require 'navbarConnecte.php';
}
else{
  require 'navbarPasConnecte.php';
}
?>
