<?php
require 'navbarReparateur.php';
if (isset($_GET['id'])){
  $id= $_GET['id'];
  $_SESSION['id_confirmer']=$id;
}
else if (isset($_POST['id'])){
$id= $_POST['id'];
}
else {
  oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $req = "SELECT * FROM demande inner join service on demande.id_service = service.S_id where id= :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res -> execute();
  }
  catch(Exception $e){
    oups("Erreur de selection", $e->getMessage(),"1","index.php");
  }
  while($service = $res->fetch(PDO::FETCH_ASSOC)) {
  $titre=$service['titre'];
  $date=$service['date_intervention'];
  $adresse=$service['adresse_intervention'];
  $message=$service['message'];
  }
  ?>
<body>
  <h1 style="color:white">Confirmation du RDV</h1>
  <div class="container">
    <form action="confirmer_post.php" method='post'>
      <div class="form-group">
        <label>Titre</label>
        <input type="text" class="form-control formtexte" name="AFF_titre" value="<?php echo $titre?>"disabled />
        <input type="hidden" class="form-control formtexte" name="titre" value="<?php echo $titre?>"/>
      </div>
      <div class="form-group">
        <label>Date d'intervention</label>
        <input type="text" class="form-control formtexte" name="AFF_date" value="<?php echo $date?>"disabled />
        <input type="hidden" class="form-control formtexte" name="date_intervention" value="<?php echo $date?>"/>
      </div>
      <div class="form-group">
        <label>Adresse d'intervention</label>
        <input type="text" class="form-control formtexte" name="AFF_adresse" value="<?php echo $adresse?>"disabled />
        <input type="hidden" class="form-control formtexte" name="adresse_intervention" value="<?php echo $adresse?>"/>
      </div>
      <div class="form-group">
        <label>Message</label>
        <input type="text" class="form-control formtexte" name="AFF_message" value="<?php echo $message?>"disabled />
        <input type="hidden" class="form-control formtexte" name="message" value="<?php echo $message?>"/>
      </div>
      <button type="submit" class="btn btn-success">Confirmer</button>
      <a href='reparateur.php'>Retour</a>
    </form>
    <br>
  </body>
</html>
