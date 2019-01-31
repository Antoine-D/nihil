<?php
	require "init.php";
	if ( isConnected()) {
		$bdd = connectBdd();
		if(!endGame()) {
			$query = $bdd->prepare("SELECT player_score, bot_score FROM member WHERE Member_ID = :id");
			$query->execute(['id'=>$_SESSION['Member_ID']]);
			$result = $query->fetch();
			$_GET['player_score'] = $result['player_score'];
			$_GET['bot_score'] = $result['bot_score'];
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
				if(($_GET['player_choice'] == 1 && $_GET['bot_choice'] == 3) || ($_GET['player_choice'] == 2 && $_GET['bot_choice'] == 1) || ($_GET['player_choice'] == 3 && $_GET['bot_choice'] == 2)) {
					echo "Gagné !";
					$query2 = $bdd->prepare("UPDATE member SET player_score = :titi WHERE member_id = :tutu");
					$query2->execute(['titi'=>$_GET['player_score']+1, 'tutu'=>$_SESSION['Member_ID']]);
				}else{
					echo "Perdu !";
					$query2 = $bdd->prepare("UPDATE member SET bot_score = :titi WHERE member_id = :tutu");
					$query2->execute(['titi'=>$_GET['bot_score']+1, 'tutu'=>$_SESSION['Member_ID']]);
				}
			}
			$query3 = $bdd->prepare("SELECT player_score, bot_score FROM member WHERE Member_ID = :id");
			$query3->execute(['id'=>$_SESSION['Member_ID']]);
			$result3 = $query3->fetch();
			echo "Vous : ".$result3['player_score']."Bot : ".$result3['bot_score'];
			echo "</h2>";
		}else{
			$query = $bdd->prepare("SELECT player_score, bot_score FROM member WHERE Member_ID = :id");
			$query->execute(['id'=>$_SESSION['Member_ID']]);
			$result = $query->fetch();
			if($result['player_score'] > $result['bot_score']) {
				echo "<h2>Terminé<br>Félicitations, vous avez gagné : [insérer récompense]<br>Temps à attendre avant de pouvoir rejouer : --:--:-- !</h2>";
			}else{
				echo "<h2>Terminé<br>Vous avez perdu...<br>Temps à attendre avant de pouvoir rejouer : --:--:-- !</h2>";
			}
			$query = $bdd->prepare("UPDATE member SET player_score = 0, bot_score = 0 WHERE Member_ID = :id");
			$query->execute(['id'=>$_SESSION['Member_ID']]);
		}
	}else{
		header("Location: index.php");
	}
?>