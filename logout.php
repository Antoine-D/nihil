<?php 
	require "init.php";

    $time = time();
    $last = date('Y-M-D-H-i-s', $time);

    $bdd = connectBdd() ;
    $query = $bdd->prepare("UPDATE member SET Last_Connexion = :actual_date, Connected = :value WHERE Member_ID = :id");
    $query->execute([
        "actual_date"=>$last,
        "value"=>0,
        "id"=>$_SESSION['Member_ID']
    ]);

logout();