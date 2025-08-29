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
		
		if(isset($_POST['update'])){
			$taille = (String) trim($taille);
			$yeux = (String) trim($yeux);
			$cheveux = (String) trim($cheveux);
			$fume = (String) trim($fume);
			$sport = (String) trim($sport);
			$religion = (String) trim($religion);
			$animal = (String) trim($animal);
			$qualite = (String) trim($qualite);
			$defaut = (String) trim($defaut);
						
			if($valid){
								
				$req = $BDD->prepare("UPDATE meeting_members SET taille = ?, yeux = ?, cheveux = ?, fume = ?, sport = ?, religion = ?, animal = ?, qualite = ?, defaut = ? WHERE id = ?");
					
				$req->execute(array($taille, $yeux, $cheveux, $fume, $sport, $religion, $animal, $qualite, $defaut, $_SESSION['id']));
				
				header('Location: /meeting_validation.php');
				exit;
			}
		}
	} 
	
		
?>