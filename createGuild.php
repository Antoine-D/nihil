<?php

require 'init.php';

$error = FALSE;

if ( isset($_POST["guildName"]) &&
     isset($_POST["tag"]) &&
     isset($_FILES['logo'])
   ){
    
    $_POST["tag"] = strtoupper(trim($_POST["tag"]));
     
    unset($_SESSION["error_guild"]);
    
    VerifTag($_POST["tag"]); // verification de la validité du tag
    VerifGuildName($_POST["guildName"]);  // verification de la validité du nom de guilde
}


$dossier = '/logo_users';
$name = $_FILES['logo']['name'];
$nom = "logo_users/{$name}.{$extension}";
$fichier = basename($_FILES['logo']['name']);
$taille_maxi = 1000000000000000;
$taille = filesize($_FILES['logo']['tmp_name']);
$extension = strrchr($_FILES['logo']['name'], '.');

VerifImgExt($_FILES['logo']['name'], $extension);
VerifImgSize ( $taille, $taille_maxi);

if(!isset($_SESSION["error_guild"])) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     //$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     var_dump($nom ); die;
     if(move_uploaded_file($_FILES['logo']['tmp_name'], $nom)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          unset ($_FILES);
         header("Location: guild.php");
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
         print_r($_FILES);
     }
}


if(isset($_SESSION["error_guild"])){
    $_SESSION["guild"] = $_POST;
    header("Location: verifGuild.php");
}
else{
    $bdd = connectBdd();

    $request = $bdd->prepare("INSERT INTO guild (Logo, Number_Players, Faction, Chief, Tag, Name, Points)
    VALUES (:Logo, :Nbr, :Faction, :Chief, :Tag, :Name, :Points )");
    
    $Nbr = 1;
    
    $nbimg = 3;
    /*$img[1] = "logo/pyramide.png";
    $img[2] = "logo/pharaon.png";
    $img[3] = "logo/ra.png";
    
    
    srand((double)microtime()*1000000);
    $affimg=rand(1,$nbimg);
    
    $img = $img[$affimg];*/
     
    $Faction = $_SESSION["Faction_ID"];
    $Chief = $_SESSION["Member_ID"];
    $point = $_SESSION["Points"];
    
    $request->execute([
        "Logo"=>$nom,
        "Nbr" => $Nbr,
        "Faction" => $Faction,
        "Chief" => $Chief,
        "Tag" => $_POST["tag"],
        "Name" => $_POST["guildName"],
        "Points" => $point
    ]);
    
    $query2 = $bdd ->prepare(" SELECT * FROM guild WHERE Name = :Name ");
    $query2->execute(["Name"=>$_POST["guildName"]]);
    $result=$query2->fetch();
    $id = $result['Guild_ID'];
    $_SESSION['Guild_ID'] = $result['Guild_ID'];
   
    $query = $bdd->prepare("UPDATE member SET Guild_Rank = 5,Guild = 1, Guild_ID = :id WHERE Member_ID = :member");
    $query->execute([
        "id"=> $id,
        "member"=>$_SESSION['Member_ID']
    ]);
header("Location: guild.php");
}