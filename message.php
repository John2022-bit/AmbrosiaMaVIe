<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
		exit;
	}
	
	$get_id = (int) $_GET['id'];

	if($get_id <= 0){
		header('Location: messagerie.php');
		exit;
	}
	
	$req = $BDD->prepare("SELECT id
		FROM relation
		WHERE ((id_demandeur, id_receveur) = (:id1, :id2) OR (id_demandeur, id_receveur) = (:id2, :id1)) AND statut = :statut");
		
	$req->execute(array('id1' => $_SESSION['id'], 'id2' => $get_id, 'statut' => 2));
		
	$verifier_relation = $req->fetch();
	
	if(!isset($verifier_relation['id'])){
		header('Location: messagerie.php');
		exit;
	}
	
	$req = $BDD->prepare("SELECT *
		FROM messagerie
		WHERE ((id_from, id_to) = (:id1, :id2) OR (id_from, id_to) = (:id2, :id1))
		ORDER BY date_message DESC
		LIMIT 25");
		
	$req->execute(array('id1' => $_SESSION['id'], 'id2' => $get_id));
		
	$afficher_message = $req->fetchAll();
	
	$req = $BDD->prepare("UPDATE messagerie SET lu = ? WHERE id_to = ? AND id_from = ?");
		
	$req->execute(array(0, $_SESSION['id'], $get_id));
	
	if(!empty($_POST)){
		extract($_POST);
		$valid = (boolean) true;
		
		if(isset($_POST['envoyer'])){
			$message = (String) trim($message);
			
			if(empty($message)){
				$valid = false;
				$er_message = "Il faut mettre un message";
			}
			
			if($valid){
				
				$date_message = date("Y-m-d h:i:s");
						
				$req = $BDD->prepare("INSERT INTO messagerie (id_from, id_to, message, date_message, lu) VALUES (?, ?, ?, ?, ?)");
					
				$req->execute(array($_SESSION['id'], $get_id, $message, $date_message, 1));
			}
			
			header('Location: /message.php?id=' . $get_id);
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

		<title>Message</title>
	</head>
	<body>
		
		<?php
			require_once('menu.php');	
		?>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="corps-des-messages">
						<?php
							foreach($afficher_message as $am){
								if($am['id_from'] == $_SESSION['id']){
						?>
						<div style="background: #666; color: white;">
							<?= nl2br($am['message']) ?>
						</div>
						<?php
								}else{
						?>
						<div>
							<?= nl2br($am['message']) ?>
						</div>
						<?php
								}
							}	
						?>
						<div id="afficher-message"></div>
						<div id="charger-message"></div>
					</div>
				</div>				
				<div class="col-sm-12" style="margin-top: 20px">
					<?php
						if(isset($er_message)){
							echo $er_message;
						}	
					?>
					<form method="post" id="envoyer">
						<textarea placeholder="Votre message ..." name="message" id="message"></textarea>
						<input type="submit" name="envoyer" value="Envoyer"/>
					</form>
				</div>
			</div>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script>
			$(document).ready(function(){
				
				$('#envoyer').on("submit", function(e){
					e.preventDefault();
					
					var id;
					var message;
					
					id = <?= json_encode($get_id, JSON_UNESCAPED_UNICODE); ?>;
					message = document.getElementById('message').value;
					
					document.getElementById('message').value = '';
					
					if(id > 0 && message != ""){
						$.ajax({
							url : 'envoyer-message.php',
							method : 'POST',
							dataType : 'html',
							data : {id: id, message: message},
							
							success : function(data){
								$('#afficher-message').append(data);
								document.getElementById('msg').scrollTop = document.getElementById('msg').scrollHeight; 
							},
							
							error : function(e, xhr, s){
								let error = e.responseJSON;
								if(e.status == 403 && typeof error !== 'undefined'){
									alert('Erreur 403');
								}else if(e.status == 404){
									alert('Erreur 404');
								}else if(e.status == 401){
									alert('Erreur 401');
								}else{
									alert('Erreur Ajax');
								}
							}
						});
					}
				});
				
				var chargement_message_auto = 0;
				
				chargement_message_auto = clearInterval(chargement_message_auto);
				
				chargement_message_auto = setInterval(chargerMessageAuto, 2000);
				
				function chargerMessageAuto(){
					
					var id = <?= json_encode($get_id, JSON_UNESCAPED_UNICODE); ?>;
					
					if(id > 0){
						$.ajax({
							url : 'charger-message.php',
							method : 'POST',
							dataType : 'html',
							data : {id: id},
							
							success : function(data){
								if(data.trim() != ""){
									$('#charger-message').append(data);	
									document.getElementById('msg').scrollTop = document.getElementById('msg').scrollHeight; 
								}
							},
							
							error : function(e, xhr, s){
								let error = e.responseJSON;
								if(e.status == 403 && typeof error !== 'undefined'){
									alert('Erreur 403');
								}else if(e.status == 404){
									alert('Erreur 404');
								}else if(e.status == 401){
									alert('Erreur 401');
								}else{
									alert('Erreur Ajax');
								}
							}
						});
					}
				}
			});		
		</script>
	</body>
</html>