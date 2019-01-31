<?php require 'init.php';


if(isConnected()) {
	if(isset($_POST['msg']) && isset($_POST['object']) && isset($_POST['receiver']) && isset($_SESSION['Member_ID'])) {
		$bdd = connectBdd();
		$query = $bdd->prepare('SELECT Member_ID FROM member WHERE Pseudo = :pseudo');
		$query->execute(['pseudo'=>$_POST['receiver']]);
		$result = $query->fetch();

		$query2 = $bdd->prepare('INSERT INTO message (object, content, receiver, sender) VALUES (:object, :msg, :receiver, :sender)');
		$query2->execute([
							'object'=>$_POST['object'],
							'msg'=>$_POST['msg'],
							'receiver'=>$result['Member_ID'],
							'sender'=>$_SESSION['Member_ID']
						]);
	}
	header("Location: new_message.php");
}else{
    echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}