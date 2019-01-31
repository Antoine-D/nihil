<?php

require 'init.php';

if (isConnected() ){
        if ( isGuildChief() ){

            $bdd = connectBdd();

            $request = $bdd->prepare("SELECT Guild_Rank FROM member WHERE Pseudo = :Pseudo");
            $request->execute(["Pseudo"=>$_GET["Pseudo"]]);
            $result = $request->fetch();

            if ( $result['Guild_Rank'] < 4){

            $rank = $result['Guild_Rank'] + 1;

            $query = $bdd->prepare("UPDATE member set Guild_Rank= :rank WHERE Pseudo=:titi ");
            $query->execute (["titi"=>$_GET["Pseudo"],
                              "rank"=>$rank]);

            }

            header("Location: guild.php");
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
