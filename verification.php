<?php
require 'init.php';
echo"<meta charset='utf-8'>";

if( !isset($_GET["Access_Token"]) || strlen($_GET['Access_Token'])!=32){
    die("Error");
}

if(accesstokenExist($_GET["Access_Token"])){
    $bdd = connectBdd();
    $query = $bdd ->prepare("UPDATE member SET Active=1 WHERE Access_Token = :Access_Token");
    $query->execute(["Access_Token"=>$_GET["Access_Token"]]);
    echo "Votre compte a bien été activé ! Cliquer <a href='index.php'>ici pour retourner sur le site</a>";
}
//sinon die("error")
else{
    die("Error");
}