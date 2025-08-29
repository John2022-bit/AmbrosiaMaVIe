<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}
	
	$utilisateur_id = (int) $_SESSION['id'];
	
	if(empty($utilisateur_id)){
		header('Location: /membres.php');
		exit;	
	}
	
	$req = $BDD->prepare("SELECT u.*, p.nom_fr_fr
		FROM utilisateur u
		INNER JOIN pays p ON p.code = u.pays
		WHERE u.id = ?");
		
	$req->execute(array($utilisateur_id));
		
	$voir_utilisateur = $req->fetch();
	
	if(!isset($voir_utilisateur['id'])){
		header('Location: /membres.php');
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
			
			
			if(empty($nom)){
				$valid = false;
				$err_nom = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE nom_user = ? AND id <> ?");
					
				$req->execute(array($nom, $_SESSION['id']));
				$utilisateur = $req->fetch();
				
				if(isset($utilisateur['id'])){
					$valid = false;
					$err_nom = "Ce nom existe déjà";
				}
			}
			
			if(empty($profession)){
				$valid = false;
				$err_profession = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE profession = ? AND id <> ?");
					
				$req->execute(array($profession, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($civilite)){
				$valid = false;
				$err_civilite = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE civilite = ? AND id <> ?");
					
				$req->execute(array($civilite, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($description)){
				$valid = false;
				$err_description = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE description = ? AND id <> ?");
					
				$req->execute(array($description, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($telephone)){
				$valid = false;
				$err_telephone = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE telephone = ? AND id <> ?");
					
				$req->execute(array($telephone, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if(empty($ville)){
				$valid = false;
				$err_ville = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE ville = ? AND id <> ?");
					
				$req->execute(array($ville, $_SESSION['id']));
				$utilisateur = $req->fetch();
			}
			
			if($valid){
								
				$req = $BDD->prepare("UPDATE utilisateur SET nom_user = ?, profession = ?, civilite = ?, description = ?, telephone = ?, ville = ? WHERE id = ?");
					
				$req->execute(array($nom, $profession, $civilite, $description, $telephone, $ville, $_SESSION['id']));
				header('Location: /profil.php');
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
    <title>Ambrosia</title>
    
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
	<?php include("menuSession.php"); ?>
		
   <section class="paddingTop-50 paddingBottom-120 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mt-6">
          <div class="card shadow-v1 padding-30">
            <ul class="nav tab-line tab-line border-bottom mb-4" role="tablist">
             <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#Tabs_1-1" role="tab" aria-selected="true">
                Editer/modifier votre profil
              </a>
             </li>
           </ul>
           
           <div class="tab-content"> 			
			<div class="tab-pane fade show active" id="Tabs_1-1" role="tabpanel">			
              <form method="POST">   
                <div class="border-bottom mb-4 pb-4">
                   <h4 class="mb-4">
                     Gérer votre compte
                   </h4>						
						   
						<div class="form-group row">
							<?php
								if(isset($err_nom)){
								echo $err_nom;
								}
								if(!isset($nom)){
								$nom = $voir_utilisateur['nom_user'];
								}
								?>
							<label class="col-md-3 col-form-label text-dark">Nom complet</label>
							<div class="col-md-9">
							  <input type="text" class="form-control" name="nom" value="<?= $nom ?>">
							</div>
						</div>
						<div class="form-group row">
							<?php
								if(isset($err_profession)){
								echo $err_profession;
								}
								if(!isset($profession)){
								$profession = $voir_utilisateur['profession'];
								}
								?>
							<label class="col-md-3 col-form-label text-dark">Profession</label>
							<div class="col-md-9">
							  <input type="text" class="form-control" name="profession" value="<?= $profession ?>">
							</div>
						</div>
						<div class="form-group row">
							<?php
								if(isset($err_civilite)){
								echo $err_civilite;
								}
								?>
							<label class="col-md-3 col-form-label text-dark">Civilité</label>
							<div class="col-md-9">
							  <select class="form-control custom-select" name="civilite">
										<option value="Femme">Femme</option>
										<option value="Homme">Homme</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<?php
								if(isset($err_description)){
								echo $err_description;
								}
								if(!isset($description)){
								$description = $voir_utilisateur['description'];
								}
								?>
							<label class="col-md-3 col-form-label text-dark">à propos de moi</label>
							<div class="col-md-9">
							  <input type="text" class="form-control" name="description" value="<?= $description ?>">
							</div>
						</div>
						
						<div class="form-group row">
							<?php
								if(isset($err_telephone)){
								echo $err_telephone;
								}
								if(!isset($telephone)){
								$telephone = $voir_utilisateur['telephone'];
								}
								?>
							<label class="col-md-3 col-form-label text-dark">Téléphone</label>
							<div class="col-md-9">
							  <input type="tel" class="form-control" name="telephone" value="<?= $telephone ?>">
							</div>
						</div>
						
						<div class="form-group row">
							<?php
								if(isset($err_ville)){
								echo $err_ville;
								}
								if(!isset($ville)){
								$ville = $voir_utilisateur['ville'];
								}
								?>
							<label class="col-md-3 col-form-label text-dark">Ville de résidence</label>
							<div class="col-md-9">
							  <input type="text" class="form-control" name="ville" value="<?= $ville ?>">
							</div>
						</div>
						   
					<div class="my-5">
						   <input type="submit" name="modifier" value="Modifier">
						</div>
					</form>
              </div> <!-- END tab-pane -->   
			</div> <!-- END tab-content-->
          </div> <!-- END card-->
        </div> <!-- END col-md-8 -->
      </div> <!--END row-->
    </div> <!--END container-->
  </section>
	
		<?php include("footer.php");?>

		<div class="scroll-top">
		  <i class="ti-angle-up"></i>
		</div>
     
    <script src="assets/js/vendors.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
  </body>
</html>