<?php
require 'header.php';
if (isset($_SESSION['id']))
$lesServices = getLesServicesReduits($bdd,$_SESSION['id']);
else
$lesServices = getTousLesServices($bdd);
?>
<body>
  <h1 style="color: white;padding: 30px; margin: 10px 18% 10px 18%">Bienvenue à la recherche de réparateurs de vélos !</h1><br>
  <div class='container'>
    <?php
    foreach( $lesServices as $user) {
    ?>
    <div class="card col-lg-3" style="margin-left: 90px">
      <img src="<?php echo $user['img']; ?>" class="card-img-top" alt="Card image">
      <div class="card-body" style="width: 17.5rem; "><br>
        <p><?php echo $user['titre'].' '.$user['nom'] ?><br>
          <?php echo $user['tarif']. ' euros'?><br>
          <?php echo $user['codepostal'] ." ". $user['ville'] ?>
        </p>
        <p><a href="reserver.php?S_id=<?=$user['S_id']?>" class="btn btn-primary">Réserver</a></p>
      </div>
    </div>
    <?php
  }
    ?>
  </div>
</body>
</html>
