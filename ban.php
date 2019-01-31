<?php

require 'init.php';

$bdd = connectBdd();

$query = $bdd->prepare("UPDATE member set Ban=1 WHERE Member_ID=:titi ");
$query->execute (["titi"=>$_GET['Member_ID']]);

header("Location: backOffice.php");