<?php
require "init.php";

if ( isConnected() ){
    if ( isAdmin() || isModo() ){
        
        // Verifier que l'user soit connecté

        if ( isConnected()){

            $bdd = connectBdd();

            $query = $bdd->prepare("DELETE from guild WHERE Guild_ID=:titi");
            $query->execute([ "titi"=>$_GET['Guild_ID']] );

            $query2 = $bdd->prepare("UPDATE member SET Guild_ID = 0, Guild_Rank = 1, Guild = 0 WHERE Guild_ID =:titi");
            $query2->execute([ "titi"=>$_GET['Guild_ID']] );

        }
        // Si oui supprimer le compte sur lequel on a cliqué
        // a condition qu'il ne sagisse pas de moi
        header("Location: listGuild.php");
        // rediriger sur la home
    }
    else {
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p>";
        echo "<p class='text-center'>Cliquez <a href='game.php'>ici</a> pour retourner sur la page de jeu.</p>";
    }
}
else {
    echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}
    
?>