<?php
require 'init.php';

if(isConnected()){
	$bdd = connectBdd();
	$query = $bdd->prepare('UPDATE member SET Deleted = 1 WHERE Member_ID=:Member_ID');
	$query->execute(["Member_ID"=>$_SESSION['Member_ID']]);
	logout();
}