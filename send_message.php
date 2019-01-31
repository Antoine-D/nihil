<?php
	require 'init.php';
	$bdd = connectBdd();

	if(isset($_GET['message']) && $_GET['message'] != '') {
		//if(preg_match("[^ ]{1,}.*", ($_GET['message']))) {
			$_GET['message'] = trim($_GET['message']);
			$length = strlen($_GET['message']);
			if($length > 100) {
				$length = -($length - 100);
				$_GET['message'] = substr($_GET['message'], 0, $length);
			}
			$insert = $bdd->prepare('INSERT INTO message (content, sender, id_tchat) VALUES (:msg, :member, :tchat)');
			$insert->execute(['msg'=>$_GET['message'], 'member'=>$_SESSION['Member_ID'], 'tchat'=>$_GET['p']]);

			$check = $bdd->prepare('SELECT COUNT(id) FROM message WHERE id_tchat = :id');
			$check->execute(['id'=>$_GET['p']]);
			$a = $check->fetch();

			if($a['COUNT(id)'] > 100) {
				$select = $bdd->prepare('SELECT MIN(id) FROM message WHERE id_tchat = :id;');
				$select->execute(['id'=>$_GET['p']]);
				$b = $select->fetch();

				$delete = $bdd->prepare('DELETE FROM message WHERE id = :id');
				$delete->execute(['id'=>$b['MIN(id)']]);
			}
		//}
	}
	
	$query = $bdd->prepare('SELECT message.content, message.sender, message.date_sent, member.Pseudo
							FROM message, member WHERE message.id_tchat = :id AND member.Member_ID = message.sender ORDER BY id ASC');
	$query->execute(['id'=>$_GET['p']]);
	while($result = $query->fetch()) {
		echo "	<div class='row'>
					<div class='row'>
						<div class='col-md-12'>
							<b>".$result['Pseudo']."</b> <i>(".$result['date_sent'].")</i> : ".$result['content']."
						</div>
					</div>
					<hr class='star-light'>
				</div>";
	}