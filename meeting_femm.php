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
		<link rel="stylesheet" href="assets/css/vendors.bundle.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<!-- Icon fonts -->
		<link rel="stylesheet" href="assets/fonts/fontawesome/css/all.css">
		<link rel="stylesheet" href="assets/fonts/themify-icons/css/themify-icons.css">
		<!-- Caroussel -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.1.0/velocity.min.js">
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
	<section class="padding-y-100 bg-cover bg-center jarallax" data-dark-overlay="6" style="background: url(img/ambrosia6.jpg) no-repeat;">
		  <div class="container">
			<div class="row align-items-center">
			  <div class="col-lg-5 mr-auto text-white my-3">
				<h2 class="line-height-normal">
				  Hi <span class="text-primary"><?= $_SESSION['pseudo'] ?></span> !<br>
				  Envie de rencontrer des célibataires?
				</h2>
				<div class="btn-group dropup mr-2 mb-3">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					  Choisissez votre activité
					</button>
					<div class="dropdown-menu">
					  <a class="dropdown-item" href="meeting_editer_profil.php">
					   <span class="icon-inline">
						 <i class="ti-pencil pr-2"></i>
						 <span>Editer mon profil</span>
					   </span>
					  </a>
					  <a class="dropdown-item" href="meeting_recherche.php">
					   <span class="icon-inline">
						 <i class="ti-search pr-2"></i>
						 <span>Affiner ma recherche</span>
					   </span>
					  </a>
					  <a class="dropdown-item" href="Site_de_rencontre/BBK_carrossel_femm.php">
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
			  <div class="col-lg-6 col-md-5 my-3">
				<div class="owl-carousel dots-white-outline" 
				 data-dots="true"
				 data-smartspeed="300"
				 data-items-tablet="3"
				 data-items-mobile="2"
				 data-space="15"
				 >
				  <div class="card height-6rem justify-content-center p-4">
					<img src="img/avatar/fdl1.png" alt="">
				  </div>
				  <div class="card height-6rem justify-content-center p-4">
					<img src="img/avatar/fdl4.jpg" alt="">
				  </div>
				  <div class="card height-6rem justify-content-center p-4">
					<img src="img/avatar/fdl7.jpg" alt="">
				  </div>
				  <div class="card height-6rem justify-content-center p-4">
					<img src="img/avatar/fdl8.jpg" alt="">
				  </div>
				  <div class="card height-6rem justify-content-center p-4">
					<img src="img/avatar/fdl15.jpg" alt="">
				  </div>
				  <div class="card height-6rem justify-content-center p-4">
					<img src="img/avatar/ph01.png" alt="">
				  </div>
				</div>
			  </div>
			</div> <!-- END row-->
		  </div> <!-- END container--> 
	</section>
	<section class="py-5">
	  <div class="container">
		<div class="row">
		  <div class="col-lg-5 mr-auto mt-4">
			<div class="border border-light p-5">
			  <img class="w-100" src="assets/img/shop/products/1_1.jpg" alt="">
			</div>
		  </div>
		  <div class="col-lg-6 mt-4">
			<h2>The Self-Taought Programmer</h2>
			<p>by <a href="#" class="text-dark">Cory Althoff</a></p>
			<ul class="list-inline">
			  <li class="list-inline-item pr-3 border-right">
				<ul class="list-unstyled ec-review-rating font-size-12">
				  <li class="active"><i class="fas fa-star"></i></li>
				  <li class="active"><i class="fas fa-star"></i></li>
				  <li class="active"><i class="fas fa-star"></i></li>
				  <li class="active"><i class="fas fa-star"></i></li>
				  <li class="active"><i class="fas fa-star"></i></li>
				</ul>
			  </li>
			  <li class="list-inline-item">3 customer reviews</li>
			</ul>
			<h4 class="mb-3">
			  <span class="text-primary">$65.28</span>
			  <span class="text-gray"><s>$99.45</s></span>
			</h4>
			<p><i class="fas fa-check-circle text-success mr-2"></i>Available on stock</p>
			<div class="mb-2">
			  <h4>Key Features</h4>
			  <ul class="list-unstyled list-style-icon list-icon-bullet mt-3">
				<li>The dos and don'ts of storing passwords in a database</li>
				<li>Exchange Rates and the Currency Conversion Tool</li>
				<li>Building a Web Messenger with Microservices</li>
				<li>Extending TempMessenger with a User Authentication Microservice</li>
			  </ul>
			</div>
			
			<div class="d-md-flex">
			  <div class="input-group ec-touchspin mb-2 mr-3 width-10rem">
				<div class="ec-touchspin__minus input-group-prepend">
				  <span class="input-group-text ti ti-minus bg-white"></span>
				</div>
				<input class="ec-touchspin__result form-control bg-white text-center" type="text" value="1">
				<div class="input-group-append">
				  <span class="ec-touchspin__plus input-group-text ti-plus bg-white"></span>
				</div>
			  </div>
			  <button class="btn btn-primary mb-2 mr-3">Buy Now</button>
			  <button class="btn btn-outline-primary btn-icon mb-2 mr-3"><i class="ti-shopping-cart mr-2"></i> Add to card</button>
			</div>
			<ul class="list-inline my-3">
			  <li class="list-inline-item">Payment:</li>
			  <li class="list-inline-item"><img src="assets/img/shop/payment/paypal.jpg" alt=""></li>
			  <li class="list-inline-item"><img src="assets/img/shop/payment/mastro.jpg" alt=""></li>
			  <li class="list-inline-item"><img src="assets/img/shop/payment/mastercard.jpg" alt=""></li>
			  <li class="list-inline-item"><img src="assets/img/shop/payment/visa.jpg" alt=""></li>
			  <li class="list-inline-item"><img src="assets/img/shop/payment/ae.jpg" alt=""></li>
			</ul>
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
	<script src="assets/js/vendors.bundle.js"></script>
	<script src="assets/js/scripts.js"></script>		
	<script src="assets/js/main_Carroussel.js"></script>
		
	</body> 
	
</html>
	