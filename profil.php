<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}
	
	$utilisateur_id = (int) $_SESSION['id'];
	
	if(empty($utilisateur_id)){
		header('Location: /index.php');
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
	
	function age($date){
		$age = date('Y') - date('Y', strtotime($date));
		
		if(date('md') < date('md', strtotime($date))){
			return $age - 1;
		}
		return $age;
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
	<?php include("menuSession.php");?>
		
		<section class="paddingTop-100">
		  <div class="container">
			<div class="row align-items-center">
			  <div class="col-md-6">
				<img src="img/user_photo/<?= $voir_utilisateur['photo'] ?>" alt="">
			  </div>
			  <div class="col-md-6 mt-5 mb-5 mb-md-0 pl-lg-5">

				<p class="lead font-weight-semiBold mb-4 position-relative">
				 <i class="ti-quote-left position-absolute display-1 opacity-01" data-offset-top="-50"></i>
				  <?= $voir_utilisateur['description'] ?>
				</p>
				<h6>
				  <span class="text-primary"><?= $voir_utilisateur['pseudo'] ?>, <?= age($voir_utilisateur['date_naissance']) ?> ans, </span> <?= $voir_utilisateur['nom_fr_fr'] ?>
				</h6>
				<a href="editer-profil.php" class="btn btn-primary btn-md mt-4">Modifier ma photo</a>
				<a href="editer.php" class="btn btn-primary btn-md mt-4">Modifier ma présentation</a>
			  </div>
			</div>
		  </div>
		</section>

<?php include("footer.php");?>

		<div class="scroll-top">
		  <i class="ti-angle-up"></i>
		</div>
     
    <script src="assets/js/vendors.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
  </body>
</html>