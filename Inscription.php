<?php
	session_start();
	include_once('db/connexiondb.php');	

	if(isset($_SESSION['id'])){
		header('Location: /');
		exit;
	}

	if(!empty($_POST)){
		extract($_POST);
		$valid = (boolean) true;
		
		if(isset($_POST['page-singup'])){
			$nom_user = (String) trim($nom_user);
			$ville = (String) trim($ville);
			$matrimonialstatut = (String) trim($matrimonialstatut);
			$profession = (String) trim($profession);
			$telephone = (String) trim($telephone);
			$pseudo = (String) trim($pseudo);
			$mail = (String) strtolower(trim($mail));
			$password = (String) trim($password);
			$jour = (int) $jour;
			$mois = (int) $mois;
			$annee = (int) $annee;
			$pays = (String) trim($pays);
			$date_naissance = (String) null;
			
			if(empty($pseudo)){
				$valid = false;
				$err_pseudo = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE pseudo = ?");
					
				$req->execute(array($pseudo));
				$utilisateur = $req->fetch();
				
				if(isset($utilisateur['id'])){
					$valid = false;
					$err_pseudo = "Ce pseudo existe déjà";
				}
			}
			
			if(empty($mail)){
				$valid = false;
				$err_mail = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE mail = ?");
					
				$req->execute(array($mail));
				$utilisateur = $req->fetch();
				
				if(isset($utilisateur['id'])){
					$valid = false;
					$err_mail = "Ce mail existe déjà";
				}
			}
			
			if(empty($password)){
				$valid = false;
				$err_password = "Veuillez renseigner ce champs !";
			}
						
			if($jour <= 0 || $jour > 31){
				$valid = false;
				$err_jour = "Veuillez renseigner ce champs jour !";
			}
			
			$verif_mois = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
						
			if(!in_array($mois, $verif_mois)){
				$valid = false;
				$err_mois = "Veuillez renseigner ce champs mois !";
			}
			
			$verif_annee = array(1945, 1946, 1947, 1948, 1949, 1950, 1951, 1952, 1953, 1954, 1955, 1956, 1957, 1958, 1959, 1960, 1961, 1962, 1963, 1964, 1965, 1966, 1967, 1968, 1969, 1970, 1971, 1972, 1973, 1974, 1975, 1976,
			 1977, 1978, 1980, 1981, 1982, 1983, 1984, 1985, 1986, 1987, 1988, 1989, 1990, 1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999, 2000);
						
			if(!in_array($annee, $verif_annee)){
				$valid = false;
				$err_annee = "Veuillez renseigner ce champs annee !";
			}
			
			if(!checkdate($mois, $jour, $annee)){
				$valid = false;
				$err_date = "Date fausse";
			}else{
				$date_naissance = $annee . '-' . $mois . '-' . $jour;
			}
			
			
			$req = $BDD->prepare("SELECT id
				FROM pays
				WHERE code = ?");
			$req->execute(array($pays));
			
			$verif_pays = $req->fetch();
						
			if(!isset($verif_pays['id'])){
				$valid = false;
				$err_pays = "Veuillez renseigner ce champs !";
			}
			
			if(!isset($nom_user)){
				$valid = false;
				$err_nom_user = "Veuillez renseigner ce champs !";
			}
			
			if(!isset($ville)){
				$valid = false;
				$err_ville = "Veuillez renseigner ce champs !";
			}
			
			if(!isset($profession)){
				$valid = false;
				$err_profession = "Veuillez renseigner ce champs !";
			}
			
			if(!isset($telephone)){
				$valid = false;
				$err_telephone = "Veuillez renseigner ce champs !";
			}
			
			if(!isset($matrimonialstatut)){
				$valid = false;
				$err_matrimonialstatut = "Veuillez renseigner ce champs !";
			}
			
			if($valid){
				$date_inscription = date("Y-m-d h:m:s");
				
				$password = crypt($password, '$5$rounds=5000$usesomesillystri$KqJWlhgiuyfuTEZ543TSaYhEWsQ1Lr5QNyPCDH/Tp.6');
				
				$req = $BDD->prepare("INSERT INTO utilisateur (pseudo, mail, password, date_naissance, pays, nom_user, ville, matrimonialstatut, profession, telephone, date_inscr, date_conn) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					
				$req->execute(array($pseudo, $mail, $password, $date_naissance, $pays, $nom_user, $ville, $matrimonialstatut, $profession, $telephone, $date_inscription, $date_inscription));
				
				header('Location: connexion.php');
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
    <title>Signup-Ambrosia Rose</title>
    
    <!-- SEO Meta-->
    <meta name="description" content="Agence Matrimoniale">
    <meta name="keywords" content="mariage, couple, mixte, papier, papiers, amour, voyage">
    <meta name="author" content="Rencontres amoureuses">
    
    <!-- viewport scale-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
            
    <!-- Favicon and Apple Icons-->
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
  
  <body>
   
    <?php include("InfoContacts-deconnexion.php");?>
   	
	 <section class="height-90vh padding-y-80 flex-center bg-center bg-cover" data-dark-overlay="5" style="background:url(img/ambrosia1.jpg) no-repeat">
	  <div class="container">
		<div class="row align-items-center">
		  
		  <div class="col-lg-4 col-md-5 my-3">
			<div class="card px-4 py-5 text-center">		 
			  <h4 class="mt-4">
			  <img src="img/Logo_Ambr_Fleur.png" alt="Fleur Ambrosia Rose" heigth="53" width="53" align="center">
					Créer votre compte
				</h4>
			  <p class="mb-4">
				Découvrez<a href="http://ambrosiarose.com/AdminLTE-master/pages/examples/welcome.php"> notre démarche</a>.
			  </p>
			<form method="POST" class="px-lg-4">
					
					  <div class="form-group">
						  <input type="text" class="form-control" name="pseudo" placeholder="Pseudo" value="<?php if(isset($pseudo)){ echo $pseudo;} ?>">
						  <small class="form-text text-muted">
							<?php
								if(isset($err_pseudo)){
									echo $err_pseudo;
								}	
							?>
						  </small>
					  </div>
					  <div class="form-group">
						  <input type="text" class="form-control" name="nom_user" placeholder="Votre nom" value="<?php if(isset($nom_user)){ echo $nom_user;} ?>">
						  <small class="form-text text-muted">
							<?php
								if(isset($err_nom_user)){
									echo $err_nom_user;
								}	
							?>
						  </small>
					  </div>
									  
					  <div class="input-group input-group--focus mb-3">						
						<div class="input-group-prepend">
						  <span class="input-group-text bg-white ti-email"></span>
						</div>
						<input type="mail" name="mail" class="form-control border-left-0 pl-0" placeholder="Email" value="<?php if(isset($mail)){ echo $mail;} ?>">
						<small class="form-text text-muted">
							<?php if(isset($err_mail)){
								echo $err_mail;
								}
							?>
						</small>
					  </div>
					  
					  <div class="input-group input-group--focus mb-3">
						  <?php
								if(isset($err_password)){
									echo $err_password;
								}	
							?>
						<div class="input-group-prepend">
						  <span class="input-group-text bg-white ti-lock"></span>
						</div>
						<input type="password" name="password" class="form-control border-left-0 pl-0" placeholder="Password" value="<?php if(isset($password)){ echo $password;} ?>" required>
					  </div>
					  
					<div class="input-group input-group--focus mb-3">
						<?php
							if(isset($err_pays)){
								echo $$err_pays;
							}	
						?>
					  <div class="input-group mb-3">
						<select class="form-control custom-select" name="pays">
						  <option selected>Pays de résidence</option>
						  <?php
								if(isset($pays)){
									$req = $BDD->prepare("SELECT code, nom_fr_fr
										FROM pays
										WHERE code = ?");
									$req->execute(array($pays));
									$voir_pays = $req->fetch();
							?>
							<option value="<?= $voir_pays['code'] ?>"><?= $voir_pays['nom_fr_fr'] ?></option>
							<?php
								}	

								$req = $BDD->prepare("SELECT code, nom_fr_fr
									FROM pays");
								$req->execute();
								$voir_pays = $req->fetchAll();	
								
								foreach($voir_pays as $vd){
							?>
							<option value="<?= $vd['code'] ?>"><?= $vd['nom_fr_fr'] ?></option>
							<?php	
								}
							?>
						</select>
					  </div>
					 </div>
					 
					 <div class="form-group">
						  <input type="text" class="form-control" name="ville" placeholder="Ville de résidence" value="<?php if(isset($ville)){ echo $ville;} ?>">
						  <small class="form-text text-muted">
							<?php
								if(isset($err_ville)){
									echo $err_ville;
								}	
							?>
						  </small>
					  </div>
					  
					  <div class="input-group mb-3">
						<select class="form-control custom-select" name="matrimonialstatut">
						  <option selected>Statut matrimonial:</option>
						  <option value="celibataire">Célibataire</option>
						  <option value="en_couple">En couple</option>
						</select>
					  </div>			
					  
					<div class="input-group input-group--focus mb-3">
						<label>
							Date de naissance: 
						</label>
					<div>
						<?php
							if(isset($err_jour)){
								echo $err_jour;
							}	
							if(isset($err_mois)){
								echo $err_mois;
							}	
							if(isset($err_annee)){
								echo $err_annee;
							}	
							if(isset($err_date)){
								echo $err_date;
							}	
						?>
						<select name="jour">
							<?php
								for($i = 1; $i <= 31; $i++){
							?>
							<option value="<?= $i ?>"><?= $i ?></option>
							<?php
								}
							?>
						</select>
						<select name="mois">
							<option value="1">Janvier</option>
							<option value="2">Février</option>
							<option value="3">Mars</option>
							<option value="4">Avril</option>
							<option value="5">Mai</option>
							<option value="6">Juin</option>
							<option value="7">Juillet</option>
							<option value="8">Août</option>
							<option value="9">Septembre</option>
							<option value="10">Octobre</option>
							<option value="11">Novembre</option>
							<option value="12">Décembre</option>
						</select>
						<select name="annee">
							<?php
								for($i = 2000; $i >= 1945; $i--){
							?>
							<option value="<?= $i ?>"><?= $i ?></option>
							<?php
								}
							?>
						</select>
						</div>
					</div>
					
					<div class="form-group">
						  <input type="text" class="form-control" name="profession" placeholder="Profession" value="<?php if(isset($profession)){ echo $profession;} ?>">
						  <small class="form-text text-muted">
							<?php
								if(isset($err_profession)){
									echo $err_profession;
								}	
							?>
						  </small>
					</div>
					
					<div class="form-group">
						  <input type="text" class="form-control" name="telephone" placeholder="Numéro de portable" value="<?php if(isset($telephone)){ echo $telephone;} ?>">
						  <small class="form-text text-muted">
							<?php
								if(isset($err_telephone)){
									echo $err_telephone;
								}	
							?>
						  </small>
					  </div>
									  
					  <div class="my-4">
						<label class="ec-checkbox check-sm my-2 clearfix">
						  <input type="checkbox" name="checkbox">
						  <span class="ec-checkbox__control mt-1"></span>
						  <span class="ec-checkbox__lebel">
							En vous inscrivant, vous acceptez 
							<a href="page-terms-and-privacy-policy.html" class="text-primary">nos conditions d'utilisation</a>
							 et
							<a href="page-terms-and-privacy-policy.html" class="text-primary">notre politique de confidentialité.</a>
						  </span>
						</label>
					  </div>
					  <button type="submit" name="page-singup" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal__Default">S'inscrire maintenant</button>
					  <!-- Modal default-->
						<div class="modal fade" id="modal__Default" tabindex="-1" role="dialog" aria-labelledby="modal__Default" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-body py-4">
								Votre compte Ambrosia Rose est créé.
							  </div>
							</div>
						  </div>
						</div>
					  <p class="my-5 text-center">
						Vous avez dèjà un compte? <a href="Connexion.php" class="text-primary">Se connecter</a>
					  </p>
					</form>	
			</div>
		  </div>
		</div>
	  </div> <!-- END container-->
	</section>
<?php include("footer.php");?> 
	<div class="scroll-top">
	  <i class="ti-angle-up"></i>
	</div>
		 
		<script src="assets/js/vendors.bundle.js"></script>
		<script src="assets/js/scripts.js"></script>
	  </body>
	</html>