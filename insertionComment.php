<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}
?>	
<!DOCTYPE html> 
<html lang="fr"> 
	   <head> 
		  <title>Insertion Comment</title> 
		  <meta http-equiv="Content-Type" content="text/html; 
	charset=utf-8" /> 
	   </head> 
	<body> 

		<?php 
		$connect = mysqli_connect("localhost", "cp1088772p18_ambrosiarose", "Champagne-1977", "cp1088772p18_ambrosiarose"); 
		 
		/* Vérification de la connexion */ 
		if (!$connect) { 
		   echo "Échec de la connexion : ".mysqli_connect_error($connect); 
		   exit(); 
		} 
		 
		 
		$requete = "INSERT INTO Article (Titre, Date, Commentaire, Photo, photo1) VALUES ('".htmlentities(addslashes($_POST['titre']), ENT_QUOTES)."','".date("Y-m-d H:i:s")."','".htmlentities (addslashes($_POST['commentaire']), ENT_QUOTES)."', '".$_FILES['photo']['name']."', '".$_FILES['photo']['name']."')"; 
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
		<a href="verification.php" >retour à la page d'ajout d'articles</a> 
	</body> 
</html>