<?php

require 'init.php';

if ( isConnected() ){
    if ( isAdmin() ){

        $bdd = connectBdd();

        $query = $bdd->prepare("UPDATE member set Privileges=1 WHERE Member_ID=:titi ");
        $query->execute (["titi"=>$_GET['Member_ID']]);

        header("Location: backOffice.php");
    }
    else{
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p>";
        echo "<p class='text-center'>Cliquez <a href='game.php'>ici</a> pour retourner sur la page de jeu.</p>";
    }
}
else {
    echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}