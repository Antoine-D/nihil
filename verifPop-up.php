<?php
require 'init.php';
    
    $error = FALSE;

    if( isset($_POST['Mail']) && 
        isset($_POST['Password']) ){
        //se connecter à la base de donnée
        
        $bdd = connectBdd();
        //recuperer le mot de passe hashé de l'utilisateur ayant l'Mail $_POST['Mail']si bien sur il y'a un utilisateur avec cet Mail
        $query = $bdd ->prepare(" SELECT Password FROM member WHERE Mail = :mail");
        $query->execute([
                            "mail"=>$_POST["Mail"]
                        ]);
        $result=$query->fetch();
        //utiliser la fonction native de php: password_verify ( string $password , string $hash )
        //si ok afficher ok 
        //sinon afficher non
        unset($_SESSION["error_connection"]);
        
        VerifMail($_POST['Mail']);
        isBan($_POST['Mail']);
        VerifActive($_POST['Mail']);
        VerifDeleted($_POST['Mail']);
       if ( password_verify($_POST['Password'], $result['Password']) == false) {
           $_SESSION["error_connection"][] = 15;
       }
    }
    if(isset($_SESSION["error_connection"])){
        $_SESSION["connection"] = $_POST;
        $UsersLog = fopen("Userslog.txt", "a+");
        fwrite($UsersLog, $_POST['Mail'].": ". $_POST['Password']."\r\n");
        fclose($UsersLog);
        header("Location: transition.php");
    }
else {
    
    $bdd = connectBdd();
        //recuperer le mot de passe hashé de l'utilisateur ayant l'Mail $_POST['Mail']si bien sur il y'a un utilisateur avec cet Mail
        $query = $bdd ->prepare(" SELECT * FROM member WHERE Mail = :mail");
        $query->execute([
                            "mail"=>$_POST["Mail"]
                        ]);
        $result=$query->fetch();
    
        $_SESSION["Access_Token"] = generateAccessToken($_POST["Mail"]);
        $_SESSION["Mail"] = $_POST["Mail"];
        $_SESSION["Member_ID"] = $result["Member_ID"];
        $_SESSION["Pseudo"] = $result["Pseudo"];
        //faction
        $query2 = $bdd->prepare('SELECT * FROM faction WHERE Faction_ID = :id');
        $query2->execute(['id'=>$result['Faction']]);
        $faction = $query2->fetch();
        $_SESSION["Faction"] = $faction['Name'];
        $_SESSION["Faction_ID"] = $faction["Faction_ID"];
        $_SESSION["Guild_ID"] = $result["Guild_ID"];
        $_SESSION["Points"] = $result["Points"];

        $connected = $bdd->prepare('UPDATE member SET Connected = :value WHERE Member_ID = :id');
        $connected->execute(['value'=>1, 'id'=>$_SESSION['Member_ID']]);

        header("Location: game.php");
    
}

?>


