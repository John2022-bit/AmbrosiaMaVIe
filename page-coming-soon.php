<?php
	include_once('db/connexiondb.php');	

	if(!empty($_POST)){
		extract($_POST);
		$valid = (boolean) true;
		
		if(isset($_POST['news'])){
			$nom = (String) trim($nom);
			$email = (String) strtolower(trim($email));
			$pays = (String) trim($pays);
			$ville = (String) trim($ville);
			
			if(empty($nom)){
				$valid = false;
				$err_nom = "Veuillez renseigner ce champs !";
			}
			
			if(empty($email)){
				$valid = false;
				$err_email = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM newsletter 
					WHERE email = ?");
					
				$req->execute(array($email));
				$utilisateur = $req->fetch();
				
				if(isset($utilisateur['id'])){
					$valid = false;
					$err_email = "Ce mail existe déjà";
				}
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
				
				if(empty($ville)){
				$valid = false;
				$err_ville = "Veuillez renseigner ce champs !";
				}
			
				if($valid){
				$date_inscription = date("Y-m-d h:m:s");
				
				$req = $BDD->prepare("INSERT INTO newsletter (nom, email, pays, ville, date_inscr) 
					VALUES (?, ?, ?, ?, ?)");
					
				$req->execute(array($nom, $email, $pays, $ville, $date_inscription));
				
				header('Location: index.php');
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
    <title>Prochain évènement</title>
    
		<!-- SEO Meta-->
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
  
  <body>
   
   
  <section class="bg-white">
    <div class="container-fluid px-0">
      <div class="row no-gutters height-100vh">
        <div class="col-lg-8 bg-cover" data-dark-overlay="6" style="background:url(img/Ambrosia.jpg) no-repeat">
        
         <div class="row align-items-center height-100p py-4">
           <div class="col-lg-7 mx-auto">
           <div class="card-deck text-center" data-countdown="2019/01/01">
            <div class="card p-4">
              <h2 class="countdown-days display-4"></h2>
              <span>Jours</span>
            </div>
            <div class="card p-4">
              <h2 class="countdown-hours display-4"></h2>
              <span>Heures</span>
            </div>
            <div class="card p-4">
              <h2 class="countdown-minutes display-4"></h2>
              <span>Minutes</span>
            </div>
            <div class="card p-4">
              <h2 class="countdown-seconds display-4"></h2>
              <span>Secondes</span>
            </div>
          </div>
           </div>
         </div>
               
        </div>
        
        <div class="col-lg-4">
        <div class="d-flex height-100p align-items-center">
          <div class="p-5 mx-auto" style="max-width: 500px;">
            <h3>Prévenez-moi!</h3> 
            <p class="my-3">
              Tous nos ateliers sont suspendus en raisons de la crise sanitaire de la covid 19.  
            </p>
			<p class="my-3">
              Donnez votre adresse e-mail et nous vous informerons des offres intéressantes. 
            </p>
            <form method="POST">
              <div class="form-group">
                <input type="text" name="nom" class="form-control" placeholder="Nom" required>
				<?php
					if(isset($err_nom)){
					echo $err_nom;
					}	
				?>
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
				<?php if(isset($err_mail)){
					echo $err_mail;
					}
				?>				
              </div>
			  <div class="form-group">
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
                <input type="text" name="ville" class="form-control" placeholder="Ville de résidence" required>
				<?php
					if(isset($err_ville)){
					echo $err_ville;
					}	
				?>
              </div>
              <button class="btn btn-primary" name="news">Prévenez-moi!</button>
            </form>
         </div>
        </div>
        </div>
      </div>
    </div>
  </section> 
   
  
  <script src="assets/js/vendors.bundle.js"></script>
  <script src="assets/js/scripts.js"></script>
  </body>
</html>