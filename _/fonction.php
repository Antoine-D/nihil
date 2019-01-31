<?php

function connectBdd(){
    try{
        $bdd = new PDO("mysql:dbname=".BDDNAME.";host=".BDDHOST ,BDDUSER ,BDDPWD );
    }catch(Exception $e){
        die("Erreur : ".$e->getMessage());
    }
    return $bdd;
}

function accesstokenExist($access_token){
    $bdd = connectBdd();
    
    //Préparer la requête
    $query = $bdd ->prepare(" SELECT * FROM member WHERE Access_Token = :Access_Token ");
    $query->execute(["Access_Token"=>$access_token]);
    $result=$query->fetch();
    if(empty($result)){
        return false;
    }
    else{
        return true;
    }
}

function emailExist($email){

    //connexion à la base de données
    
    $bdd = connectBdd();
    
    //Préparer la requête
    $query = $bdd ->prepare(" SELECT * FROM member WHERE Mail = :tata");
    $query->execute(["tata"=>$email]);
    $result=$query->fetch();
    
    if(!empty($result)){
        $_SESSION["error_subscription"][]=7;
        return false;
    }
    else{
        return true;
    }
}

function pseudoExist($pseudo){

    //connexion à la base de données
    
    $bdd = connectBdd();
    
    //Préparer la requête
    $query = $bdd ->prepare(" SELECT * FROM member WHERE Pseudo = :titi");
    $query->execute(["titi"=>$pseudo]);
    $resulte=$query->fetch();
    
    if(!empty($resulte)){
        $_SESSION["error_subscription"][]=8;
        return false;
    }
    else{
        return true;
    }
}

function generateAccessToken($email){
    //générer un accesstoken
    $accesstoken = md5(uniqid());

    //Se connecter à la bdd
    $bdd = connectBdd();
    //Mettre à jour l'utilisateur avec la nouvelle donnée
    $query = $bdd ->prepare(" UPDATE member SET Access_Token=:titi WHERE Mail=:tutu");
    $query->execute(["titi"=>$accesstoken, "tutu"=>$email]);

    return $accesstoken;
}

function isConnected(){
    //vérifier que les variables de sessions existent
    if(!empty($_SESSION["Access_Token"]) && !empty($_SESSION["Mail"])){
        //Si oui se connecter a la base et vérifier qu'un utilisateur correspond
        $bdd = connectBdd();

        $query = $bdd ->prepare(" SELECT  Member_ID FROM member WHERE Mail=:tata AND Access_Token=:Access_Token");
        $query->execute(["tata"=>$_SESSION["Mail"], "Access_Token"=>$_SESSION["Access_Token"]]);
        $result=$query->fetch();
        
        if(!empty($result)){
            $_SESSION['Access_Token'] = generateAccessToken($_SESSION['Mail']);
            return true;
        }
    }
    return false;
}

function isAdmin(){
    //vérifier que les variables de sessions existent
    if(!empty($_SESSION["Access_Token"]) && !empty($_SESSION["Mail"])){
        //Si oui se connecter a la base et vérifier qu'un utilisateur correspond
        $bdd = connectBdd();

        $query = $bdd ->prepare(" SELECT Privileges FROM member WHERE Mail=:tata AND Access_Token=:Access_Token");
        $query->execute(["tata"=>$_SESSION["Mail"], "Access_Token"=>$_SESSION["Access_Token"]]);
        $result=$query->fetch();
        if(!empty($result)){
            if ( ($result[0]) == 3){
            return true;
            }
        }
    }
    return false;
}

function isModo(){
    //vérifier que les variables de sessions existent
    if(!empty($_SESSION["Access_Token"]) && !empty($_SESSION["Mail"])){
        //Si oui se connecter a la base et vérifier qu'un utilisateur correspond
        $bdd = connectBdd();

        $query = $bdd ->prepare(" SELECT Privileges FROM member WHERE Mail=:tata AND Access_Token=:Access_Token");
        $query->execute(["tata"=>$_SESSION["Mail"], "Access_Token"=>$_SESSION["Access_Token"]]);
        $result=$query->fetch();
        if(!empty($result)){
            if ( ($result[0]) == 2){
            return true;
            }
        }
    }
    return false;
}

function isGuildChief(){
     if(!empty($_SESSION["Access_Token"]) && !empty($_SESSION["Mail"])){
        //Si oui se connecter a la base et vérifier qu'un utilisateur correspond
        $bdd = connectBdd();

        $query = $bdd ->prepare(" SELECT Guild_Rank FROM member WHERE Mail=:tata AND Access_Token=:Access_Token");
        $query->execute(["tata"=>$_SESSION["Mail"], "Access_Token"=>$_SESSION["Access_Token"]]);
        $result=$query->fetch();
        if(!empty($result)){
            if ( ($result[0]) == 5){
            return true;
            }
        }
    }
    return false;
}

