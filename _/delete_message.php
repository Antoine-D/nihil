<?php
require 'init.php';
if(isConnected()) {
	if(isset($_GET['id'])) {
		$bdd = connectBdd();
		$query = $bdd->prepare('DELETE FROM message WHERE id = :id AND receiver = :user');
		$query->execute(['id'=>$_GET['id'], 'user'=>$_SESSION['Member_ID']]);
	}
}else{
	echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}
header('Location: message.php'); 