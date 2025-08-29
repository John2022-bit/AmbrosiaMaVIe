<?php
	include_once('db/connexiondb.php');	

	if(!empty($_POST)){
		extract($_POST);
		$valid = (boolean) true;
		
		if(isset($_POST['meeting_register'])){
			$civilite = (String) trim($civilite);
			$recherche = (String) trim($recherche);
			$pseudo = (String) trim($pseudo);
			$nom_user = (String) trim($nom_user);
			$mail = (String) strtolower(trim($mail));
			$password = (String) trim($password);
			$pays = (String) trim($pays);
			$ville = (String) trim($ville);			
			$matrimonialstatut = (String) trim($matrimonialstatut);
			$profession = (String) trim($profession);
			$telephone = (String) trim($telephone);
			$description = (String) trim($description);
						
			$jour = (int) $jour;
			$mois = (int) $mois;
			$annee = (int) $annee;
			
			$date_naissance = (String) null;
			
			if(empty($pseudo)){
				$valid = false;
				$err_pseudo = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
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
					FROM meeting_members 
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
			
			if(!isset($civilite)){
				$valid = false;
				$err_civilite = "Veuillez renseigner ce champs !";
			}
			
			if(!isset($recherche)){
				$valid = false;
				$err_recherche = "Veuillez renseigner ce champs !";
			}
			
			if(!isset($telephone)){
				$valid = false;
				$err_telephone = "Veuillez renseigner ce champs !";
			}
			
			if(!isset($matrimonialstatut)){
				$valid = false;
				$err_matrimonialstatut = "Veuillez renseigner ce champs !";
			}
			
			if(!isset($description)){
				$valid = false;
				$err_description = "Veuillez renseigner ce champs !";
			}
			
			if($valid){
				$date_inscription = date("Y-m-d h:m:s");
				
				$password = crypt($password, '$5$rounds=5000$usesomesillystri$KqJWlhgiuyfuTEZ543TSaYhEWsQ1Lr5QNyPCDH/Tp.6');
				
				$req = $BDD->prepare("INSERT INTO meeting_members (pseudo, mail, password, date_naissance, pays, nom_user, ville, matrimonialstatut, profession, telephone, civilite, recherche, description, date_inscr, date_conn) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					
				$req->execute(array($pseudo, $mail, $password, $date_naissance, $pays, $nom_user, $ville, $matrimonialstatut, $profession, $telephone, $civilite, $recherche, $description, $date_inscription, $date_inscription));
				
				header('Location: meeting_login.php');
				exit;
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
		<meta charset="UTF-8">
		
		<!-- Title -->
		<title>Meeting register</title>
		
		<!-- SEO Meta -->
		<meta name="description" content="Agence matrimoniale">
		<meta name="keywords" content="mariage, agence matrimoniale, couple mixte, amour">
		<meta name="author" content="Babouk">
		
		<!-- viewport scale -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">    
				
		<!-- Favicon and Apple Icons -->
		<link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico">
		<link rel="shortcut icon" href="assets/img/favicon/114x114.png">
		<link rel="apple-touch-icon-precomposed" href="assets/img/favicon/96x96.png">    
		
		<!-- Icon fonts -->
		<link rel="stylesheet" href="assets/fonts/fontawesome/css/all.css">
		<link rel="stylesheet" href="assets/fonts/themify-icons/css/themify-icons.css">    
		
		<!-- stylesheet -->    
		<link rel="stylesheet" href="assets/css/vendors.bundle.css">
		<link rel="stylesheet" href="assets/css/style.css">
    
  </head>
  
  	<?php include("InfoContacts-deconnexion.php");?>
	
<body>

	<?php include("menu.php"); ?>
			<section class="padding-y-100 bg-cover bg-center jarallax" data-dark-overlay="6" style="background: url(img/ambrosia5.jpg) no-repeat;">
			  <div class="container">
				<div class="row align-items-center">
				  <div class="col-lg-5 col-md-7 mr-auto text-white my-3">
					<h4 class="text-primary font-weight-semiBold">
					  Bienvenue sur le site de rencontre 
					</h4>
					<h2>
					  de l'agence matrimoniale Ambrosia Rose
					</h2>
				  </div>
				<div class="col-lg-4 col-md-5 my-3">  
				  <form method="POST" class="px-lg-4">
				  
					  <div class="input-group input-group--focus mb-3">
						<?php
							if(isset($err_civilite)){
								echo $$err_civilite;
							}	
						?>
					  <div class="input-group mb-3">
						<select class="form-control custom-select" name="civilite">
						  <option selected>Je suis </option>
							<option value="Femme">Femme</option>
							<option value="Homme">Homme</option>
						</select>
					  </div>
					 </div>
					 
					 <div class="input-group input-group--focus mb-3">
						<?php
							if(isset($err_recherche)){
								echo $$err_recherche;
							}	
						?>
					  <div class="input-group mb-3">
						<select class="form-control custom-select" name="recherche">
						  <option selected>Je recherche </option>
							<option value="femme">Une femme</option>
							<option value="homme">Un homme</option>
						</select>
					  </div>
					 </div>
					  
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
						  <input type="text" class="form-control" name="nom_user" placeholder="Votre nom" value="Nom">
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
						<label class="text-white">
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
					
					<div class="form-group">
						  <input type="text" class="form-control" name="description" placeholder="Parlez-nous de vous en quelques mots" value="<?php if(isset($description)){ echo $description;} ?>">
						  <small class="form-text text-muted">
							<?php
								if(isset($err_description)){
									echo $err_description;
								}	
							?>
						  </small>
					</div>
									  
					  <div class="my-4">
						<label class="ec-checkbox check-sm my-2 clearfix">
						  <input type="checkbox" name="checkbox">
						  <span class="ec-checkbox__control mt-1"></span>
						  <span class="ec-checkbox__lebel">
							<span class="text-white">En vous inscrivant, vous acceptez </span>
							<a href="page-terms-and-privacy-policy.html" class="text-primary">nos conditions d'utilisation</a>
							 <span class="text-white">et</span>
							<a href="page-terms-and-privacy-policy.html" class="text-primary">notre politique de confidentialité.</a>
						  </span>
						</label>
					  </div>
					  <button type="submit" name="meeting_register" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal__Default">S'inscrire maintenant</button>
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
					  <p class="my-5 text-center text-white">
						Vous avez dèjà un compte? <a href="meeting_login.php" class="text-primary">Se connecter</a>
					  </p>
					</form>	
					</div>
				</div> <!-- END row-->
			  </div> <!-- END container--> 
			</section>    
	 
<footer class="site-footer">
  <div class="footer-top bg-dark text-white-0_6 pt-5 paddingBottom-100">
    <div class="container"> 
      <div class="row">

        <div class="col-lg-4 col-md-6 mt-5">
         <img src="assets/img/Favicone_Ambrosia1.png" alt="Logo">
         <div class="margin-y-40">
           <p>
            Pour rencontrer celle ou celui qui partagera votre vie, faites appel à un service spécialisé, performant et reconnu.
          </p>
         </div>
          <ul class="list-inline"> 
            <li class="list-inline-item"><a class="iconbox bg-white-0_2 hover:primary" href="https://www.facebook.com/Ambrosia-ROSE-313463995494509/"><i class="ti-facebook"> </i></a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 mt-5">
          <h4 class="h5 text-white">Contactez-nous</h4>
          <div class="width-3rem bg-primary height-3 mt-3"></div>
          <ul class="list-unstyled marginTop-40">
            <li class="mb-3"><i class="ti-headphone mr-3"></i><a href="tel:+33616682767">+33616682767</a></li>
            <li class="mb-3"><i class="ti-email mr-3"></i><a href="mailto:boutique@ambrosia-rose.com">boutique@ambrosia-rose.com</a></li>
            <li class="mb-3">
             <div class="media">
              <i class="ti-location-pin mt-2 mr-3"></i>
              <div class="media-body">
                <span> 
				10 rue du Bignon, Grandchamp, 89120 Charny-Orée-de-Puisaye</span>
              </div>
             </div>
            </li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 mt-5">
          <h4 class="h5 text-white">Liens rapides</h4>
          <div class="width-3rem bg-primary height-3 mt-3"></div>
          <ul class="list-unstyled marginTop-40">
            <li class="mb-2"><a href="http://ambrosiarose.com/AdminLTE-master/pages/examples/welcome.php" target="_blank">Comment ça marche</a></li>
			<li class="mb-2"><a href="blog-list.php">Consulter tous les articles</a></li>
			<li class="mb-2"><a href="verification.php">Ajouter un article</a></li>
			<li class="mb-2"><a href="Presentation.php">Qui sommes-nous?</a></li>
			<li class="mb-2"><a href="Boutique.php">La Boutique</a></li>
			<li class="mb-2"><a href="deconnexion.php">Deconnexion</a></li>
          </ul>
        </div>
        
      </div> <!-- END row-->
    </div> <!-- END container-->
  </div> <!-- END footer-top-->

 
	<div class="footer-bottom bg-black-0_9 py-5 text-center">
		<div class="container">
		  <p class="text-white-0_5 mb-0">&copy; 2018 Ambrosia Rose. All rights reserved. Created by <a href="http://www.babouk.international/">Babouk</a></p>
		</div>
	 </div>  <!-- END footer-bottom-->
   </footer>
   
	<div class="scroll-top">
	  <i class="ti-angle-up"></i>
	</div>
     
    <script src="assets/js/vendors.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
  </body>
</html>