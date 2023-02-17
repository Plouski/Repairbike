<?php
require 'header.php';
if (isset($_GET['id'])){
  $id= $_GET['id'];
  $_SESSION['id_delete']=$id;
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
  $img=$service['img'];
  }
?>
<body>
  <h1 style="color:white">Suppression de la demande</h1>
  <div class="container">
    <form action="deleteDemande_post.php" method='post'  enctype="multipart/form-data">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="<?php echo $img; ?>" class="card-img" alt="Card image">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><strong><?php echo $titre?></strong></h5>
              <div class="card-text"><?php echo $date?></div><br>
              <div class="card-text"><?php echo $adresse?></div><br>
              <br>
              <input type="submit" value="Supprimer"class="btn btn-danger" onclick="return confirm('Vous êtes vraiment sûr de supprimer cette demande ?');"></a>
            </div>
          </div>
        </div><br>
      </div>
    </form>
  </div>
</body>
</html>
