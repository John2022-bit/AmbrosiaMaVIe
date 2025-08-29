<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}
	
	$req = $BDD->prepare("SELECT r.id, u.pseudo, u.id id_utilisateur
		FROM relation r
		INNER JOIN utilisateur u ON u.id = r.id_demandeur
		WHERE r.id_receveur = ? AND r.statut = ?");
		
	$req->execute(array($_SESSION['id'], 1));
				
	$afficher_demandes = $req->fetchAll();

	if(!empty($_POST)){
		extract($_POST);
		$valid = (boolean) true;
		
		if(isset($_POST['accepter'])){
			
			$id_relation = (int) $id_relation;
			
			if($id_relation > 0){
				$req = $BDD->prepare("SELECT id
					FROM relation
					WHERE id = ? AND statut = 1");
				$req->execute(array($id_relation));
			
				$verif_relation = $req->fetch();
				
				if(!isset($verif_relation['id'])){
					$valid = false;
				}
				
				if($valid){
					$req = $BDD->prepare("UPDATE relation SET statut = 2 WHERE id = ? AND id_receveur = ?");
					$req->execute(array($id_relation, $_SESSION['id']));
				}
			}

			header('Location: /demandes.php');
			exit;
			
		}elseif(isset($_POST['refuser'])){
			
			$id_relation = (int) $id_relation;
			
			if($id_relation > 0){
				$req = $BDD->prepare("DELETE FROM relation WHERE id = ? AND id_receveur = ?");
				$req->execute(array($id_relation, $_SESSION['id']));		
			}
			
			header('Location: /demandes.php');
			exit;
		}
	}
?>
<!doctype html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<link rel="stylesheet" href="style.css">

		<title>Demandes d'amis</title>
	</head>
	<body>
		
		<?php
			include('menuSession.php');	
		?>
		
		<div class="container">
			<div class="row">
				<?php
					foreach($afficher_demandes as $ad){
				?>
				<div class="col-sm-3">
					<div class="membre-corps">
						<div>
							<?= $ad['pseudo'] ?>
						</div>
						<div class="mambre-btn">
							<a href="voir-profil.php?id=<?= $ad['id_utilisateur'] ?>" class="membre-btn-voir">Voir</a>
						</div>
						<div>
							<form method="post"> 
								<input type="hidden" name="id_relation" value="<?= $ad['id'] ?>"/>
								<input type="submit" name="accepter" value="Accepter"/>
								<input type="submit" name="refuser" value="Refuser"/>
							</form>
						</div>
					</div>
				</div>
				<?php
					}	
				?>
			</div>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>