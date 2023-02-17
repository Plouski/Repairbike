<nav class="navbar navbar-inverse">
  <div class='prenom-nom'>
  <?= $monPrenom . " " . $monNom; ?>
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
        <li><a href="index.php">Home</a></li>
        <li><a href="carte_reparateurs.php">Carte</a></li>
        <li><a href="representation.php">Représentation</a></li>
        <li><a href="mesdemandes.php">Mes demandes</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?
        if($_SESSION['reparateur'] == 1){
        ?>
        <li><a href="reparateur.php">Espace réparateur</a></li>
        <?
        }
        else {
        ?>
        <li><a href="espacereparateur.php">Devenir réparateur</a></li>
        <?
        }
        ?>
        <li><a href="changer_mdp.php">Changer le mdp</a></li>
        <li><a href="profil.php">Voir mon profil</a></li>
        <li><a href="deconnexion.php">Déconnexion</a></li>
      </ul>
    </div>
  </div><!-- /.navbar-collapse -->
</nav>
<video playsinline autoplay muted loop poster id="bgvid">
  <source src="img/video3.mp4" type="video/mp4">
</video>
