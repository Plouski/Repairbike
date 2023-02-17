<?php
require 'navbarReparateur.php';
  if($_SESSION['reparateur'] == 1){
    $id= $_SESSION['id'];
    $lesDemandes = getLesDemandesReparateur($bdd, $id);
?>
<body>
  <h1 style="color: white;padding: 30px; margin: 10px 40% 10px 40%">Liste des RDV</h1>
  <div class="container">
    <input style="position : relative;"class="form-control" id="myInput" type="text" placeholder="Chercher.."><br>
    <table style="background-color:white; position : relative;" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>E-mail</th>
          <th>Téléphone</th>
          <th>Service</th>
          <th>Adresse</th>
          <th>Date</th>
          <th>Statut</th>
          <th>Messages</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
        foreach ($lesDemandes as $demande) {
          ?>
          <tr>
            <td><?= $demande['nom_client']?></td>
            <td><?= $demande['prenom_client']?></td>
            <td><a href="mailto:<?echo $demande['email_client']?>"><?= $demande['email_client']?></a></td>
            <td><?= $demande['tel_client']?></td>
            <td><?= $demande['titre_service']?></td>
            <td><?= $demande['adresse_intervention']?></td>
            <td><?= $demande['date_intervention']?></td>
            <td><?= $demande['etat_intervention']?></td>
            <td><?= $demande['message']?></td>
            <?php
            if ($demande['etat_intervention'] == 'ENVOYEE'){
            ?>
            <td><a style='color:green' href='confirmer.php?id=<?= $demande['id']?>'>Confirmer</a></td>
            <td><a style='color:red' href='refuser.php?id=<?= $demande['id']?>'>Annuler</a></td>
            <?php
            }
            if ($demande['etat_intervention'] == 'VALIDEE'){
            ?>
            <td><a style='color:red' href='refuser.php?id=<?= $demande['id']?>'>Annuler</a></td>
            <?php
            }
            ?>
          </tr>
          <?php
        }
          ?>
    </table>
  </div>
  <p style='color: black; margin: 10px 40% 10px 40%'><a href="#demo" style="color:white" data-toggle="collapse">Voir l'historique</a></p>
  <div id="demo" class="collapse">
    <?
    $lesDemandes1 = getLesDemandesReparateur1($bdd, $id);
    ?>
    <div class='container'><br>
      <table style="background-color:white; position : relative;" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>E-mail</th>
            <th>Téléphone</th>
            <th>Service</th>
            <th>Adresse</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Messages</th>
          </tr>
        </thead>
    <?php
      foreach($lesDemandes1 as $demande1) {
    ?>
    <tr>
      <td><?= $demande1['nom_client']?></td>
      <td><?= $demande1['prenom_client']?></td>
      <td><a href="mailto:<?echo $demande1['email_client']?>"><?= $demande1['email_client']?></a></td>
      <td><?= $demande1['tel_client']?></td>
      <td><?= $demande1['titre_service']?></td>
      <td><?= $demande1['adresse_intervention']?></td>
      <td><?= $demande1['date_intervention']?></td>
      <td><?= $demande1['etat_intervention']?></td>
      <td><?= $demande1['message']?></td>
    </tr>
    <?php
  }
    ?>
</table>
  </div>
</div>
<script>
$(document).ready(function(){
$("#myInput").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#myTable tr").filter(function() {
  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>
<?php
}
else {
  header("location:espacereparateur.php");
}
?>
</body>
<?php

?>
</html>
