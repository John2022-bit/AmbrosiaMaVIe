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
		$req = $BDD->prepare("SELECT u.*, p.nom_fr_fr
		FROM utilisateur u
		INNER JOIN pays p ON p.code = u.pays
		WHERE u.id <> ?
		LIMIT 0, 10");
			
		$req->execute(array($_SESSION['id']));
		
		
	}else{
		$afficher_membres = $BDD->prepare("SELECT u.*, p.nom_fr_fr
		FROM utilisateur u
		INNER JOIN pays p ON p.code = u.pays
		LIMIT 0, 10");
			
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
	
		<section class="padding-y-100 bg-light-v5"> 
		  <div class="container">
			<div class="row">
			 <div class="col-12 text-center mb-5">
				<h2 class="mb-4">
				  Trouvez l'âme soeur
				</h2>
				<div class="width-3rem height-4 rounded bg-primary mx-auto"></div>
			  </div>
			  
			  <div class="col-12">
				<div class="d-md-flex justify-content-between bg-white rounded shadow-v1 p-4">
				  <ul class="nav nav-pills nav-isotop-filter align-items-center my-2">
					<a class="nav-link active" href="#" data-filter="*">Tous les membres</a>
					<a class="nav-link" href="#" data-filter=".Femme"> Ambrosiennes</a>
					<a class="nav-link" href="#" data-filter=".Homme"> Ambrosiens</a>
				  </ul>

				</div>
			  </div> 
			</div> <!-- END row-->
			
			<div class="row isotop-filter">
				<?php
					while($afficher_membres = $req->fetch()){
				?>
			  <div class="isotope-item col-md-6 col-lg-4 marginTop-30 <?= $afficher_membres['civilite'] ?>">
			   <div class="card hover:parent shadow-v1">
				  <img class="card-img-top" src="img/user_photo/<?= $afficher_membres['photo'] ?>" alt="" width="360" height="300">
				  <div class="card-body">
					<h4>
					  <?= $afficher_membres['pseudo'] ?>
					</h4>
					<p class="text-gray">
					  <?= age($afficher_membres['date_naissance']) ?> ans, <?= $afficher_membres['nom_fr_fr'] ?>
					</p>
				  </div>
				  <div class="d-flex justify-content-between align-items-center border-top position-relative p-4">
					<a href="voir-profil.php?id=<?= $afficher_membres['id'] ?>" class="membre-btn-voir">Voir le profil</a>
				  </div>
				</div>
			  </div>
		 	  <?php
			  }
			  ?>		
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