<?php
date_default_timezone_set('Etc/UTC');
require "init.php";
require'PHPMailer/class.phpmailer.php';
//require 'recaptchalib.php';

$sitekey = '6Lc83x0TAAAAAPwNza21SUpT-reTvyp7nPUBW-pg';
$secret = '6Lc83x0TAAAAABqFcB6axJD5KVjDi5-uWU-kGQ66';
 
 $error = FALSE;
 
if(  isset($_POST['lastname']) &&
     isset($_POST['password']) &&  
     isset($_POST['passwordverif']) &&  
     isset($_POST['mail']) &&  
     isset($_POST['emailverif']) &&  
     isset($_POST['Faction']) &&  
     isset($_POST['cgu']) 
    // isset($_POST["captcha"])) {
    ) {
   
    //Fonctions : strlen, filter_var, isset, in_array, trim
    
    $_POST['Pseudo']=trim($_POST['Pseudo']);
    $_POST['Mail']=strtolower(trim($_POST['Mail']));
    
    unset($_SESSION["error_subscription"]);
    
    /*if(!filter_var($_POST['Mail'], FILTER_VALIDATE_EMAIL)){
        $error = TRUE;
        $_SESSION["error_subscription"][]=2;
    }*/
    VerifPseudo ( $_POST['Pseudo']);
    VerifMail($_POST['Mail']);
    VerifCaptcha($_POST['captcha']);
    VerifPassword($_POST['Password']);
    VerifPwdConc ( $_POST['Password'], $_POST['passwordverif']);
    VerifMailConc ( $_POST['Mail'], $_POST['emailverif']);   
    VerifFaction ( $_POST['Faction']);
    emailExist ( $_POST['Mail']);
    pseudoExist($_POST['Pseudo']);
     
}
if(isset($_SESSION["error_subscription"])) {
    $_SESSION["subscription"] = $_POST;
    header("Location: subscription.php");
}else{
    $bdd = connectBdd();

    $access_token=md5(uniqid());
    

    $query = $bdd->prepare("INSERT INTO member (Pseudo, Password, Mail, Faction, Access_Token, Privileges, Ban) 
                            VALUES (:titi, :tutu, :tata, :toto, :Access_Token, :Privileges, :Ban)");

    $mdp=password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $query->execute([
                        "titi"=>$_POST['Pseudo'],
                        "tutu"=>$mdp,
                        "tata"=>$_POST['Mail'],
                        "toto"=>$_POST['Faction'],
                        "Access_Token"=>$access_token,
                        "Privileges"=>1,
                        "Ban"=>0
                    ]);


    $select = $bdd->prepare("SELECT Member_ID FROM member WHERE Pseudo = :pseudo");
    $select->execute(['pseudo'=>$_POST['Pseudo']]);
    $result = $select->fetch();

    for($i=1 ; $i < 6 ; $i++) {
        $query4 = $bdd->prepare("INSERT INTO ressources_own VALUES (:value, :id1, :id2)");
        $query4->execute([
                            "value"=>10000,
                            "id1"=>$i,
                            "id2"=>$result['Member_ID']
                        ]);
    }

    $Idtab = [1,2,3,4,5,6,10,11,20,21,22]; 
    
    for($i=0 ; $i < 11 ; $i++) {
        $query5 = $bdd->prepare("INSERT INTO buildings_own VALUES (:id1, :id2, :value)");
        $query5->execute([
                            "value"=>0,
                            "id1"=>$Idtab[$i],
                            "id2"=>$result['Member_ID']

                        ]);
    }
    
    for($i=0 ; $i < 4 ; $i++) {
        $query5 = $bdd->prepare("INSERT INTO research_own VALUES (:id1, :id2, :value)");
        $query5->execute([
                            "value"=>0,
                            "id1"=>$i,
                            "id2"=>$result['Member_ID']

                        ]);
    }

    for($i=1 ; $i < 9 ; $i++) {
        $query6 = $bdd->prepare("INSERT INTO inhabitants_own VALUES (:value, :id1, :id2)");
        $query6->execute([
                            "value"=>0,
                            "id1"=>$i,
                            "id2"=>$result['Member_ID']

                        ]);
    }

    
    
    /* $url= "http://".$_SERVER['HTTP_HOST']."/verification.php?Access_Token=".$access_token;
    echo $url; */

    $mail = new PHPMailer();
    $mail->Host = 'http://www.nihil-game.fr/';
    $mail->SMTPAuth   = false;
    $mail->Port = 25; // Par défaut
    $mail->CharSet = "utf-8";
    $mail->AccessToken = $access_token;
    // Expéditeur
    $mail->SetFrom('nihil.staff@gmail.com');
    // Destinataire
    $mail->AddAddress($_POST['Mail']);
    // Objet
    $mail->Subject = 'Inscription sur Nihil-games.fr';

    // Votre message
    $mail->MsgHTML('Merci de vous être inscrit !
    
    Veuillez valider votre compte en cliquant sur le lien ci-dessous !
    
    <a>http://www.nihil-game.fr/verification.php?Access_Token='.$access_token.'</a>');

    // Envoi du mail avec gestion des erreurs
    if(!$mail->Send()) {
      echo 'Erreur : ' . $mail->ErrorInfo;
    }else{
?> 
          <meta charset="utf-8">
          <p>Un Email de confirmation vous a été envoyé pour valider votre compte.</p>
          <meta http-equiv="refresh" content="5;index.php">
<?php
    }
}
