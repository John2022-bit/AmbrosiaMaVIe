<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}
	
	$req = $BDD->prepare("SELECT COUNT(id) AS nb_amis
		FROM relation
		WHERE (id_demandeur = :id OR id_receveur = :id) AND statut = 2");
		
	$req->execute(array('id' => $_SESSION['id']));
		
	$nb_conversation = $req->fetch();
	
//	echo $nb_conversation['nb_amis'];

	$req = $BDD->prepare("SELECT u.pseudo, u.id, m.message, m.date_message, m.id_from, m.lu
		FROM (
			SELECT IF(r.id_demandeur = :id, r.id_receveur, r.id_demandeur) id_utilisateur, MAX(m.id) max_id
			FROM relation r
			LEFT JOIN messagerie m ON ((m.id_from, m.id_to) = (r.id_demandeur, r.id_receveur) OR (m.id_from, m.id_to) = (r.id_receveur, r.id_demandeur))
			WHERE (r.id_demandeur = :id OR r.id_receveur = :id) AND r.statut = 2
			GROUP BY IF(m.id_from = :id, m.id_to, m.id_from), r.id) AS DM
		LEFT JOIN messagerie m ON m.id = DM.max_id
		LEFT JOIN utilisateur u ON u.id = DM.id_utilisateur
		ORDER BY m.date_message DESC");
		
	$req->execute(array('id' => $_SESSION['id']));
		
	$afficher_conversations = $req->fetchAll();
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

		<title>Messagerie</title>
	</head>
	<body>
		
		<?php
			require_once('menu.php');	
		?>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<table>
					<?php
						foreach($afficher_conversations as $ac){
					?>
					<tr>
						<td>
							<a href="message.php?id=<?= $ac['id']?>">
								<?= $ac['pseudo'] ?>
							</a>		
						</td>
						<td>
							<?php
								if($ac['id_from'] <> $_SESSION['id'] && $ac['lu'] == 1){
							?>
							Nouveau
							<?php	
								}
							?>
						</td>
						<td>
							<?php 
								if(isset($ac['message'])){
									echo $ac['message'];
								}else{
									echo '<b>Dites lui bonjours !</b>';
								}
							?>
						</td>
						<td>
							<?php
								if(isset($ac['date_message'])){
									echo date('d-m-Y à H:i:s', strtotime($ac['date_message']));
								}
							?>
						</td>
					</tr>
					<?php
						}	
					?>
					</table>
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