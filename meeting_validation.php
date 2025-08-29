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
	
	
	if(isset($_SESSION['id'])){
		$req = $BDD->prepare("SELECT m.*, p.nom_fr_fr
		FROM meeting_members m
		INNER JOIN pays p ON p.code = m.pays
		WHERE m.id <> ?
		");
			
		$req->execute(array($_SESSION['id']));
		
		
	}else{
		$afficher_membres = $BDD->prepare("SELECT m.*, p.nom_fr_fr
		FROM meeting_members m
		INNER JOIN pays p ON p.code = m.pays
		");
			
		$afficher_membres->execute();
	}	
	
	function age($date){
		$age = date('Y') - date('Y', strtotime($date));
		
		if(date('md') < date('md', strtotime($date))){
			return $age - 1;
		}
		return $age;
	}
?>

<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<meta name="mobile-web-app-capable" content="yes">
		<!-- viewport scale-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="assets/css/style_carroussel.css" />
		<!-- stylesheet-->    
		<link rel="stylesheet" href="../assets/css/vendors.bundle.css">
		<link rel="stylesheet" href="../assets/css/style.css">
		<!-- Icon fonts -->
		<link rel="stylesheet" href="../assets/fonts/fontawesome/css/all.css">
		<link rel="stylesheet" href="../assets/fonts/themify-icons/css/themify-icons.css">
	</head>
	
	<header class="site-header bg-dark text-white-0_5">        
		<div class="container">
		  <div class="row align-items-center justify-content-between mx-0">
			<ul class="list-inline d-none d-lg-block mb-0">
			  <li class="list-inline-item mr-3">
			   <div class="d-flex align-items-center">
				<i class="ti-email mr-2"></i>
				<a href="mailto:boutique@ambrosia-rose.com">contact@ambrosiarose.com</a>
			   </div>
			  </li>
			  <li class="list-inline-item mr-3">
			   <div class="d-flex align-items-center">
				<i class="ti-headphone mr-2"></i>
				<a href="tel:+33616682767">+33616682767</a>
			   </div>
			  </li>
			</ul>
			<ul class="list-inline mb-0">
			  <li class="list-inline-item mr-0 p-3 border-right border-left border-white-0_1">
				<a href="https://www.facebook.com/AmbrosiaMaVieOfficielle"><i class="ti-facebook"></i></a>
			  </li>
			  <li class="list-inline-item mr-0 p-3 border-right border-white-0_1">
				<a href="https://www.youtube.com/channel/UCeoZsTY4H5jDulqIF2MMtdg"><i class="ti-youtube"></i></a>
			  </li>
			  <li class="list-inline-item mr-0 p-3 border-right border-white-0_1">
				<a href="https://instagram.com/yannick.ambrosia?r=nametag"><i class="fab fa-instagram"></i></a>
			  </li>
			 </ul>
			 <ul class="list-inline mb-0">
				<li class="list-inline-item mr-0 p-md-3 p-2 border-right border-left border-white-0_1">
					<a href="https://ambrosiarose.com/index.php">Accueil</a>
				</li>	
				<li class="list-inline-item mr-0 p-md-3 p-2 border-right border-white-0_1">
					<a href="page-signup.php">Déconnexion</a>
				</li>
			</ul>
		  </div> <!-- END END row-->
		</div> <!-- END container-->
	</header><!-- END site header-->	
	  
	<body>
	
	<section class="padding-y-150">
	  <div class="container">
	   <div class="row">
		 <div class="col-lg-8 mx-auto text-center">
		   <h2><i class="fas fa-check-circle text-success mr-1"></i> Succès</h2>
		   <h4 class="my-4">Mise à jour réussie!</h4>
				<div class="btn-group dropup mr-2 mb-3">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					  Choisissez votre activité
					</button>
					<div class="dropdown-menu">
					  <a class="dropdown-item" href="meeting_editer_profil.php">
					   <span class="icon-inline">
						 <i class="ti-pencil pr-2"></i>
						 <span>Poursuivre la mise à jour du profil</span>
					   </span>
					  </a>
					  <a class="dropdown-item" href="#">
					   <span class="icon-inline">
						 <i class="ti-search pr-2"></i>
						 <span>Affiner ma recherche</span>
					   </span>
					  </a>
					  <a class="dropdown-item" href="#">
					   <span class="icon-inline">
						 <i class="ti-book pr-2"></i>
						 <span>Voir toutes les célibataires</span>
					   </span>
					  </a>
					  <a class="dropdown-item" href="#">
					   <span class="icon-inline">
						 <i class="ti-comment-alt pr-2"></i>
						 <span>Lire mes messages</span>
					   </span>
					  </a>
					   <a class="dropdown-item" href="#">
					   <span class="icon-inline">
						 <i class="ti-heart pr-2"></i>
						 <span>Elles ont visité mon profil</span>
					   </span>
					  </a>
					   <div class="dropdown-divider"></div>
					  <a class="dropdown-item" href="#">
					   <span class="icon-inline">
						 <i class="ti-thumb-up pr-2"></i>
						 <span>Découvrez nos formules</span>
					   </span>
					  </a>
					</div>
				</div>
		 </div>
	   </div> <!-- END row-->  
	  </div> <!-- END container-->
	</section>
	<footer class="site-footer">
		<div class="footer-bottom bg-black-0_9 py-5 text-center">
			<div class="container">
			  <p class="text-white-0_5 mb-0">&copy; 2018 Ambrosia Rose. All rights reserved. Created by <a href="http://www.babouk.international/">Babouk</a></p>
			</div>
		</div>
	</footer>		
	<script src="../assets/js/vendors.bundle.js"></script>
	<script src="../assets/js/scripts.js"></script>		
	<script src="assets/js/main_Carroussel.js"></script>	
	</body> 
	
</html>
	