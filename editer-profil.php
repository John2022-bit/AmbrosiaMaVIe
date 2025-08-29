<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}
	
	$utilisateur_id = (int) $_SESSION['id'];
	
	if(empty($utilisateur_id)){
		header('Location: /membres.php');
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
	
	if(!empty($_POST)){
		extract($_POST);
		$valid = (boolean) true;
		
		if(isset($_POST['modifier'])){
			$photo = (String) trim($photo);
			
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
						  $chemin_destination = 'img/user_photo/'; 
						  //déplacement du fichier du répertoire temporaire (stocké 
						  //par défaut) dans le répertoire de destination 
						  move_uploaded_file($_FILES['photo']['tmp_name'], $chemin_destination.$_FILES['photo']['name']); 
						  echo "Le fichier ".$_FILES['photo']['name']." a été copié dans le répertoire photos"; 
					   } 
					   else { 
						  echo "Le fichier n'a pas pu être copié dans le répertoire photos."; 
					   } 
					}
			
			if($valid){
								
				$req = $BDD->prepare("UPDATE utilisateur SET pseudo = ?, nom_user = ?, photo = ? WHERE id = ?");
					
				$req->execute(array($pseudo,$nom, $_FILES['photo']['name'], $_SESSION['id']));
				
				header('Location: /profil.php');
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
	<?php include("InfoContacts-deconnexion.php");?> 
  <body>
	<?php include("menuSession.php"); ?>
		
   <section class="paddingTop-50 paddingBottom-120 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mt-6">
          <div class="card shadow-v1 padding-30">
            <ul class="nav tab-line tab-line border-bottom mb-4" role="tablist">
             <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#Tabs_1-1" role="tab" aria-selected="true">
                Photo de profil
              </a>
             </li>
           </ul>
           
            <div class="tab-content"> 
			
              <div class="tab-pane fade show active" id="Tabs_1-1" role="tabpanel">                
				<form action="" method="POST" enctype="multipart/form-data">				 
				 <div class="border-bottom mb-4 pb-4">
                   <h4>
                     Télécharger une photo de profil
                   </h4>
                   <div class="media align-items-end mt-4">
                     <div class="media-body ml-4 mb-4 mb-md-0">
                       <p>
                         JPG or PNG 
                       </p>
                       <p>Choisissez une photo avec une taille inférieure à 2 Mo.</p>
						 <input type="file" name="photo">
						 <button class="btn btn-primary" type="submit" name="modifier">Envoyez</button>
                     </div>
                   </div>
                 </div>
				</form>                           
			  </div> <!-- END tab-pane -->
			</div> <!-- END tab-content-->
          </div> <!-- END card-->
        </div> <!-- END col-md-8 -->
      </div> <!--END row-->
    </div> <!--END container-->
  </section>
   	
		<?php include("footer.php");?>

		<div class="scroll-top">
		  <i class="ti-angle-up"></i>
		</div>
     
    <script src="assets/js/vendors.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
  </body>
</html>