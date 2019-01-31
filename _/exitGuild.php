<?php

require 'init.php';

    if ( isConnected() ){
    $bdd = connectBdd();

    $query2 = $bdd->prepare("SELECT * FROM guild WHERE Guild_ID = :guild_id");
    $query2->execute([
        "guild_id"=>$_SESSION['Guild_ID']
    ]);
    $result2 = $query2->fetch();

    $number = $result2['Number_Players'] - 1 ;

    $request = $bdd->prepare("UPDATE guild SET Number_Players = :titi WHERE Guild_ID = :guild_id");
    $request->execute([
        "titi"=>$number,
        "guild_id"=>$_SESSION['Guild_ID']
    ]);

    $query = $bdd->prepare("UPDATE member SET Guild = 0, Guild_ID = 0, Guild_Rank = 1 WHERE Member_ID = :id");
    $query->execute(["id"=>$_SESSION['Member_ID']
     ]);

    header("Location: game.php");
    }
else {
    echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}