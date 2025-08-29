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
		
		if(isset($_POST['connexion'])){
			$mail = (String) strtolower(trim($mail));
			$password = (String) trim($password);
			
			if(empty($mail)){
				$valid = false;
				$err_mail = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE mail = ?");
					
				$req->execute(array($mail));
				$utilisateur = $req->fetch();
				
				if(!isset($utilisateur['id'])){
					$valid = false;
					$err_mail = "Veuillez renseigner ce champs !";
				}
			}
			
			if(empty($password)){
				$valid = false;
				$err_password = "Veuillez renseigner ce champs !";
			}
			
			$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE mail = ? AND password = ?");
					
			$req->execute(array($mail, crypt($password, '$5$rounds=5000$usesomesillystri$KqJWlhgiuyfuTEZ543TSaYhEWsQ1Lr5QNyPCDH/Tp.6')));
			$verif_utilisateur = $req->fetch();
				
			if(!isset($verif_utilisateur['id'])){
				$valid = false;
				$err_mail = "Veuillez renseigner ce champs !";
			}
			
			if($valid){
				
				$req = $BDD->prepare("INSERT INTO utilisateur (date_connexion) VALUES (?)");
				$req->execute(array(date("Y-m-d h:m:s")));
				
				
				$req = $BDD->prepare("SELECT *
					FROM utilisateur 
					WHERE id = ?");
					
				$req->execute(array($verif_utilisateur['id']));
				$verif_utilisateur = $req->fetch();
				
				$_SESSION['id'] = $verif_utilisateur['id'];
				$_SESSION['pseudo'] = $verif_utilisateur['pseudo'];
				$_SESSION['mail'] = $verif_utilisateur['mail'];
				
				header('Location: page-profile.php');
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
  <?php include("InfoContacts.php");?>
	<body>
	
		<section class="height-90vh padding-y-80 flex-center bg-center bg-cover" data-dark-overlay="5" style="background:url(img/ambrosia2.png)" no-repeat>
		  <div class="container">
			<div class="row">
			  <div class="col-lg-6 mx-auto">
				<div class="card shadow-v2"> 
				 <div class="card-header border-bottom">
				  <h4 class="mt-4">
					Connectez-vous à Ambrosia Rose !
				  </h4>
				 </div>         
				  <div class="card-body">
					<form action="#" method="POST" class="px-lg-4">
					
					  <div class="input-group input-group--focus mb-3">
					    <?php
						if(isset($err_mail)){
							echo $err_mail;
						}	
						?>
						<div class="input-group-prepend">
						  <span class="input-group-text bg-white ti-email"></span>
						</div>
						<input type="text" name="mail" class="form-control border-left-0 pl-0" placeholder="Email" value="<?php if(isset($mail)){ echo $mail;} ?>">
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
						<input type="password" name="password" class="form-control border-left-0 pl-0" placeholder="Mot de passe" value="<?php if(isset($password)){ echo $password;} ?>">
					  </div>
					  
					  <div class="d-md-flex justify-content-between my-4">
						<label class="ec-checkbox check-sm my-2 clearfix">
						  <input type="checkbox" name="checkbox">
						  <span class="ec-checkbox__control"></span>
						  <span class="ec-checkbox__lebel">Remember Me</span>
						</label>
					  </div>
					  <button name="connexion" class="btn btn-block btn-primary">Connectez-vous</button>
					  <p class="my-5 text-center">
						Vous n'avez pas de compte? <a href="page-signup.php" class="text-primary">Inscrivez-vous</a>
					  </p>
					</form>
				  </div>
				</div>
			  </div> 
			</div> <!-- END row-->
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