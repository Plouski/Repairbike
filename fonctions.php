<?php
function escape($valeur){
  return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8', false);
}

function connexionBD(){
  $serveur='localhost';
  $dbname='repairbike';
  $dbuser='admin';
  $dbpass='admin';
  try {
  $bdd = new PDO("mysql:host=$serveur;dbname=$dbname",$dbuser,$dbpass);
  $bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $bdd;
  }
  catch(PDOException $e) {
    oups("Erreur de connexion à la base",$e->getMessage(),"1","login.php");
  }
}

function getCoordinates($address) {
  //récupérer la clé d'API
  $obj=json_decode(file_get_contents("data.json"));
  $key = $obj->GOOGLE_API;

  // replace all the white space with "+" sign to match with google search pattern
  $address = str_replace(" ", "+", $address);

  $url = "https://maps.google.com/maps/api/geocode/json?sensor=false&key=$key&address=$address";
  $response = file_get_contents($url);

  // generate array object from the response from the web
  $json = json_decode($response,TRUE);
  // Latitude
  $latitude = ($json['results'][0]['geometry']['location']['lat']) ? $json['results'][0]['geometry']['location']['lat'] : '--';
  // Longitude
  $longitude = ($json['results'][0]['geometry']['location']['lng']) ? $json['results'][0]['geometry']['location']['lng'] : '--';

  //renvoyer le résultat
  return $latitude . "," . $longitude;
}

function getLesServicesReduits($bdd,$id){
  $req = "SELECT * FROM user inner join service on user.U_id = service.id_reparateur where id_reparateur != :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':id',$id, PDO::PARAM_STR);
  try {
    $res->execute();
    $lesServices = $res->fetchAll();
    return $lesServices;
  }
  catch(Exception $e){
    oups("Erreur grave",$e->getMessage(),"1","index.php");
  }
}

function getUser($bdd){
  $req = "SELECT * FROM user WHERE email=?";
  $res = $bdd->prepare($req);
  $res->bindParam(1, $_POST['email']);
  try{
    $res -> execute();
    $laLigne = $res->fetch(PDO::FETCH_ASSOC);
    if(hash_equals($laLigne['mdp'], crypt($_POST['mdp'], '$5$rounds=5000$usesomesillystringforalt$'))){
        header("location:index.php");
    }
    else{
      header("location:login.php");
      return $laLigne;
    }
  }
  catch(Exception $e){
    oups("Erreur grave",$e->getMessage(),"1","inscription.php");
  }
}

function getTousLesServices($bdd){
  $req = "SELECT * FROM user inner join service on user.U_id = service.id_reparateur";
  $res = $bdd->prepare($req);
  // $res->bindParam(':id', $id, PDO::PARAM_STR)
  try{
    $res->execute();
    $lesServices = $res->fetchAll();
    return $lesServices;
  }
  catch(Exception $e){
    oups("Erreur grave",$e->getMessage(),"1","index.php");
  }
}

