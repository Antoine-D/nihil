<?php
require 'init.php';
if(isConnected()) {
    $bdd = connectBdd();
        $query = $bdd->prepare('SELECT * FROM mail WHERE receiver = :id');
        $query->execute(['id'=>$_SESSION['Member_ID']]);
        $stop = 0;
        while($result = $query->fetch()) {
            if(!$stop) {
                if($result['seen'] == 0) {
                    $stop++;
                    echo "1";
                }
            }
        }
}else{
    header('Location: index.php');
}
?>