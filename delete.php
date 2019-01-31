<?php

require "init.php";

if (isConnected()){
        if (isAdmin()){
            $bdd = connectBdd();
            if(isset($_GET['Member_ID']) && isset($_SESSION['Access_Token'])) {
                if($_GET['Member_ID'] != $_SESSION['Member_ID']) { //vérification que la cible n'est pas l'utilisateur lui-même
                    $msg = $bdd->prepare("DELETE FROM mail WHERE receiver = :id || sender = :id"); //suppression de tous les message que la cible à envoyé ou reçu
                    $msg->execute(['id'=>$_GET['Member_ID']]);

                    $ressource = $bdd->prepare("DELETE FROM ressources_own WHERE id_member = :id"); //suppression de ses ressources
                    $ressource->execute(['id'=>$_GET['Member_ID']]);

                    $building = $bdd->prepare("DELETE FROM buildings_own WHERE id_member = :id"); //suppresion de ses bâtiments
                    $building->execute(['id'=>$_GET['Member_ID']]);

                    $inhabitant = $bdd->prepare("DELETE FROM inhabitants_own WHERE id_member = :id"); //suppresion de ses habitants
                    $inhabitant->execute(['id'=>$_GET['Member_ID']]);

                    $member = $bdd->prepare("DELETE FROM member WHERE Member_ID = :id"); //suppresion du compte
                    $member->execute([ "id"=>$_GET['Member_ID']]);
                }
            }
            header("Location: backOffice.php");
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