function getLesDemandesReparateur($bdd, $id){
  $req = "select demande.*,service.titre 'titre_service',
  service.description'description_service',
  service.tarif 'tarif_service', service.img 'img_service', client.nom 'nom_client',
  client.prenom 'prenom_client', client.email 'email_client',client.tel 'tel_client'
  from demande,service,user reparateur,user client
  WHERE demande.id_service=service.S_id
  and service.id_reparateur=reparateur.U_id
  and demande.id_client=client.U_id
  and reparateur.U_id= :id  and etat_intervention != 'TERMINEE' order by etat_intervention";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  $req1="call updateDemande()";
  $res1 = $bdd->prepare($req1);
  try {
    $res1 -> execute();
  }
  catch (\Exception $e) {

  }
  try{
    $res->execute();
    $mesDemandes = $res->fetchAll();
    return $mesDemandes;
   }
   catch(Exception $e){
     oups("Erreur grave",$e->getMessage(),"1","index.php");
   }
 }

 function getLesDemandesReparateur1($bdd, $id){
   $req = "select demande.*,service.titre 'titre_service',
   service.description'description_service',
   service.tarif 'tarif_service', service.img 'img_service', client.nom 'nom_client',
   client.prenom 'prenom_client', client.email 'email_client',client.tel 'tel_client'
   from demande,service,user reparateur,user client
   WHERE demande.id_service=service.S_id
   and service.id_reparateur=reparateur.U_id
   and demande.id_client=client.U_id
   and reparateur.U_id= :id  and etat_intervention = 'TERMINEE' order by etat_intervention";
   $res = $bdd->prepare($req);
   $res->bindParam(':id', $id, PDO::PARAM_STR);
   $req1="call updateDemande()";
   $res1 = $bdd->prepare($req1);
   try {
     $res1 -> execute();
   }
   catch (\Exception $e) {

   }
   try{
     $res->execute();
     $mesDemandes = $res->fetchAll();
     return $mesDemandes;
    }
    catch(Exception $e){
      oups("Erreur grave",$e->getMessage(),"1","index.php");
    }
  }

 function getMesServices($bdd, $id){
   $req = "SELECT * from service where id_reparateur= :id";
   $res = $bdd->prepare($req);
   $res->bindParam(':id', $id, PDO::PARAM_STR);
   try{
     $res -> execute();
     $mesServices = $res->fetchAll();
     return $mesServices;
   }
   catch(Exception $e){
     oups("Erreur de selection", $e->getMessage(),"1","index.php");
   }
 }

 function getLeServiceReparateur($bdd, $idS){
   $req = "SELECT * FROM user inner join service on user.U_id = service.id_reparateur where S_id= :id ";
   $res = $bdd->prepare($req);
   $res->bindParam(':id', $idS, PDO::PARAM_STR);
   try{
     $res -> execute();
     $laLigne = $res->fetch(PDO::FETCH_ASSOC);
     return $laLigne;
   }
   catch(Exception $e){
     oups("Erreur grave",$e->getMessage(),"1","index.php");
   }
 }

function getMesDemandes($bdd,$id){
  $req = 'SELECT * FROM demande inner join service on service.S_id = demande.id_service where id_client= :id and etat_intervention !="TERMINEE" order by etat_intervention';
  $req1="call updateDemande()";
  $res1 = $bdd->prepare($req1);
  try {
    $res1 -> execute();
  }
  catch (\Exception $e) {
  }
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res -> execute();
    $lesDemandes = $res->fetchAll();
    return $lesDemandes;
  }
  catch(Exception $e){
    oups("Erreur de selection", $e->getMessage(),"1","index.php");
  }
}

function getMesDemandes1($bdd,$id){
  $req = "SELECT * FROM demande inner join service on service.S_id = demande.id_service where id_client= :id and etat_intervention='TERMINEE' order by etat_intervention";
  $req1="call updateDemande()";
  $res1 = $bdd->prepare($req1);
  try {
    $res1 -> execute();
  }
  catch (\Exception $e) {
  }
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res -> execute();
    $lesDemandes = $res->fetchAll();
    return $lesDemandes;
  }
  catch(Exception $e){
    oups("Erreur de selection", $e->getMessage(),"1","index.php");
  }
}

function getRepresentation($bdd){
  $req = "SELECT COUNT(demande.id) as nombre_demande, service.titre, user.nom, service.img from demande, service, user WHERE demande.id_service = service.S_id AND user.U_id=service.id_reparateur group by service.S_id";
  $res = $bdd->prepare($req);
  try {
    $res -> execute();
    $Representations = $res->fetchAll();
    return $Representations;
  }
  catch (Exception $e) {
    oups("Erreur de selection", $e->getMessage(),"1","index.php");
  }
}

function getMesGains($bdd,$id){
  $req = "SELECT * FROM reparateur_gain where U_id= :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res -> execute();
    $lesGains = $res->fetchAll();
    return $lesGains;
  }
  catch(Exception $e){
    oups("Erreur de selection", $e->getMessage(),"1","index.php");
  }
}

