<?php

require 'init.php';
if ( isConnected() ){
    
    $bdd = connectBdd() ;
    
    $query = $bdd->prepare("SELECT id_building, amount FROM buildings_own WHERE Member_ID = :toto");
    $query->execute(["toto"=>$_SESSION['Member_ID']]);
    $result = $query->fetch();
    
    $query2 = $bdd->prepare("SELECT production_per_hour, id_type FROM buildings WHERE id =: titi");
    $query2->execute(["titi"=>$result['id_building']]);
    $result2 = $query2->fetch();
    
    
    if ( $result2['id_type'] == 1){
        $ressouce = 1;
    }
    
    $time = time();
    $heure = date('Y-m-d' , $time);
    
    
    for ( $i = 0; $heure < $heure + 1; $i++){
    $prod = ( $result2['production_per_hour'] / 3600 ) * $result['amount'];
    }
    echo $prod;
}

?>
