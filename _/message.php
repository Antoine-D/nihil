<?php 
require 'header.php';
require 'sidebar.php';


 if (isConnected() ) {
        
        $bdd = connectBdd();

        $load = $bdd->prepare('UPDATE message SET seen = 1 WHERE receiver = :id');
        $load->execute(['id'=>$_SESSION['Member_ID']]);

        $result = $bdd->prepare('SELECT * FROM member');
        $result->execute();
        $data = $result->fetch();
 
    if ( !isset($data["Member_ID"])) {

            header("Location: game.php");

        }
        if ( empty($data) ) {
            
             header("Location: options.php");
            
        }else if ( empty($_POST)) {
            
            $_POST = $data;
            
        }
?>
<div class="container-fluid font" style="border: 1px solid black;">
    <div class="row">
        
        <div class="col-xs-1"></div>
        <div class="col-xs-7">
        <br>
            <legend class="text-center">Messagerie</legend>
            <div class="row">
            	<div class="col-xs-12">
                    <ul class="list list-inline">
                        <li><a href="message.php" class="msgNav">Messages</a></li>
                        <li><a href="sent_messages.php" class="msgNav">Messages envoyés</a></li>
                        <li><a href="new_message.php" class="msgNav">Nouveau Message</a></li>
                    </ul>
                    <nav>
                </div>
            </div>
            <div class="col-xs-12">
            	<?php
                    $query = $bdd->prepare('SELECT * FROM message WHERE receiver = :id ORDER BY id DESC');
                    $query->execute(['id'=>$_SESSION['Member_ID']]);

                    while($result = $query->fetch()) {
                        $query2 = $bdd->prepare('SELECT Pseudo FROM member WHERE Member_ID = :id');
                        $query2->execute(['id'=>$result['sender']]);
                        $result2 = $query2->fetch();
                        echo "  <div class='row'>
                                    <div class='row'>
                                        <div class='col-xs-2'>De : ".$result2['Pseudo']."</div>
                                        <div class='col-xs-10'>Objet : ".$result['object']."</div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-lg-12'>".$result['content']."</div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-lg-12'>
                                            <a href='new_message.php?a=".$result2['Pseudo']."&b=".$result['object']."'>Répondre</a>
                                            <a href='delete_message.php?id=".$result['id']."'>Supprimer</a>
                                        </div>
                                    </div>
                                </div><br><br>";
                    }
                ?>
            </div>
<?php
}else{
	echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}
?>
