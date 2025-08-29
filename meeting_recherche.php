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
		WHERE m.id <> ?");
			
		$req->execute(array($_SESSION['id']));		
		
	}else{
		$afficher_membres = $BDD->prepare("SELECT m.*, p.nom_fr_fr
		FROM meeting_members m
		INNER JOIN pays p ON p.code = m.pays");
			
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

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    
    <!-- Title-->
    <title>Affiner ma recherche</title>
    
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
	<?php include("InfoContacts.php"); ?> 
  <body>
    <?php include("meeting_menu.php"); ?> 
	<section class="pt-5">
	  <div class="container">
		<div class="row align-items-center">
		  <div class="col-md-6">
			<img src="img/img18.jpg" alt="">
		  </div>
		  <div class="col-md-6 mt-3">
			<h2>
			 <small class="text-primary d-block">
			   Affinez votre recherche
			 </small>
			  et trouvez l’amour auprès d’une personne qui vous correspond:
			</h2>
		<form action="" method="POST" enctype="multipart/form-data">
			<?php
					$afficher_membres = $req->fetch();
				?>
			<div class="col-md-6 mb-4">
				<small class="form-text text-muted">
					vous êtes: 
				</small>
				<input type="text" class="form-control" value = "<?= $afficher_membres['civilite'] ?>">
			</div>
			
			<div class="col-md-6 mb-4">
				<small class="form-text text-muted">
					vous recherchez:
				</small>
				<input type="text" class="form-control" value = "<?= $afficher_membres['recherche'] ?>">
			</div>

			<div class="btn-group dropup mr-2 mb-3">
				<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
				  Lancez la recherche de mon âme soeur
				</button>
				<div class="dropdown-menu">
				  <a class="dropdown-item" href="">
					<span class="icon-inline">
					 <i class="ti-search pr-2"></i>
						<span> à côté de chez moi</span>
					</span>
				  </a>
					<a class="dropdown-item" href="#">
					  <span class="icon-inline">
						<i class="ti-search pr-2"></i>
						<span>Partout dans le monde</span>
					  </span>
					</a>
				</div>
			</div>
				
			<h3><small class="text-primary d-block">Faites-vous accompagner dans votre démarche</small>Abonnez-vous:</h3>
			<h4 class="mb-3">
			  <span class="text-gray"><s>55,45€</s></span>
			  <span class="text-primary">25,00€</span> /mois
			  
			</h4>
			<img class="iconbox iconbox-lg mr-3" src="img/cassidy.png" alt="">
			<p><i class="fas fa-check-circle text-success mr-2"></i>Notre coach Cassidy vous attend</p>
			<div class="mb-2">
			  <h4>Principales caractéristiques</h4>
			  <ul class="list-unstyled list-style-icon list-icon-bullet mt-3">
				<li>L'analyse de votre situation</li>
				<li>Une étude approfondie et personnalisée de votre besoin</li>				
				<li>Une mise en relation sérieuse</li>
				<li>Un accompagnement tout au long de la démarche </li>
			  </ul>
			</div>
				
			<div class="d-md-flex">
			  <button class="btn btn-primary mb-2 mr-3">Abonnez-vous</button>
			</div>
			<ul class="list-inline my-3">
			  <li class="list-inline-item">Paiement:</li>
			  <li class="list-inline-item"><img src="assets/img/shop/payment/paypal.jpg" alt=""></li>
			</ul>			
		</form>	
		  </div>
		</div>
	  </div>
	</section>
   
  
  <script src="assets/js/vendors.bundle.js"></script>
  <script src="assets/js/scripts.js"></script>
  </body>
</html>