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
    <title>Page profil Ambrosia</title>
    
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
		
	<section class="padding-y-100 bg-cover bg-center jarallax" data-dark-overlay="7" style="background: url(img/groupe.jpg) no-repeat">
	  <div class="container">
		<div class="row">
		  <div class="col-lg-6 mx-auto text-center text-white">
			<h2 class="font-size-md-40 mb-4">
			  Bienvenue <span class="text-success"><?= $_SESSION['pseudo'] ?></span>
			</h2>
		  </div>
		</div> <!-- END row-->
	  </div> <!-- END container-->
	</section>
	
	<section class="bg-light-v2 paddingTop-80 paddingBottom-100">
	  <div class="container">
		<div class="row text-center">
		  <div class="col-md-6 col-lg-4 marginTop-30">
		   <a href="#" class="card shadow-v1 align-items-center p-5 hover:transformTop">
			 <img src="assets/img/svg/blog.png" alt="">
			 <h4 class="mt-2">
			   Le Forum
			 </h4>
		   </a>
		  </div>
		  <div class="col-md-6 col-lg-4 marginTop-30">
		   <a href="#" class="card shadow-v1 align-items-center p-5 hover:transformTop">
			 <img src="assets/img/svg/meet.png" alt="">
			 <h4 class="mt-2">
			   Le site de rencontre
			 </h4>
		   </a>
		  </div>
		  <div class="col-md-6 col-lg-4 marginTop-30">
		   <a href="#" class="card shadow-v1 align-items-center p-5 hover:transformTop">
			 <img src="assets/img/svg/news.png" alt="">
			 <h4 class="mt-2">
			   L'actualité
			 </h4>
		   </a>
		  </div>
		  <div class="col-md-6 col-lg-4 marginTop-30">
		   <a href="#" class="card shadow-v1 align-items-center p-5 hover:transformTop">
			 <img src="assets/img/svg/4.png" alt="">
			 <h4 class="mt-2">
			   News Room
			 </h4>
		   </a>
		  </div>
		  <div class="col-md-6 col-lg-4 marginTop-30">
		   <a href="#" class="card shadow-v1 align-items-center p-5 hover:transformTop">
			 <img src="assets/img/svg/5.png" alt="">
			 <h4 class="mt-2">
			   Events
			 </h4>
		   </a>
		  </div>
		  <div class="col-md-6 col-lg-4 marginTop-30">
		   <a href="#" class="card shadow-v1 align-items-center p-5 hover:transformTop">
			 <img src="assets/img/svg/6.png" alt="">
			 <h4 class="mt-2">
			   Book A Visit
			 </h4>
		   </a>
		  </div>
		</div> <!-- END row-->
	  </div> <!-- END container-->
	</section>   <!-- END section-->
	
	<?php include("footer.php");?>

	<div class="scroll-top">
	  <i class="ti-angle-up"></i>
	</div>
     
    <script src="assets/js/vendors.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
	
  </body>
</html>