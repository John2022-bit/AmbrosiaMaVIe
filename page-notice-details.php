<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    
    <!-- Title-->
    <title>Detail-Article</title>
    
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
	  <?php include("menu.php");?>
	<section class="paddingTop-50 paddingBottom-100 bg-light-v2">
	  <div class="container">
		<div class="row">
		  <div class="col-lg-9 mt-5">
	
	<?php 
		$connect = mysqli_connect("185.98.131.90", "ambro1039665_2d2wpr", "c5u94nh1nb", "ambro1039665_2d2wpr"); 
		 
		/* Vérification de la connexion */ 
		if (!$connect) { 
		   echo "Échec de la connexion : ".mysqli_connect_error($connect); 
		   exit(); 
		} 
		 
		if ($_FILES['photo']['error']) {  
		   switch ($_FILES['photo']['error']){  
				 case 1: // UPLOAD_ERR_INI_SIZE  
					echo "La taille du fichier est plus grande que la limite autorisée par le serveur (paramètre upload_max_filesize du fichier php.ini).";  
					break;  
				 case 2: // UPLOAD_ERR_FORM_SIZE  
					echo "La taille du fichier est plus grande que la limite autorisée par le formulaire (paramètre post_max_size du fichier php.ini)."; 
					break;  
				 case 3: // UPLOAD_ERR_PARTIAL  
					echo "L'envoi du fichier a été interrompu pendant le transfert."; 
			
					break;  
				 case 4: // UPLOAD_ERR_NO_FILE  
				   echo "La taille du fichier que vous avez envoyé est nulle."; 
					break;  
			  }  
		}  
		else {  
		//s'il n'y a pas d'erreur alors $_FILES['nom_du_fichier']['error'] 
		//vaut 0  
		   echo "Aucune erreur dans le transfert du fichier.<br />"; 
		   if ((isset($_FILES['photo']['name'])&&($_FILES['photo']['error'] == UPLOAD_ERR_OK))) { 
			  $chemin_destination = 'photos/'; 
			  //déplacement du fichier du répertoire temporaire (stocké 
			  //par défaut) dans le répertoire de destination 
			  move_uploaded_file($_FILES['photo']['tmp_name'], $chemin_destination.$_FILES['photo']['name']); 
			  echo "Le fichier ".$_FILES['photo']['name']." a été copié dans le répertoire photos"; 
		   } 
		   else { 
			  echo "Le fichier n'a pas pu être copié dans le répertoire photos."; 
		   } 
		} 
		 
		$requete = "INSERT INTO Article (Titre, Date, Commentaire, Photo) VALUES ('".htmlentities(addslashes($_POST['titre']), ENT_QUOTES)."','".date("Y-m-d H:i:s")."','".htmlentities (addslashes($_POST['commentaire']), ENT_QUOTES)."', '".$_FILES['photo']['name']."')"; 
		$resultat = mysqli_query($connect,$requete); 
		$identifiant = mysqli_insert_id($connect); 
		/* Fermeture de la connexion */ 
		mysqli_close($connect); 
		 
		if ($identifiant != 0) { 
		   echo "<br />Ajout du commentaire réussi.<br /><br />"; 
		} 
		else { 
		   echo "<br />Le commentaire n'a pas pu être ajouté.<br /><br />"; 
		} 
		?> 
				</div>
				<a href="formulaireAjout.php" class="btn btn-primary mt-4">Retour à la page d'ajout d'articles</a>
			</div>
		</div>
	</section>
    
		<?php include("footer.php"); ?>

		<div class="scroll-top">
		  <i class="ti-angle-up"></i>
		</div>
			 
			<script src="assets/js/vendors.bundle.js"></script>
			<script src="assets/js/scripts.js"></script>
		  </body>
		</html>