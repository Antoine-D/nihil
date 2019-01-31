<?php
	require 'init.php';
	if(isConnected() && VerifBan($_SESSION['Mail']) ) {
		$bdd = connectBdd();
		if($_GET['p'] == 1) {
			$query = $bdd->prepare('SELECT Connected, Pseudo FROM member WHERE Member_ID <> :id ORDER BY Connected DESC');
			$query->execute(['id'=>$_SESSION['Member_ID']]);
			while($result = $query->fetch()) {
				echo "	<div class='row'";
				if($result['Connected'] == 1) {
					echo "><b>".$result['Pseudo']."<span style='color: #00CC77'> • </span></b></div>";
				}else{
					echo " style='color: grey'>".$result['Pseudo']."</div>";
				}
			}
		}else{
			$query2 = $bdd->prepare('SELECT Connected, Pseudo FROM member WHERE Member_ID <> :id AND Faction = :value ORDER BY Connected DESC');
			$query2->execute(['id'=>$_SESSION['Member_ID'], 'value'=>$_GET['p']-1]);
			while($result2 = $query2->fetch()) {
				echo "	<div class='row'";
				if($result['Connected'] == 1) {
					echo "><b>".$result2['Pseudo']."<span style='color: #00CC77'> • </span></b></div>";
				}else{
					echo " style='color: grey'>".$result2['Pseudo']."</div>";
				}
			}
		}
	}

?>