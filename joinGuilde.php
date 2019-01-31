<?php

require 'init.php';

$bdd = connectBdd();

$guild = 1;

$query = $bdd->prepare("UPDATE member SET Guild = :guild, Guild_ID = :guild_id WHERE Member_ID = :id");
$query->execute([
    "guild"=>$guild,
    "guild_id"=>$_GET['Guild_ID'],
    "id"=>$_SESSION['Member_ID']
 ]);
   
$query2 = $bdd->prepare("SELECT * FROM guild WHERE Guild_ID = :guild_id");
$query2->execute([
    "guild_id"=>$_GET['Guild_ID']
]);
$result2 = $query2->fetch();

$number = $result2['Number_Players'] +1 ;

$request = $bdd->prepare("UPDATE guild SET Number_Players = :titi, Points = :points WHERE Guild_ID = :guild_id");
$request->execute([
    "titi"=>$number,
    "points"=>$result2['Points']+$_SESSION['Points'],
    "guild_id"=>$_GET['Guild_ID']
]);

$_SESSION['Guild_ID'] = $_GET['Guild_ID'];

header("Location: guild.php");