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
    <title>Editer mon profil</title>
    
    <!-- SEO Meta-->
    <meta name="description" content="Agence matrimoniale">
    <meta name="keywords" content="mariage, agence matrimoniale, couple mixte, amour">
    <meta name="author" content="Babouk">
    
    <!-- viewport scale-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
            
    <!-- Favicon and Apple Icons    -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico">
    <link rel="shortcut icon" href="assets/img/favicon/114x114.png">
    <link rel="apple-touch-icon-precomposed" href="assets/img/favicon/96x96.png">

    
    <!--Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700%7CWork+Sans:400,500">
    
    
    <!-- Icon fonts -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/fonts/themify-icons/css/themify-icons.css">
    
    
    <!-- stylesheet-->    
    <link rel="stylesheet" href="assets/css/vendors.bundle.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
  </head>
	<?php include("InfoContacts-deconnexion.php");?> 
  <body>
	<?php include("meeting_menu.php");?> 
	
  <section class="paddingTop-50 paddingBottom-120 bg-light">
    <div class="container">		
		 <div class="row mt-5">
           <div class="col-12 text-center my-5">
             <h4>
               <?= $_SESSION['pseudo'] ?>, éditez votre profil
             </h4>
           </div>
            <div class="col-8 mx-auto">
				<h5 class="mb-4">
                Ce que nous savons de vous
				</h5>
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="row mt-4">
					  <div class="col-md-6 mb-4">
						<?php
							if(isset($err_pseudo)){
							echo $err_pseudo;
							}
							if(!isset($pseudo)){
							$pseudo = $voir_utilisateur['pseudo'];
							}
							?>
						<input type="text" class="form-control" name="pseudo" placeholder="<?= $pseudo ?>">
						<small class="form-text text-muted">
							votre pseudo
						</small>
					  </div>
					  <div class="col-md-6 mb-4">
						<?php
							if(isset($err_mail)){
							echo $err_mail;
							}
							if(!isset($mail)){
							$mail = $voir_utilisateur['mail'];
							}
							?>
						<input type="mail" class="form-control" name="mail" placeholder="<?= $mail ?>">
						<small class="form-text text-muted">
							votre mail
						</small>
					  </div>
					  <div class="col-md-6 mb-4">
						<?php
							if(isset($err_telephone)){
							echo $err_telephone;
							}
							if(!isset($telephone)){
							$telephone = $voir_utilisateur['telephone'];
							}
							?>
						<input type="tel" class="form-control" name="telephone" placeholder="<?= $telephone ?>">
						<small class="form-text text-muted">
							votre numéro de téléphone
						</small>
					  </div>
					</div>
				</form>	
				<hr>
				<form action="meeting_Ajout_Photos.php" method="POST" enctype="multipart/form-data">	
					<h5 class="mb-4">
						Soumettez vos photos</br> 
					</h5>
					<p>
					   <code>L'équipe de Ambrosia pourra vous conseiller si besoin dans le choix des photos.</code> 
					 </p>
					<p>Chaque photo doit avoir une taille inférieure à 2 Mo.</p>
					 <input type="file" name="photo"> </br>
					 <input type="file" name="photo1"> </br>
					 <input type="file" name="photo2"> </br>
					 <input type="file" name="photo3">
					<button class="btn btn-dark" type="submit" name="photos">Soumettez vos photos</button>
				</form>
				<hr>
				<form action="meeting_Ajout_profil.php" method="POST">
					<h5 class="mb-4">
						Plus de details à propos de vous
					</h5>
					<div class="form-group">
					  <input type="text" class="form-control" name="taille" placeholder="Indiquez votre taille.">
					  <small class="form-text text-muted">
						 Exemple: 1m65
					  </small>
					</div>
					<div class="form-group">
					  <input type="text" class="form-control" name="yeux" placeholder="Indiquez la couleur de vos yeux.">
					  <small class="form-text text-muted">
						 Exemple: yeux marrons clairs
					  </small>
					</div>
					<div class="form-group">
					  <input type="text" class="form-control" name="cheveux" placeholder="Indiquez la couleur de vos cheveux.">
					  <small class="form-text text-muted">
						 Exemple: poivre et sel
					  </small>
					</div>
					<div class="form-group">
					  <input type="text" class="form-control" name="fume" placeholder="Etes-vous fumeur?">
					  <small class="form-text text-muted">
						 Exemple: j'essaie d'arreter de fumer <b>OU</b> je ne fume pas
					  </small>
					</div>
					<div class="form-group">
					  <input type="text" class="form-control" name="sport" placeholder="Pratiquez-vous du sport?">
					  <small class="form-text text-muted">
						 Exemple: je fais du tennis tous les weekend
					  </small>
					</div>
					<div class="form-group">
					  <input type="text" class="form-control" name="religion" placeholder="Etes-vous croyant?">
					  <small class="form-text text-muted">
						 Exemple: je suis catholique <b>OU</b> je le garde pour moi
					  </small>
					</div>
					<div class="form-group">
					  <input type="text" class="form-control" name="animal" placeholder="Avez-vous un animlal de compagnie?">
					  <small class="form-text text-muted">
						 Exemple: j'aime beaucoup les chats <b>OU</b> je suis allergique aux poils de chien
					  </small>
					</div>
					<div class="form-group">
					  <input type="text" class="form-control" name="qualite" placeholder="Quelle est votre principale qualité?">
					  <small class="form-text text-muted">
						 Exemple: Tout le monde dite de moi que je suis patient.
					  </small>
					</div>
					<div class="form-group">
					  <input type="text" class="form-control" name="defaut" placeholder="Quel est votre principale defaut?">
					  <small class="form-text text-muted">
						 Exemple: Je suis dépensier.
					  </small>
					</div>
					<button class="btn btn-dark" type="submit" name="update">Mettre à jour</button>
				</form>
            </div>
        </div> <!-- END row-->
    </div> <!--END container-->
  </section>
  
	<?php include("footer.php"); ?>

	<div class="scroll-top">
	  <i class="ti-angle-up"></i>
	</div>
		 
		<script src="assets/js/vendors.bundle.js"></script>
		<script src="assets/js/scripts.js"></script>
	  </body>
	</html>