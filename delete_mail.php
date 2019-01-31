<?php
require 'init.php';
if(isConnected()) {
	if(isset($_GET['id']) && isset($_GET['page'])) {
		$bdd = connectBdd();
		if($_GET['page'] == 1) {
			$query = $bdd->prepare('DELETE FROM mail WHERE id = :id AND receiver = :user');
			$query->execute(['id'=>$_GET['id'], 'user'=>$_SESSION['Member_ID']]);
			header('Location: mail.php');
		}else{
			if($_GET['page'] == 2) {
				$query = $bdd->prepare('DELETE FROM mail WHERE id = :id AND sender = :user');
				$query->execute(['id'=>$_GET['id'], 'user'=>$_SESSION['Member_ID']]);
				header('Location: sent_mail.php');
			}else{
				header("Location: game.php");
			}
		}
	}
}else{
	echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}