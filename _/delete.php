<?php

require "init.php";

if ( isConnected() ){
        if ( isAdmin() ){
            
            // Verifier que l'user soit connecté

            if ( isConnected()){

                $bdd = connectBdd();

                $query = $bdd->prepare("DELETE from member WHERE Member_ID=:titi AND Access_Token<>:tutu");
                $query->execute([ "titi"=>$_GET['Member_ID'], "tutu"=>$_SESSION["Access_Token"] ] );

            }
            // Si oui supprimer le compte sur lequel on a cliqué
            // a condition qu'il ne sagisse pas de moi
            header("Location: backOffice.php");
            // rediriger sur la home
        }
        else {
                echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
                echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
            }
    }
    else {
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
        echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
    }
?>