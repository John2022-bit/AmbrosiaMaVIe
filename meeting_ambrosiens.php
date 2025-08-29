<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}
	
	$utilisateur_id = (int) $_SESSION['id'];
	
	if(empty($utilisateur_id)){
		header('Location: index.php');
		exit;	
	}
	
	$req = $BDD->prepare("SELECT m.*, p.nom_fr_fr
		FROM meeting_members m
		INNER JOIN pays p ON p.code = m.pays
		WHERE m.id = ?");
		
	$req->execute(array($utilisateur_id));
		
	$voir_utilisateur = $req->fetch();
	
	if(!isset($voir_utilisateur['id'])){
		header('Location: index.php');
		exit;	
	}
	
	if(!empty($_POST)){
		extract($_POST);
		$valid = (boolean) true;
		
		if(isset($_POST['modifier'])){
			$nom = (String) trim($nom);
			$profession = (String) trim($profession);
			$civilite = (String) trim($civilite);
			$description = (String) trim($description);
			$telephone = (String) trim($telephone);
			$ville = (String) trim($ville);
			$mail = (String) strtolower(trim($mail));
			
			$taille = (String) trim($taille);
			$yeux = (String) trim($yeux);
			$cheveux = (String) trim($cheveux);
			$fume = (String) trim($fume);
			$sport = (String) trim($sport);
			$religion = (String) trim($religion);
			$animal = (String) trim($animal);
			$qualite = (String) trim($qualite);
			$defaut = (String) trim($defaut);
									
			if(empty($nom)){
				$valid = false;
				$err_nom = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE nom_user = ? AND id <> ?");
					
				$req->execute(array($nom, $_SESSION['id']));
				$utilisateur = $req->fetch();
				
				if(isset($utilisateur['id'])){
					$valid = false;
					$err_nom = "Ce nom existe déjà";
				}
			}
			
			if(empty($mail)){
				$valid = false;
				$err_mail = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE mail = ? AND id <> ?");
					
				$req->execute(array($mail, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($profession)){
				$valid = false;
				$err_profession = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE profession = ? AND id <> ?");
					
				$req->execute(array($profession, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($civilite)){
				$valid = false;
				$err_civilite = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE civilite = ? AND id <> ?");
					
				$req->execute(array($civilite, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($description)){
				$valid = false;
				$err_description = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE description = ? AND id <> ?");
					
				$req->execute(array($description, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($telephone)){
				$valid = false;
				$err_telephone = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE telephone = ? AND id <> ?");
					
				$req->execute(array($telephone, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($ville)){
				$valid = false;
				$err_ville = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE ville = ? AND id <> ?");
					
				$req->execute(array($ville, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($taille)){
				$valid = false;
				$err_taille = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE taille = ? AND id <> ?");
					
				$req->execute(array($taille, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($yeux)){
				$valid = false;
				$err_yeux = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE yeux = ? AND id <> ?");
					
				$req->execute(array($yeux, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($cheveux)){
				$valid = false;
				$err_cheveux = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE cheveux = ? AND id <> ?");
					
				$req->execute(array($cheveux, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($fume)){
				$valid = false;
				$err_fume = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE fume = ? AND id <> ?");
					
				$req->execute(array($fume, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($sport)){
				$valid = false;
				$err_sport = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE sport = ? AND id <> ?");
					
				$req->execute(array($sport, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($religion)){
				$valid = false;
				$err_religion = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE religion = ? AND id <> ?");
					
				$req->execute(array($religion, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($animal)){
				$valid = false;
				$err_animal = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE animal = ? AND id <> ?");
					
				$req->execute(array($animal, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($qualite)){
				$valid = false;
				$err_qualite = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE qualite = ? AND id <> ?");
					
				$req->execute(array($qualite, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($defaut)){
				$valid = false;
				$err_defaut = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
					WHERE defaut = ? AND id <> ?");
					
				$req->execute(array($defaut, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if($valid){
								
				$req = $BDD->prepare("UPDATE meeting_members SET nom_user = ?, profession = ?, civilite = ?, description = ?, telephone = ?, ville = ?, taille = ?, yeux = ?, cheveux = ?, fume = ?, sport = ?, religion = ?, animal = ?, qualite = ?, defaut = ? WHERE id = ?");
					
				$req->execute(array($nom, $profession, $civilite, $description, $telephone, $ville, $taille, $yeux, $cheveux, $fume, $sport, $religion, $animal, $qualite, $defaut, $_SESSION['id']));
				header('Location: meeting_femm.php');
				exit;
			}
		}
	} 		
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    
    <!-- Title-->
    <title>Les ambrosiens</title>
    
    <!-- SEO Meta-->
    <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<meta name="mobile-web-app-capable" content="yes">
		<!-- viewport scale-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="assets/css/style_carroussel.css" />
		<!-- stylesheet-->    
		<link rel="stylesheet" href="assets/css/vendors.bundle.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<!-- Icon fonts -->
		<link rel="stylesheet" href="assets/fonts/fontawesome/css/all.css">
		<link rel="stylesheet" href="assets/fonts/themify-icons/css/themify-icons.css">
  </head>
	<?php include("InfoContacts.php");?> 
  <body>
 
	<div class="container">
		<div class="row">
			<div class="slider">
				<div class="slide" ><img src="images/ph01.png"/><p>rutrum tellus a tempus </p></div>
				<div class="slide"><img src="images/fdl1.png" /><p>litora torquent per conubia</p></div>
				<div class="slide"><img src="images/fdl4.jpg" /><p>sed consectetur faucibus</p></div>
				<div class="slide" ><img src="images/fdl7.jpg" /><p>eleifend tempus justo</p></div>
			</div>
		</div>
	</div>
	
	<?php include("footer.php"); ?>

	<div class="scroll-top">
	  <i class="ti-angle-up"></i>
	</div>		 
		<script src="assets/js/vendors.bundle.js"></script>
		<script src="assets/js/scripts.js"></script>		
		<script src="assets/js/main_Carroussel.js"></script>
</body>
	</html>