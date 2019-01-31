<?php 
require 'header.php';
?>

<body class="head2">
    <div class="container-fluid font head2" >
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
                        <form class="col-lg-10" method="POST" action="send_mail.php">
                                <div class="form-group">
                                    <div class="col-xs-8"></div>
                                    <div id="add" class="col-xs-4">
                                        <label for="text">Destinataire </label>
                                        <input type="text" name="receiver" id="search" value="">
                                    </div>
                                </div>
                                <div class="hid col-xs-12">
                                    <div class="col-xs-10"></div>
                                    <div id="results" class="col-xs-2"></div>
                                </div>
                                <div id='object' class="form-group">
                                    <label for="text">Objet</label>
                                    <input name="object" type="text" class="form-control" placeholder="Objet de votre message">
                                </div>

                                <div class="form-group">
                                    <label for="text">Message</style></label>
                                    <textarea name="msg" class="form-control" placeholder="Votre message" style="height: 200px"></textarea>
                                </div>
                                <div style="color: red">Ne divulgez aucune information confidentielle par le biais des messages</div>
                                <div class="text-center">
                                    <button class="btn btn-warning">Envoyer</button>
                                </div>
                        </form> 
                    </div>
                </div>
                <?php 
            require 'jauge.php';
        ?>
            </div>
    </div>
</body>
<?php
    if (isConnected()) {
        if(isset($_GET['a']) && isset($_GET['b'])) {
            echo "  <script>
                        add('".$_GET['a']."', '".$_GET['b']."')
                    </script>";
        }
}else{
	echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}
?>


<script>
    $(document).ready( function() {
        // détection de la saisie dans le champ de recherche
        $('#search').keyup( function() {
            $field = $(this);
            $('#results').html(''); // on vide les resultats
            // on commence à traiter à partir du 2ème caractère saisie
            if($field.val().length > 1) {
                // on envoie la valeur recherché en GET au fichier de traitement
                $.ajax({
                    type : 'GET', // envoi des données en GET ou POST
                    url : 'nav_search.php', // url du fichier de traitement
                    data : 'search='+$(this).val(), // données à envoyer en  GET ou POST
                    success : function(data) { // traitements JS à faire APRES le retour d'ajax-search.php
                        $('#results').html(data); // affichage des résultats dans le bloc
                    }
                });
            }       
        });
    });
</script>
