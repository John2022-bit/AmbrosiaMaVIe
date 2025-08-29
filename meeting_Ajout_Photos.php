<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}
	
	if(!empty($_POST)){
		extract($_POST);
		$valid = (boolean) true;
		
		if(isset($_POST['photos'])){
			$photo1 = (String) trim($photo1);
			$photo2 = (String) trim($photo2);
			$photo3 = (String) trim($photo3);
			$photo4 = (String) trim($photo4);
			
		 foreach($_FILES as $file){
			 
			if ($file['error']) {  
					   switch ($file['error']){  
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
					   if ((isset($file['name'])&&($file['error'] == UPLOAD_ERR_OK))) { 
						  $chemin_destination = 'img/meeting_photos/'; 
						  //déplacement du fichier du répertoire temporaire (stocké 
						  //par défaut) dans le répertoire de destination 
						  move_uploaded_file($file['tmp_name'], $chemin_destination.$file['name']); 
						  echo "Le fichier ".$file['name']." a été copié dans le répertoire photos"; 
					   } 
					   else { 
						  echo "Le fichier n'a pas pu être copié dans le répertoire photos."; 
					   } 
					} 
		 }	
			
		
			
			if($valid){
								
				$req = $BDD->prepare("UPDATE meeting_members SET photo1 = ?, photo2 = ?, photo3 = ?, photo4 = ? WHERE id = ?");
					
				$req->execute(array($_FILES['photo1']['name'], $_FILES['photo2']['name'], $_FILES['photo3']['name'], $_FILES['photo4']['name'], $_SESSION['id']));
				
				header('Location: /meeting_validation.php');
				exit;
			}
		}
	} 
	
		
?>