function getMesDetails($bdd,$id){
  $req = "select demande.*,service.titre 'titre_service', service.description'description_service',
  service.tarif 'tarif_service', service.img 'img_service',
  client.nom 'nom_client', client.prenom 'prenom_client',
  client.email 'email_client',client.tel 'tel_client'
  from demande,service,user reparateur,user client
  WHERE demande.id_service=service.S_id and service.id_reparateur=reparateur.U_id
  and demande.id_client=client.U_id and etat_intervention = 'TERMINEE' and reparateur.U_id= :id order by date_intervention DESC";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res -> execute();
    $lesDetails = $res->fetchAll();
    return $lesDetails;
  }
  catch(Exception $e){
    oups("Erreur de selection", $e->getMessage(),"1","index.php");
  }
}

function oups($messageUser, $messageTechnique, $severite, $adresse_Retour){?>
  <div class="err_<?= $severite ?>">
    <h3><?= $messageUser;?></h3>
  </div>
  <div>
    <p><?= $messageTechnique;?></p>
  </div>
  <?//echo $severite."</br>";?>
  <div>
    <p><a href="<?= $adresse_Retour ?>">Retour</a></p>
  </div>
  <?php
  die();
}

function updateReparateur($id){
  $bdd=connexionBD();
  $req = "update user set reparateur = 1 where U_id = :id";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);

  $res->execute();
  if(!$res){
    echo $res->errorInfo();
    return null;
  }
  else{
    $_SESSION['reparateur']=1;
  }
}

function uploadPicture($image){
	$target_dir = "img/";
  $target_file = $target_dir . basename($image["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if(isset($_POST["submit"])) {
    $check = getimagesize($image["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    }
    else {
      $uploadOk = 0;
    }
  }
  if ($image["size"] > 500000) {
    $uploadOk = 0;
  }
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    echo "<h5 style='color:white; text-align:center'>Sorry, your file was not uploaded.</h5>";
  }
  else {
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
      return $target_file;
    }
    else {
      return false;
    }
  }
}

function calcDistance($depart,$arrivee) {
				//récupérer la clé d'API
				$obj=json_decode(file_get_contents("data.json"));
				$key = $obj->GOOGLE_API;
				// replace all the white space with "+" sign to match with google search pattern
				$depart = urlencode($depart);
				$arrivee = urlencode($arrivee);
				$url = "https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now&destinations=$arrivee&origins=$depart&key=$key";
				$response = file_get_contents($url);
				// generate array object from the response from the web
				$json = json_decode($response,TRUE);
				$distance = $json['rows'][0]['elements'][0]['distance']['value']/1000;
				//renvoyer le résultat
				return $distance;
			}

function calcDemandes($bdd, $id){
  $req = "SELECT COUNT(*) as nb from demande where id_client= :id AND etat_intervention != 'TERMINEE'";
  $res = $bdd->prepare($req);
  $res->bindParam(':id', $id, PDO::PARAM_STR);
  try{
    $res -> execute();
    $ligne = $res->fetch();
    return $ligne['nb'];
  }
  catch(Exception $e){
    oups("Erreur de selection", $e->getMessage(),"1","index.php");
  }
}

function getLesGagnants($bdd, $date){
  $req = "SELECT count(demande.id), user.U_id, user.nom, user.prenom from demande, user, service where user.U_id= service.id_reparateur and demande.id_service = service.S_id and user.gagner = 0 and demande.etat_intervention = 'TERMINEE' and month(demande.date_intervention) = :date group by user.U_id ";
  $res = $bdd->prepare($req);
  $res->bindParam(':date', $date, PDO::PARAM_STR);
  try{
    $res->execute();
    $lesGagnants = $res->fetchAll();
    return $lesGagnants;
  }
  catch(Exception $e){
    oups("Erreur grave",$e->getMessage(),"1","index.php");
  }
}
?>
