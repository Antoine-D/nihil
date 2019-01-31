<?php

require 'init.php';

if ( isConnected() ){
    if ( isAdmin() || isModo() ){
       $bdd = connectBdd();

       $query = $bdd->prepare("UPDATE member set Ban=0 WHERE Member_ID=:titi ");
       $query->execute (["titi"=>$_GET['Member_ID']]);

       header("Location: backOffice.php"); 
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