function rank($rank){
    
if ( ($rank[0]) == 1){
    return "Soldat";
    }
    else {
        if ( ($rank[0]) == 2 ){
            return "Trésorier";
        }
        else {
            if ( ($rank[0]) == 3 ){
            return "Recruteur";
            }
            else {
                if ( ($rank[0]) == 4 ){
                return "Bras Droit";
                }
                else {
                    return "Chef";
                }
            }

        }

    }
} 

function logout(){
    unset($_SESSION['Access_Token']);
    unset($_SESSION["Access_Token"]);
    unset($_SESSION["Mail"]);
    unset($_SESSION["Member_ID"]);
    unset($_SESSION["Pseudo"]);
    unset($_SESSION["Faction"]);
    unset($_SESSION["Guild_ID"]);
    unset($_SESSION["Points"]);
    session_destroy();
    header("Location: index.php");
}

function VerifPseudo($pseudo){
   if( strlen($pseudo) < 2 ){
        $_SESSION["error_subscription"][]=1;
       return false;
    }
    return true;
}

function VerifMailConc($mail, $mailVerif){
    
    if($mail != $mailVerif){
        $_SESSION["error_subscription"][]=5;
        return false;
    }
    return true;
}

function VerifMail($mail){
   if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $_SESSION["error_subscription"][]=2;
        return false;
    }
    return true;
}

function VerifPwdConc( $pwd1, $pwd2){
    
   //les mots de passe doivent être identiques
    if($pwd1 != $pwd2){
        $_SESSION["error_subscription"][]=4;
        return false;
    }
   return true; 
}

function VerifPassword($pwd1){
    //Le mot de passe doit faire entre 8 et 12 caractères
    if( preg_match('#^[A-Z][a-zA-Z- _]{1,}[0-9]#', $pwd1) ){ //  strlen($pwd1) < 5 || strlen($pwd1) > 20
        $_SESSION["error_subscription"][]=3;
        return false;
    }
   return true; 
}

function VerifFaction($faction){
    global $list_of_faction;
    if(!in_array($faction, $list_of_faction)){
        $_SESSION["error_subscription"][]=6;
        return false;
    }
    return true;
}

function isInGuild(){
    //vérifier que les variables de sessions existent
    if(!empty($_SESSION["Access_Token"]) && !empty($_SESSION["Mail"])){
        //Si oui se connecter a la base et vérifier qu'un utilisateur correspond
        $bdd = connectBdd();

        $query = $bdd ->prepare(" SELECT Guild FROM member WHERE Mail=:tata AND Access_Token=:Access_Token");
        $query->execute(["tata"=>$_SESSION["Mail"], "Access_Token"=>$_SESSION["Access_Token"]]);
        $result=$query->fetch();
        if(!empty($result)){
            if ( ($result[0]) == 1){
            return true;
            }
        }
    }
    return false;
}

function TagExist($tag){

    //connexion à la base de données
    
    $bdd = connectBdd();
    
    //Préparer la requête
    $query = $bdd ->prepare(" SELECT * FROM guild WHERE Tag = :titi");
    $query->execute(["titi"=>$tag]);
    $result=$query->fetch();
    
    if(empty($result)){
        return false;
    }
    else{
        return true;
    }
}

function GuildNameExist($guildName){

    //connexion à la base de données
    
    $bdd = connectBdd();
    
    //Préparer la requête
    $query = $bdd ->prepare(" SELECT * FROM guild WHERE Name = :titi");
    $query->execute(["titi"=>$guildName]);
    $result=$query->fetch();
    
    if(empty($result)){
        return false;
    }
    else{
        return true;
    }
}

function VerifTag($tag){
    if( strlen($tag) > 4 ){
        $_SESSION["error_guild"][]=11;
        return false;
    }
    if(TagExist($tag)){
        $_SESSION["error_guild"][]=10;
        return false;
    }
    return true;
}

function VerifGuildName($guildName){
    if(GuildNameExist($guildName)){
        $_SESSION["error_guild"][]=9;
        return false;
    }
    return true;
}

function VerifImgExt ($logo, $extension){
    global $list_of_extensions;
    if(!in_array($extension, $list_of_extensions)) //Si l'extension n'est pas dans le tableau
        {
         $_SESSION["error_guild"][]=12;
         return false;
        }
    return true;
}


function VerifImgSize ($taille, $taille_maxi) {
    if($taille>$taille_maxi)
        {
         $_SESSION["error_guild"][]=13;
         return false;
    }
    return true;
}


function endGame() {
    if(isConnected()) {
        $bdd = connectBdd();
        $query = $bdd->prepare("SELECT player_score, bot_score FROM member WHERE Member_ID = :id");
        $query->execute(['id'=>$_SESSION['Member_ID']]);
        $result = $query->fetch();
        if($result['player_score'] != 3 && $result['bot_score'] != 3) {
            return false;
        }else{
            return true;
        }
    }
}
