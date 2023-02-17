<?php
require 'navbarReparateur.php';
if (isset($_GET['date_intervention'])){
  $date= $_GET['date_intervention'];
}
else if (isset($_POST['date_intervention'])){
  $date= $_POST['date_intervention'];
}
else {
oups("Erreur d’appel", "Paramètre(s) absent(s)","1","index.php");
}
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
  ?>
  <body>
    <div class="container">
      <? if($nombre === null){?>
         <p>Il n'y a pas de gagnant</p>
         <p><input style='color:black' type = "button" value = "Retour"  onclick = "history.back()"></p>
        <?
      } else{ ?>
      <p>Le gagnant est <? echo $prenom . ' '.$nom ?> et son nombre de réservation est <? echo $nombre ?> </p>
      <p><input style='color:black' type = "button" value = "Retour"  onclick = "history.back()"></p>
      <?
      }
      ?>
    </div>
  </body>
</html>
