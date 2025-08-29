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
		
		if(isset($_POST['connex'])){
			$mail = (String) strtolower(trim($mail));
			$password = (String) trim($password);
			
			if(empty($mail)){
				$valid = false;
				$err_mail = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM meeting_members 
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
					FROM meeting_members
					WHERE mail = ? AND password = ?");
					
			$req->execute(array($mail, crypt($password, '$5$rounds=5000$usesomesillystri$KqJWlhgiuyfuTEZ543TSaYhEWsQ1Lr5QNyPCDH/Tp.6')));
			$verif_utilisateur = $req->fetch();
				
			if(!isset($verif_utilisateur['id'])){
				$valid = false;
				$err_mail = "Veuillez renseigner ce champs !";
			}
			
			if($valid){
				
				$req = $BDD->prepare("INSERT INTO meeting_members (date_conn) VALUES (?)");
				$req->execute(array(date("Y-m-d h:m:s")));
				
				
				$req = $BDD->prepare("SELECT *
					FROM meeting_members 
					WHERE id = ?");
					
				$req->execute(array($verif_utilisateur['id']));
				$verif_utilisateur = $req->fetch();
				
				$_SESSION['id'] = $verif_utilisateur['id'];
				$_SESSION['pseudo'] = $verif_utilisateur['pseudo'];
				$_SESSION['mail'] = $verif_utilisateur['mail'];
				
				if($verif_utilisateur['recherche'] == "femme"){
				header('Location: https://ambrosiarose.com/meeting_femm.php');
				die();
				}
				else
				if($verif_utilisateur['recherche'] == "homme"){
				header('Location: https://ambrosiarose.com/meeting_homm.php');
				die();
				}
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
    <title>Meeting login</title>
    
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
    
    <!-- Icon fonts -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/fonts/themify-icons/css/themify-icons.css">    
    
    <!-- stylesheet-->    
    <link rel="stylesheet" href="assets/css/vendors.bundle.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
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
					<a href="index.php">Accueil</a>
				</li>	
				<li class="list-inline-item mr-0 p-md-3 p-2 border-right border-left border-white-0_1">
					<a href="connexion.php">Mon compte</a>
				</li>
				<li class="list-inline-item mr-0 p-md-3 p-2 border-right border-white-0_1">
					<a href="page-signup.php">s'inscrire</a>
				</li>
			</ul>
		  </div> <!-- END END row-->
		</div> <!-- END container-->
	  </header><!-- END site header-->
  
<body>

<nav class="ec-nav sticky-top bg-white">
  <div class="container">
    <div class="navbar p-0 navbar-expand-lg">
      <div class="navbar-brand">
        <a class="logo-default" href="index.php"><img alt="" src="assets/img/Logo_Ambr.png"></a>
      </div>
      <span aria-expanded="false" class="navbar-toggler ml-auto collapsed" data-target="#ec-nav__collapsible" data-toggle="collapse">
        <div class="hamburger hamburger--spin js-hamburger">
          <div class="hamburger-box">
            <div class="hamburger-inner"></div>
          </div>
        </div>
      </span>
      <div class="collapse navbar-collapse when-collapsed" id="ec-nav__collapsible">
        <ul class="nav navbar-nav ec-nav__navbar ml-auto">
		
			<li class="nav-item nav-item__has-dropdown">
                <a class="nav-link" href="Presentation.php">Qui sommes-nous?</a>
            </li>
			
			<li class="nav-item nav-item__has-dropdown">
                <a class="nav-link" href="how.php">Comment ça marche</a>
			</li>
			
			<li class="nav-item nav-item__has-dropdown">
                <a class="nav-link" href="Services.php">Services</a>
            </li>

            <li class="nav-item nav-item__has-dropdown">
                <a class="nav-link" href="Temoignages_Videos_Ambrosia.php">Témoignages</a>
            </li>
			
			<li class="nav-item nav-item__has-dropdown">
                <a class="nav-link" href="https://forum.ambrosiarose.com">forum</a>
            </li>
			
			<li class="nav-item nav-item__has-dropdown">
                <a class="nav-link" href="blog-list.php">Le Blog</a>
					<ul class="dropdown-menu">
					  <li><a href="blog-list.php" class="nav-link__list">Tous les articles</a></li>
					  <li><a href="verification.php" class="nav-link__list">Ajouter un article</a></li>
					</ul>
			</li>
			
			<li class="nav-item nav-item__has-dropdown">
                <a class="nav-link" href="blog-list.php">TVSat Ambrosia</a>
					<ul class="dropdown-menu">
					  <li><a href="" class="nav-link__list">Toutes les vidéos</a></li>
					  <li><a href="verification_video.php" class="nav-link__list">Ajouter une vidéo</a></li>
					</ul>
			</li>
<!--			
			<li class="nav-item nav-item__has-dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Nos formules</a>
                <ul class="dropdown-menu">
                  <li><a href="Details-Formule-Basic.html" class="nav-link__list">Basic</a></li>
				  <li><a href="Details-Formule-Standard.html" class="nav-link__list">Standard</a></li>
				  <li><a href="Details-Formule-Premium.html" class="nav-link__list">Premium</a></li>
				  <li><a href="Ambrosia-pricing.html" class="nav-link__list">Les Tarifs</a></li>
				  <li><a href="Ambrosia-pricing -Inscription-Pack.html" class="nav-link__list">S'inscrire</a></li>
                </ul>
            </li>
			
			<li class="nav-item nav-item__has-dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Evénements</a>
                <ul class="dropdown-menu">
                  <li><a href="page-events.html" class="nav-link__list">Consultez le programme</a></li>
				  <li><a href="Archives-Evenements.html" class="nav-link__list">Revoir nos événements</a></li>
                </ul>
            </li>
-->						
			
  </div> <!-- END container-->		
  </nav> <!-- END ec-nav -->     
    
<section class="padding-y-100 bg-cover bg-center jarallax" data-dark-overlay="6" style="background: url(img/ambrosia3.png) no-repeat;">
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
          <h4 class="text-white">
            Se connecter
          </h4>
          <p class="mb-4 text-white">
            Trouvez votre âme soeur
          </p>
         <div class="input-group input-group--focus mb-3">
			
            <div class="input-group-prepend">
              <span class="input-group-text bg-white ti-email"></span>
            </div>
            <input type="email" name="mail" class="form-control border-left-0 pl-0" placeholder="Email" value="<?php if(isset($mail)){ echo $mail;} ?>">
			<?php
				if(isset($err_mail)){
					echo $err_mail;
				}	
			?>
          </div>
         <div class="input-group input-group--focus mb-3">
			
            <div class="input-group-prepend">
              <span class="input-group-text bg-white ti-lock"></span>
            </div>
            <input type="password" name="password" class="form-control border-left-0 pl-0" placeholder="Mot de passe" value="<?php if(isset($password)){ echo $password;} ?>">
			<?php
				if(isset($err_password)){
					echo $err_password;
				}	
			?>
		 </div>
          <button name="connex" class="btn btn-block btn-secondary">Allez-y</button>
			<p class="my-5 text-center text-white">
				Vous n'avez pas de compte? <a href="meeting_register.php" class="text-primary">Inscrivez-vous</a>
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