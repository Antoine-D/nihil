<?php
	require "init.php";
	if ( isConnected()) {
		$bdd = connectBdd();
		$query = $bdd->prepare("SELECT player_score, bot_score, pfc_date, pfc_end FROM member WHERE Member_ID = :id");
		$query->execute(['id'=>$_SESSION['Member_ID']]);
		$result = $query->fetch();
		if($result['pfc_end']) {
			$current = gmdate('Y-m-d H:i:s');
    		$time = $result['pfc_date'] - strtotime($current);
    		$time = gmdate('H:i:s', $time);
			$deadline = gmdate('Y-m-d H:i:s', strtotime($result['pfc_date'].'+5 hour'));
			if($current < $deadline) {
				if($result['player_score'] > $result['bot_score']) {
					echo "<h2>Terminé<br>Félicitations, vous avez gagné : [insérer récompense]<br>Temps à attendre avant de pouvoir rejouer : ".$time." !</h2>";
				}else{
					echo "<h2>Terminé<br>Vous avez perdu...<br>Temps à attendre avant de pouvoir rejouer : ".$time." !</h2>";
				}
			}else{
				$query2 = $bdd->prepare("UPDATE member SET pfc_end = 0, bot_score = 0, player_score = 0 WHERE Member_ID = :member");
				$query2->execute(['member'=>$_SESSION['Member_ID']]);
			}
		}else{
			if(isset($_GET['player_choice']) && isset($_GET['bot_choice'])) {
				if($_GET['bot_choice'] == 1) {
					$bot_choice = "Pierre";
				}else{
					if($_GET['bot_choice'] == 2) {
						$bot_choice = "Feuille";
					}else{
						$bot_choice = "Ciseaux";
					}
				}
				if($_GET['player_choice'] == 1) {
					$player_choice = "Pierre";
				}else{
					if($_GET['player_choice'] == 2) {
						$player_choice = "Feuille";
					}else{
						$player_choice = "Ciseaux";
					}
				}
				echo "<h2>".$player_choice." vs ".$bot_choice."<br>";
				if($_GET['player_choice'] == $_GET['bot_choice']) {
					echo "Egalité !";
				}else{
					if( ($_GET['player_choice'] == 1 && $_GET['bot_choice'] == 3) || 
						($_GET['player_choice'] == 2 && $_GET['bot_choice'] == 1) || 
						($_GET['player_choice'] == 3 && $_GET['bot_choice'] == 2)) {
						echo "Gagné !";
						$query2 = $bdd->prepare("UPDATE member SET player_score = :score WHERE Member_ID = :member");
						$query2->execute(['score'=>$result['player_score']+1, 'member'=>$_SESSION['Member_ID']]);
					}else{
						echo "Perdu !";
						$query2 = $bdd->prepare("UPDATE member SET bot_score = :score WHERE Member_ID = :member");
						$query2->execute(['score'=>$result['bot_score']+1, 'member'=>$_SESSION['Member_ID']]);
					}
				}
				$query->execute(['id'=>$_SESSION['Member_ID']]);
				$result3 = $query->fetch();
				echo "Vous : ".$result3['player_score']."Bot : ".$result3['bot_score'];
				echo "</h2>";
				if($result3['player_score'] == 3 || $result3['bot_score'] == 3) {
					$current = date('Y-m-d H:i:s');
					$query3 = $bdd->prepare("UPDATE member SET pfc_date = :value, pfc_end = 1 WHERE Member_ID = :member AND pfc_end = 0");
					$query3->execute(['value'=>$current, 'member'=>$_SESSION['Member_ID']]);
				}
			}
		}
	}else{
		header("Location: index.php");
	}
?>