<?php
	session_start();
	
	include_once('db/connexiondb.php');	
	
	if(!isset($_SESSION['id'])){
		exit;
	}
	
	$get_id = (int) $_POST['id'];
	$get_message = (String) urldecode(trim($_POST['message']));
	
	if($get_id <= 0 || empty($get_message)){
		exit;
	}
	
	$req = $BDD->prepare("SELECT id
		FROM relation
		WHERE ((id_demandeur, id_receveur) = (:id1, :id2) OR (id_demandeur, id_receveur) = (:id2, :id1)) AND statut = :statut");
		
	$req->execute(array('id1' => $_SESSION['id'], 'id2' => $get_id, 'statut' => 2));
		
	$verifier_relation = $req->fetch();
	
	if(!isset($verifier_relation['id'])){
		exit;
	}
	
	$date_message = date("Y-m-d h:i:s");
	
	$req = $BDD->prepare("INSERT INTO messagerie (id_from, id_to, message, date_message, lu) VALUES (?, ?, ?, ?, ?)");
		
	$req->execute(array($_SESSION['id'], $get_id, $get_message, $date_message, 1));
	
?>
<div style="background: #666; color: white;">
	<?= nl2br($get_message) ?>
</div>