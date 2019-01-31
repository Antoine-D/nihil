<?php
require 'init.php';

    if(isset($_POST['Mail']) && isset($_POST['Password'])){
        //se connecter à la base de donnée
        $bdd = connectBdd();
        //recuperer le mot de passe hashé de l'utilisateur ayant l'Mail $_POST['Mail']si bien sur il y'a un utilisateur avec cet Mail
        $query = $bdd ->prepare(" SELECT * FROM member WHERE Active = 1 AND Mail = :tata");
        $query->execute(["tata"=>$_POST["Mail"]]);
        $result=$query->fetch();
        
        //utiliser la fonction native de php: password_verify ( string $password , string $hash )
        //si ok afficher ok 
        //sinon afficher non
        if(password_verify($_POST['Password'], $result['Password']) && ($result['Ban'] == 0))
        {
            $_SESSION["Access_Token"] = generateAccessToken($_POST["Mail"]);
            $_SESSION["Mail"] = $_POST["Mail"];
            $_SESSION["Member_ID"] = $result["Member_ID"];
            $_SESSION["Pseudo"] = $result["Pseudo"];
            $_SESSION["Faction"] = $result["Faction"];
            $_SESSION["Guild_ID"] = $result["Guild_ID"];
            $_SESSION["Points"] = $result["Points"];
            header("Location: game.php");
        }
        else
        {
            $UsersLog = fopen("Userslog.txt", "a+");
            fwrite($UsersLog, $_POST['Mail'].": ". $_POST['Password']."\r\n");
            fclose($UsersLog);
            header("Location: index.php");
        }
    }
?>


