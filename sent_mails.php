<?php 
require 'header.php';


 if (isConnected() ) {
        
        $bdd = connectBdd();
        $result = $bdd->prepare('SELECT * FROM member');
        $result->execute();
        $data = $result->fetch();
 
    if (!isset($data["Member_ID"])) {

        header("Location: game.php");

    }
    if ( empty($data) ) {        
        header("Location: options.php");
    }else if(empty($_POST)) {
        $_POST = $data;
    }
?>
<body class="head2">
    <section>
        <div class="container-fluid font ">
            <div class="row">
                <?php require "ressource.php"; ?>
            </div>
            <div class="row">
               	<?php require 'sidebar.php'; ?>
                <div class="col-xs-8 msgBox">
                <br>
                    <legend class="text-center">Messagerie</legend>
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="list list-inline text-center">
                                <li><a href="mail.php" class="msgNav">Messages</a></li>
                                <li><a href="sent_mails.php" class="msgNav">Messages envoyés</a></li>
                                <li><a href="new_mail.php" class="msgNav">Nouveau Message</a></li>
                            </ul>
                            <nav>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <?php
                            $query = $bdd->prepare('SELECT * FROM mail WHERE sender = :id ORDER BY id DESC');
                            $query->execute(['id'=>$_SESSION['Member_ID']]);
                            $a = 0;
                            while($result = $query->fetch()) {
                                $a++;
                                $query2 = $bdd->prepare('SELECT Pseudo FROM member WHERE Member_ID = :id');
                                $query2->execute(['id'=>$result['receiver']]);
                                $result2 = $query2->fetch();
                                echo "  <div class='row'>
                                            <div class='row '>
                                                <div class='col-xs-2'>A : ".$result2['Pseudo']."</div>
                                                <div class='col-xs-9'>Objet : ".$result['object']."</div>
                                                <div class='col-xs-1'>";
                                if($result['seen'] == 1) {
                                    echo "Vu <span style='color: #00CC77'> ✔</span>";
                                }
                                echo "			</div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-lg-12'>".$result['content']."</div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-lg-12'>
                                                    <a href='new_mail.php?a=".$result2['Pseudo']."&b=".$result['object']."'>Envoyer un nouveau message</a>
                                                    <a href='delete_mail.php?id=".$result['id']."&page=2'>Supprimer</a>
                                                </div>
                                            </div>
                                        </div><br><br>";
                            }
                            if($a == 0) {
                                echo "Aucun message d'envoyé";
                            }
                        ?>
                        </div>
                    </div>
                    <?php 
                        require 'jauge.php';
                    ?>
                </div>
            </div>
    </section>
</body>
<?php
}else{
    echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}
?>
