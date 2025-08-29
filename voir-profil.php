<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	$utilisateur_id = (int) trim($_GET['id']);
	
	if(empty($utilisateur_id)){
		header('Location: /page-profile.php');
		exit;	
	}
	
	if(isset($_SESSION['id'])){
	
		$req = $BDD->prepare("SELECT u.*, p.nom_fr_fr, r.id_demandeur, r.id_receveur, r.statut, r.id_bloqueur
			FROM utilisateur u
			INNER JOIN pays p ON p.code = u.pays
			LEFT JOIN relation r ON (id_receveur = u.id AND id_demandeur = :id2) OR (id_receveur = :id2 AND id_demandeur = u.id) 
			WHERE u.id = :id1");
			
		$req->execute(array('id1' => $utilisateur_id, 'id2' => $_SESSION['id']));
		
	}else{
		$req = $BDD->prepare("SELECT u.*, p.nom_fr_fr
			FROM utilisateur u
			INNER JOIN pays p ON p.code = u.pays
			WHERE u.id = :id1");
			
		$req->execute(array('id1' => $utilisateur_id));
	}
		
	$voir_utilisateur = $req->fetch();
	
	if(!isset($voir_utilisateur['id'])){
		header('Location: /page-profile.php');
		exit;	
	}
	
	function age($date){
		$age = date('Y') - date('Y', strtotime($date));
		
		if(date('md') < date('md', strtotime($date))){
			return $age - 1;
		}
		return $age;
	}
	if(!empty($_POST)){
		extract($_POST);
		$valid = (boolean) true;
		
		if(isset($_POST['user-ajouter'])){
			$req = $BDD->prepare("SELECT id
				FROM relation
				WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)");
			$req->execute(array($voir_utilisateur['id'], $_SESSION['id'], $_SESSION['id'], $voir_utilisateur['id']));
			
			$verif_relation = $req->fetch();
						
			if(isset($verif_relation['id'])){
				$valid = false;
			}
			
			if($valid){
								
				$req = $BDD->prepare("INSERT INTO relation (id_demandeur, id_receveur, statut) VALUES (?, ?, ?)");
					
				$req->execute(array($_SESSION['id'], $voir_utilisateur['id'], 1));
			}
			
			header('Location: /voir-profil.php?id=' . $voir_utilisateur['id']);
			exit;
			
		}elseif(isset($_POST['user-supprimer'])){
			$req = $BDD->prepare("DELETE FROM relation WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)");
			$req->execute(array($voir_utilisateur['id'], $_SESSION['id'], $_SESSION['id'], $voir_utilisateur['id']));		
			
			header('Location: /voir-profil.php?id=' . $voir_utilisateur['id']);
			exit;
			
		}elseif(isset($_POST['user-bloquer'])){	
			$req = $BDD->prepare("SELECT id 
				FROM relation 
				WHERE (id_receveur = :id1 AND id_demandeur = :id2) OR (id_receveur = :id2 AND id_demandeur = :id1)");
			$req->execute(array('id1' => $voir_utilisateur['id'], 'id2' => $_SESSION['id']));		
			
			$verif_relation = $req->fetch();
			
			if(isset($verif_relation['id'])){
				$req = $BDD->prepare("UPDATE relation SET id_bloqueur = ? WHERE id = ?");
				$req->execute(array($voir_utilisateur['id'], $verif_relation['id']));	
			}else{
				$req = $BDD->prepare("INSERT INTO relation (id_demandeur, id_receveur, statut, id_bloqueur) VALUES (?, ?, ?, ?)");
				$req->execute(array($_SESSION['id'], $voir_utilisateur['id'], 3, $voir_utilisateur['id']));	
			}
			
			header('Location: /voir-profil.php?id=' . $voir_utilisateur['id']);
			exit;
			
		}elseif(isset($_POST['user-debloquer'])){	
			
			$req = $BDD->prepare("SELECT id, statut
				FROM relation 
				WHERE (id_receveur = :id1 AND id_demandeur = :id2) OR (id_receveur = :id2 AND id_demandeur = :id1)");
			$req->execute(array('id1' => $voir_utilisateur['id'], 'id2' => $_SESSION['id']));		
			
			$verif_relation = $req->fetch();
			
			if(isset($verif_relation['id'])){

				if($verif_relation['statut'] == 3){					
					$req = $BDD->prepare("DELETE FROM relation WHERE id = ?");
					$req->execute(array($verif_relation['id']));
					
				}else{
					$req = $BDD->prepare("UPDATE relation SET id_bloqueur = ? WHERE id = ?");
					$req->execute(array(NULL, $verif_relation['id']));
				}
				
			}
			
			
			header('Location: /voir-profil.php?id=' . $voir_utilisateur['id']);
			exit;
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    
    <!-- Title-->
    <title>Voir profil-Ambrosia</title>
    
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
		
		<?php
			include('menuSession.php');	
		?>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="membre-corps">
						<div>
							Pseudo : <?= $voir_utilisateur['pseudo'] ?>
						</div>
						<div>
							Pays : <?= $voir_utilisateur['nom_fr_fr'] ?>
						</div>
						<div>
							Age : <?= age($voir_utilisateur['date_naissance']) ?> ans
						</div>
					</div>
					<?php
						if(isset($_SESSION['id'])){	
					?>
					<div>
						<form method="post">
							<?php
								if(!isset($voir_utilisateur['statut'])){
							?>
							<input type="submit" name="user-ajouter" value="Ajouter">
							<?php
								}elseif(isset($voir_utilisateur['statut']) && $voir_utilisateur['id_demandeur'] == $_SESSION['id'] && !isset($voir_utilisateur['id_bloqueur']) && $voir_utilisateur['statut'] <> 2){
							?>
							<div>Demande en attente</div>
							<?php
								}elseif(isset($voir_utilisateur['statut']) && $voir_utilisateur['id_receveur'] == $_SESSION['id'] && !isset($voir_utilisateur['id_bloqueur']) && $voir_utilisateur['statut'] <> 2){
							?>
							<div>Vous avez une demande à accepter</div>
							<?php	
								}elseif(isset($voir_utilisateur['statut']) && $voir_utilisateur['statut'] == 2 && !isset($voir_utilisateur['id_bloqueur'])){
							?>
							<div>Vous êtes amis</div>
							<?php	
								}
								if(isset($voir_utilisateur['statut']) && !isset($voir_utilisateur['id_bloqueur']) && $voir_utilisateur['id_demandeur'] == $_SESSION['id'] && $voir_utilisateur['statut'] <> 2){
							?>		
							<input type="submit" name="user-supprimer" value="Supprimer">
							<?php
								}
								if((isset($voir_utilisateur['statut']) || $voir_utilisateur['statut'] == NULL) && !isset($voir_utilisateur['id_bloqueur'])){
							?>
							<input type="submit" name="user-bloquer" value="Bloquer">
							<?php
								}elseif($voir_utilisateur['id_bloqueur'] <> $_SESSION['id']){
							?>
							<input type="submit" name="user-debloquer" value="Débloquer">
							<?php		
								}else{
							?>
							<div>Vous avez été bloqué par cet utilisateur</div>
							<?php
								}
							?>
						</form>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>

		<?php include("footer.php");?>

	<div class="scroll-top">
	  <i class="ti-angle-up"></i>
	</div>
     
    <script src="assets/js/vendors.bundle.js"></script>
    <script src="assets/js/scripts.js"></script>
  </body>
</html>