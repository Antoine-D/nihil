<?php 
require 'header.php';


 if (isConnected() && VerifBan($_SESSION['Mail']) ) {
        
        $bdd = connectBdd();

        $load = $bdd->prepare('UPDATE mail SET seen = 1 WHERE receiver = :id');
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
<body class="head2 font-color">
    <section>
        <div class="container-fluid">
            <div class="row">
                <?php require "ressource.php"; ?>
            </div>
            <div class="row">
               	<?php require 'sidebar.php'; ?>
                <div class="col-sm-8 msgBox">
                <br>
                    <legend class="text-center">Messagerie</legend>
                    <div class="row">
                        <div>
                            <ul class="list list-inline text-center">
                                <li><a href="mail.php" class="msgNav">Messages</a></li>
                                <li><a href="sent_mails.php" class="msgNav">Messages envoyés</a></li>
                                <li><a href="new_mail.php" class="msgNav">Nouveau Message</a></li>
                            </ul>
                            <nav>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <?php
                            $query = $bdd->prepare('SELECT * FROM mail WHERE receiver = :id ORDER BY id DESC');
                            $query->execute(['id'=>$_SESSION['Member_ID']]);
                            $a = 0;
                            while($result = $query->fetch()) {
                                $a++;
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
                                                    <a href='new_mail.php?a=".$result2['Pseudo']."&b=".$result['object']."'>Répondre</a>
                                                    <a href='delete_mail.php?id=".$result['id']."&page=1'>Supprimer</a>
                                                </div>
                                            </div>
                                        </div><br><br>";
                            }
                            if($a == 0) {
                                echo 'Aucun message de reçu';
                            }
                        ?>
                    </div>
                </div>
                    <?php 
                        require 'jauge.php';
                    ?>
            </div>
        </div>
        <?php
        }else{
            echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
            echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
        }
        ?>
    </section>
</body>

