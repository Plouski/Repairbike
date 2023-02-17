<?php
require 'navbarReparateur.php';
  if (isset($_GET['S_id'])){
    $id= $_GET['S_id'];
    $_SESSION['S_id_update']=$id;
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
    <h1 style="color:white">Mise à jour du service</h1>
    <div class="container">
      <form action="updateService_post.php" method='post'  enctype="multipart/form-data">
        <div class="form-group">
          <label>Titre</label>
          <input type="text" class="form-control" value="<?php echo $titre?>" name="titre">
        </div>
        <div class="form-group">
          <label>Description</label>
          <input type="text" class="form-control" value="<?php echo $description?>" name="description">
        </div>
        <div class="form-group">
          <label>tarif</label>
          <input type="text" class="form-control" value="<?php echo $tarif?>" name="tarif">
        </div>
        <div class="form-group">
          <label>Rayon d'intervention</label>
          <input type="text" class="form-control" id="ville" value="<?php echo $rayon?>" name="rayon_intervention">
        </div>
        <div class="form-group">
          <label>Image</label>
          <img class="card-img-top img-responsive " src="<?php echo $img?>" alt="Card image" name='img'>
          <input type="hidden" class="form-control formtexte" name="img" value="<?php echo $img?>"/>
          Veuillez ajouter votre image svp
          <input type='file' class='form-control' name='img' required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
      </form>
      <br>
    </body>
  </html>
