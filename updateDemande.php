<?php
require 'header.php';
  if (isset($_GET['id'])){
    $id= $_GET['id'];
    $_SESSION['id_update']=$id;
  }
  else if (isset($_POST['id'])){
    $id= $_POST['id'];
  }
  else {
  oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $req = "SELECT * FROM demande inner join service on service.S_id = demande.id_service where id= :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res -> execute();
  }
  catch(Exception $e){
    oups("Erreur de selection", $e->getMessage(),"1","index.php");
  }
  while($demande = $res->fetch(PDO::FETCH_ASSOC)) {
  $titre=$demande['titre'];
  $date=$demande['date_intervention'];
  $adresse=$demande['adresse_intervention'];
  $message=$demande['message'];
  }
  ?>
  <body>
    <h1 style="color:white">Mise à jour de la demande</h1>
    <div class="container">
      <form action="updateDemande_post.php" method='post'  enctype="multipart/form-data">
        <div class="form-group">
          <label>Titre</label>
          <input type="text" class="form-control formtexte" name="AFF_titre" value="<?php echo $titre?>"disabled />
          <input type="hidden" class="form-control formtexte" name="titre" value="<?php echo $titre?>"/>
        </div>
        <div class="form-group">
          <label>Date d'intervention</label>
          <input type="datetime" class="form-control" value="<?php echo $date?>" name="date_intervention" required>
        </div>
        <div class="form-group">
          <label>Adresse d'intervention</label>
          <input type="text" class="form-control" value="<?php echo $adresse?>" name="adresse_intervention" required>
        </div>
        <div class="form-group">
          <label>Message</label>
          <input type="text" class="form-control" value="<?php echo $message?>" name="message">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
      </form>
      <br>
    </body>
  </html>
