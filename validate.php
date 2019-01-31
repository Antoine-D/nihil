<?php
require 'init.php';

if(isConnected()) {
	$bdd = connectBdd();
	unset($_SESSION['error_subscription']);
	$change = 0;
	if($_GET['part'] == 1) {
		if(isset($_POST['pseudo'])) {
		    $_POST['Pseudo']=trim($_POST['Pseudo']);
			$query_pseudo = $bdd->prepare("SELECT Pseudo FROM member WHERE Member_ID = :member");
			$query_pseudo->execute(['member'=>$_SESSION['Member_ID']]);
			$pseudo = $query_pseudo->fetch();

			if($_POST['pseudo'] != $pseudo['Pseudo']) {
				VerifPseudo($_POST['pseudo']);
				pseudoExist($_POST['Pseudo']);
				if(isset($_SESSION['error_subscription'])) {
					$_SESSION['options'] = $_POST;
					header("Location: game.php");
				}else{
					$query_pseudo_change = $bdd->prepare("UPDATE member SET Pseudo = :pseudo WHERE Member_ID = :member");
					$query_pseudo_change->execute(['pseudo'=>$_POST['pseudo'], 'member'=>$_SESSION['Member_ID']]);
					$change++;
				}
			}
		}

		if(preg_match(".+", $_POST['mail'])) {
		    $_POST['mail']=strtolower(trim($_POST['Mail']));

			//VerifMail($_POST['mail']);
			VerifMailConc($_POST['mail'], $_POST['mail2']);
			if(isset($_SESSION['error_subscription'])) {
				header("Location: tchat.php");
			}else{
				$query_mail_change = $bdd->prepare("UPDATE member SET Mail = :mail WHERE Member_ID = :member");
				$query_mail_change->execute(['mail'=>$_POST['mail'], 'member'=>$_SESSION['Member_ID']]);
					$change++;
			}
		}

		if(isset($_POST['pwd']) && isset($_POST['pwd2']) &&	isset($_POST['pwd3'])) {
			$query_pwd = $bdd ->prepare(" SELECT Password FROM member WHERE Member_ID = :member");
	        $query_pwd->execute(["member"=>$_SESSION['Member_ID']]);
	        $result=$query_pwd->fetch();
	        if(password_verify($_POST['pwd'], $result['Password'])) {

				VerifPwdConc($_POST['pwd2'], $_POST['pwd3']);
				if(isset($_SESSION['error_subscription'])) {
					$_SESSION['options'] = $_POST;
					header("Location: game.php");
				}else{
					$pwd = password_hash($_POST['pwd2'], PASSWORD_DEFAULT);
					$query_pwd_change = $bdd->prepare("UPDATE member SET Password = :pwd WHERE Member_ID = :member");
					$query_pwd_change->execute(['pwd'=>$pwd, 'member'=>$_SESSION['Member_ID']]);
					$change++;
				}

			}else{
				$_SESSION['error_subscription'] = 18;
			}
		}



	}else if($_GET['part'] == 2) {



		$query_score = $bdd->prepare("SELECT option_score FROM member WHERE Member_ID = :member");
		$query_score->execute(['member'=>$_SESSION['Member_ID']]);
		$score = $query_score->fetch();
		if($score['option_score'] != isset($_POST['score'])) {
			$score['option_score'] = ($score['option_score'] + 1) % 2;
			$query_score_change = $bdd->prepare("UPDATE member SET option_score = :value WHERE Member_ID = :member");
			$query_score_change->execute(['value'=>$score['option_score'], 'member'=>$_SESSION['Member_ID']]);
			$change++;
		}
	    
	    if(isset($_POST['theme'])) {
	    	$query_theme = $bdd->prepare("UPDATE member SET theme_id = :theme WHERE Member_ID =:id");
	    	$query_theme->execute(['theme'=>$_POST['theme'], 'id'=>$_SESSION['Member_ID']]);
	    }
	    
	    
		$query_ressources = $bdd->prepare("SELECT option_ressources FROM member WHERE Member_ID = :member");
		$query_ressources->execute(['member'=>$_SESSION['Member_ID']]);
		$ressources = $query_ressources->fetch();
		if($ressources['option_ressources'] != isset($_POST['ressources'])) {
			$ressources['option_ressources'] = ($ressources['option_ressources'] + 1) % 2;
			$query_ressources_change = $bdd->prepare("UPDATE member SET option_ressources = :value WHERE Member_ID = :member");
			$query_ressources_change->execute(['value'=>$ressources['option_ressources'], 'member'=>$_SESSION['Member_ID']]);
					$change++;
		}



	}else if($_GET['part'] == 3) {

		$query_holidays = $bdd->prepare("SELECT option_holidays FROM member WHERE Member_ID =:Member_ID");
		$query_holidays->execute(["Member_ID"=>$_SESSION['Member_ID']]);
		$holidays = $query_holidays->fetch();
		if($holidays["option_holidays"] != isset($_POST['holidays'])){
			$holidays["option_holidays"] = ($holidays["option_holidays"]+1)%2;
			$query_holidays_change = $bdd->prepare("UPDATE member SET option_holidays=:value WHERE Member_ID=:Member_ID");
			$query_holidays_change->execute(["value"=>$holidays['option_holidays'], "Member_ID"=>$_SESSION['Member_ID']]);
			$change++;
		}
	}

	if(!isset($_SESSION['error_subscription']) && $change > 0) {
		header("Location: options.php?success=1");
	}else{
		header("Location: option.php");
	}
}