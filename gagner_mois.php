<?php
require 'navbarReparateur.php';
if($_SESSION['reparateur'] == 1){

  if(isset($_POST['date_intervention'])){
    $chercheDate = $_POST['date_intervention'];
  }

  $id= $_SESSION['id'];
  $lesDemandes = getLesDemandesReparateur($bdd, $id);
?>
<body>
  <div class="container">
    <form action = "gagner_mois.php" method ="post">
      <div class="form-group formtexte">
        <label>Choisir un mois</label>
        <select class="form-control formtexte formcp selectpicker" id="idDate" name="date_intervention" data-live-search="true" required>
          <option value="01">Janvier</option>
          <option value="02">Février</option>
          <option value="03">Mars</option>
          <option value="04">Avril</option>
          <option value="05">Mai</option>
          <option value="06">Juin</option>
          <option value="07">Juillet</option>
          <option value="08">Août</option>
          <option value="09">Septembre</option>
          <option value="10">Octobre</option>
          <option value="11">Novembre</option>
          <option value="12">Décembre</option>
        </select>
        <script type="text/javascript">
        var laBonneDate="'"+'<?php echo $chercheDate?>'+"'";
        $('#idDate option[value=' + laBonneDate +']').prop('selected', true);
        </script>
      </div>
      <button type="submit" value="Valider" name="bouton" class="btn btn-primary">OK</button>
    </form>
    <?
    if(isset($_POST["bouton"])){
      $req =  "SELECT count(demande.id), user.U_id, user.nom, user.prenom from demande, user, service where user.U_id= service.id_reparateur and demande.id_service = service.S_id and user.gagner = 0 and demande.etat_intervention = 'TERMINEE' and month(demande.date_intervention) = :date group by user.U_id ";
      $res = $bdd->prepare($req);
      $res->bindParam(':date', $_POST['date_intervention'], PDO::PARAM_STR);
      try{
        $res->execute();
      }
      catch(Exception $e){
        oups("Erreur grave",$e->getMessage(),"1","index.php");
      }
      while($gagnant = $res->fetch(PDO::FETCH_ASSOC)) {
      $nom=$gagnant['nom'];
      $prenom=$gagnant['prenom'];
      $nombre = $gagnant['count(demande.id)'];
      }
      if($nombre === null){?>
        <p>Il n'y a pas de gagnant</p>
        <?
      } else{ ?>
        <p>Le gagnant est <? echo $prenom . ' '.$nom ?> et son nombre de réservation est <? echo $nombre ?> </p>
        <?
      }
      ?>
    </div>
    <?
  }
}
  ?>
</body>
</html>
