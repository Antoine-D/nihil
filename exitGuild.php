<?php

require 'init.php';

    if ( isConnected() ){
    $bdd = connectBdd();

    $query2 = $bdd->prepare("SELECT * FROM guild WHERE Guild_ID = :guild_id");
    $query2->execute([
        "guild_id"=>$_SESSION['Guild_ID']
    ]);
    $result2 = $query2->fetch();
        
    $query3 = $bdd->prepare("SELECT COUNT(Member_ID) FROM member WHERE Guild_ID = :guild_id");
    $query3->execute([
        "guild_id"=>$_SESSION['Guild_ID']
    ]);
    $result = $query3->fetch();
        
    if ( $result["COUNT(Member_ID)"] == 1) {
        $query4 = $bdd->prepare("DELETE FROM guild WHERE Guild_ID = :guild_id");
        $query4->execute([
            "guild_id"=>$_SESSION['Guild_ID']
        ]);
        
        $query = $bdd->prepare("UPDATE member SET Guild = 0, Guild_ID = 0, Guild_Rank = 1 WHERE Member_ID = :id");
        $query->execute(["id"=>$_SESSION['Member_ID']
         ]);
    }
    else {
        
    $number = $result2['Number_Players'] - 1 ;
    $points = $result2['Points'] - $_SESSION['Points'];

    $request = $bdd->prepare("UPDATE guild SET Number_Players = :number, Points = :points WHERE Guild_ID = :guild_id");
    $request->execute([
        "number"=>$number,
        "guild_id"=>$_SESSION['Guild_ID'],
        "points"=>$points
    ]);
        
    $query = $bdd->prepare("UPDATE member SET Guild = 0, Guild_ID = 0, Guild_Rank = 1 WHERE Member_ID = :id");
    $query->execute(["id"=>$_SESSION['Member_ID']
     ]);
    }
        header("Location: game.php");
    }
else {
    echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}