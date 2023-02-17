<?php
require 'navbarReparateur.php';
if (isset($_GET['S_id'])){
  $id= $_GET['S_id'];
  $_SESSION['S_id_delete']=$id;
}
else if (isset($_POST['S_id'])){
  $id= $_POST['S_id'];
}
else {
oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
}
$req = "SELECT * FROM service inner join user on user.U_id = service.id_reparateur where S_id= :id";
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
  $description=$service['description'];
  $tarif=$service['tarif'];
  $rayon=$service['rayon_intervention'];
  $img=$service['img'];
}
?>
<body>
  <h1 style="color:white">Suppression du service</h1><br>
  <div class="container">
    <form action="deleteService_post.php" method='post'  enctype="multipart/form-data">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="<?php echo $img; ?>" class="card-img" alt="Card image">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><strong><?php echo $titre?></strong></h5>
              <div class="card-text"><?php echo $description?></div><br>
              <div class="card-text"><?php echo $tarif. ' euros'?></div>
              <br>
              <input type="submit" value="Supprimer"class="btn btn-danger" onclick="return confirm('Vous êtes vraiment sûr de supprimer ce service alors que vous avez des demandes en cours ?');"></a>
            </div>
          </div>
        </div><br>
      </div>
    </form>
  </div>
</body>
</html>
