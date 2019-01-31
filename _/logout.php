<?php 
	require "init.php";

    $time = time();
    $last = date('Y-M-D-H-i-s', $time);

    $bdd = connectBdd() ;
    $query = $bdd->prepare("UPDATE member SET Last_Connexion = :titi WHERE Member_ID = :toto");
    $query->execute([
        "titi"=>$last,
        "toto"=>$_SESSION['Member_ID']
    ]);

logout();