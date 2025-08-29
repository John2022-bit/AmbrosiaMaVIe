<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: /');
		exit;
	}
	
	$utilisateur_id = (int) $_SESSION['id'];
	
	if(empty($utilisateur_id)){
		header('Location: /membres.php');
		exit;	
	}
	
	$req = $BDD->prepare("SELECT u.*, p.nom_fr_fr
		FROM utilisateur u
		INNER JOIN pays p ON d.code = u.pays
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
			$pseudo = (String) trim($pseudo);
			$mail = (String) strtolower(trim($mail));
			$pays = (String) trim($pays);
			
			if(empty($pseudo)){
				$valid = false;
				$err_pseudo = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE pseudo = ? AND id <> ?");
					
				$req->execute(array($pseudo, $_SESSION['id']));
				$utilisateur = $req->fetch();
				
				if(isset($utilisateur['id'])){
					$valid = false;
					$err_pseudo = "Ce pseudo existe déjà";
				}
			}
			
			if(empty($mail)){
				$valid = false;
				$err_mail = "Veuillez renseigner ce champs !";
			}else{
				$req = $BDD->prepare("SELECT id
					FROM utilisateur 
					WHERE mail = ? AND id <> ?");
					
				$req->execute(array($mail, $_SESSION['id']));
				$utilisateur = $req->fetch();
				
				if(isset($utilisateur['id'])){
					$valid = false;
					$err_mail = "Ce mail existe déjà";
				}
			}			
			
			$req = $BDD->prepare("SELECT id, code, nom_fr_fr
				FROM pays
				WHERE code = ?");
			$req->execute(array($pays));
			
			$verif_pays = $req->fetch();
						
			if(!isset($verif_pays['pays_id'])){
				$valid = false;
				$err_pays = "Veuillez renseigner ce champs !";
			}
			
			if($valid){
								
				$req = $BDD->prepare("UPDATE utilisateur SET pseudo = ?, mail = ?, pays = ? WHERE id = ?");
					
				$req->execute(array($pseudo, $mail, $verif_pays['code'], $_SESSION['id']));
				
				header('Location: /profil.php');
				exit;
			}
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

		<title>Éditer mon profil</title>
	</head>
	<body>
		
		<?php
			require_once('menu.php');	
		?>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="membre-corps" style="text-align: left">
						<form method="post">
							<div>
								<?php
									if(isset($err_pseudo)){
										echo $err_pseudo;
									}
										
									if(!isset($pseudo)){
										$pseudo = $voir_utilisateur['pseudo'];
									}
								?>
								<label>Pseudo :</label>
								<br>
								<input type="text" name="pseudo" value="<?= $pseudo ?>">
							</div>
							<div>
								<?php
									if(isset($err_pays)){
										echo $err_pays;
									}
								?>
								<label>Pays :</label>
								<br>
								<select name="pays">
									<?php
										if(!isset($pays)){
									?>
									<option value="<?= $voir_utilisateur['pays'] ?>"><?= $voir_utilisateur['nom_fr_fr']?></option>
									<?php
										}else{
									?>
									<option value="<?= $verif_pays['code'] ?>"><?= $verif_pays['nom_fr_fr']?></option>
									<?php
										}
										
										
										$req = $BDD->prepare("SELECT *
											FROM pays");
											
										$req->execute();
										
										$voir_pays = $req->fetchAll();	
										
										foreach($voir_pays as $vd){
									?>
									<option value="<?= $vd['code'] ?>"><?= $vd['nom_fr_fr']?></option>
									<?php
										}
									?>
								</select>
							</div>
							<div>
								<?php
									if(isset($err_mail)){
										echo $err_mail;
									}
									
									if(!isset($mail)){
										$mail = $voir_utilisateur['mail'];
									}
								?>
								<label>Mail</label>
								<br>
								<input type="text" name="mail" value="<?= $mail ?>">
							</div>
							<br>
							<input type="submit" name="modifier" value="Modifier">
							
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>