<?php 
require 'header.php';
require 'sidebar.php';
?>

<script>  
    $(document).ready( function() {
        // détection de la saisie dans le champ de recherche
        $('#search').keyup( function() {
            $field = $(this);
            $('#results').html(''); // on vide les resultats
     
            // on commence à traiter à partir du 2ème caractère saisie
            if( $field.val().length > 1 ) {
                // on envoie la valeur recherché en GET au fichier de traitement
                if(document.getElementById('results').style.visibility=="hidden") {
                    document.getElementById('results').style.visibility = "visible";
                }else{
                    document.getElementById('results').style.visibility = "hidden";
                }
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
            	<form class="col-lg-10" method="POST" action="send_message.php">
                        <div class="form-group">
                            <div class="col-xs-8"></div>
                            <div id="add" class="col-xs-4">
                                <label for="text">Destinataire </label>
                                <input type="text" name="receiver" id="search" value="">
                            </div>
                        </div>
                        <div class="hid col-xs-12" style="visibility: hidden;" >
                            <div class="col-xs-10"></div>
                            <div id="results" class="col-xs-2"></div>
                        </div>
                        <div id='object' class="form-group">
                            <label for="text">Objet</label>
                            <input name="object" type="text" class="form-control" placeholder="Objet de votre message">
                        </div>

                        <div class="form-group">
                            <label for="text">Message</style></label>
                            <textarea name="msg" class="form-control" placeholder="Votre message"></textarea>
                        </div>
                        <div style="color: red">Ne divulgez aucune information confidentielle par le biais des messages</div>
                        <button class="btn btn-primary">Envoyer</button>
                </form> 
            </div>
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
