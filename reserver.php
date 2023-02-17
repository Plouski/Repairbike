<?php
require 'header.php';
if (isset($_SESSION['email']) ) {
  if (isset($_GET['S_id'])){
    $id= $_GET['S_id'];
    $_SESSION['idS']= $id;
  }
  else {
  oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
  }
  $req = "SELECT * FROM user inner join service on user.U_id = service.id_reparateur where S_id= :id";
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
  $ville=$service['ville'];
  $tarif=$service['tarif'];
  $description=$service['description'];
  $titre=$service['titre'];
  $rayon=$service['rayon_intervention'];
  $adresse=$service['adresse'];
  $cp=$service['codepostal'];
  $img=$service['img'];
  $_SESSION['adresse']=$adresse;
  $_SESSION['ville']=$ville;
  $_SESSION['codepostal']=$cp;
  $_SESSION['rayon_intervention']=$rayon;
  }
?>
<body>
  <h1 style="color:white">Réservation</h1><br>
  <div class="container">
    <div class="card mb-3" style="max-width: 50%;">
      <div class="row no-gutters">
        <div class="col-md-4">
          <img src="<?php echo $img; ?>" class="card-img" alt="Card image">
        </div>
        <div class="col-md-8">
          <div class="card-body" style="color: white;">
            <h5 class="card-title"><strong><?php echo $titre?></strong></h5>
            <div class="card-text"><?php echo $cp.' '.$ville?></div><br>
            <div class="card-text"><?php echo $tarif. ' euros'?></div>
            <div class="card-text"><?php echo $description?></div><br>
            <div class="card-text"><?php echo "J'interviens dans un rayon de ".$rayon." km autour de mon adresse"?></div>
            <button><a style='color:white; 'href="carte.php?S_id=<?=$id?>" onclick="goclicky(this); return false;" target="_blank">Voir Carte</a></button>
            <script type="text/javascript">
            function goclicky(meh){
              var x = screen.width/2 - 700/2;
              var y = screen.height/2 - 450/2;
              window.open(meh.href, 'sharegplus','height=485,width=700,left='+x+',top='+y);
            }
            </script>
          </div>
        </div>
      </div>
    </div><br>
    <form action = "reserver_post.php" method ="post" >
      <div class="form-group formtexte">
        <input type="hidden" class="form-control formtext" name="tarif_demande" value="<?php echo $tarif?>" >
      </div>
      <div class="form-group formtexte">
        <label>Adresse si différent de votre adresse</label>
        <input type="text" class="form-control formtext" name="adresse_intervention" value="<?php echo $adresse.' '.$cp.' '.$ville ?>" placeholder="Veuillez saisir votre adresse" required >
      </div>
      <div class="form-group formtexte">
        <label>Date de l'intervention</label>
        <input type="datetime-local" class="form-control formtexte" name="date_intervention" value="yyyy-mm-dd">
      </div>
      <div class="form-group formtexte">
        <label>Choisir votre remise</label>
        <select class="form-control formtexte formcp selectpicker" name="remise_demande"required>
          <option value="5">Client récent</option>
          <option value="10">Client fidèle</option>
          <option value="15">Client très fidèle</option>
          <option value="20">Client en or</option>
        </select>
        <script type="text/javascript">
        var laBonneDate="'"+'<?php echo $chercheDate?>'+"'";
        $('#idDate option[value=' + laBonneDate +']').prop('selected', true);
        </script>
      </div>
      <div class="form-group formtexte">
        <label>Message</label>
        <input type="text" class="form-control formtexte" name="message" required>
      </div>
      <button type="submit" class="btn btn-primary">Réserver</button>
    </form>
  </div>
  <br>
  <?php
}
else {
  header("location:login.php");
}?>
</body>
</html>
