<?php
    require 'init.php';
    if(isConnected()) {
        $bdd = connectBdd();
        $query  = $bdd->prepare("SELECT ressources_date, option_holidays FROM member WHERE Member_ID = :member");
        $query2 = $bdd->prepare("SELECT building_level, id_type FROM buildings_own WHERE id_member = :member");
        $query3 = $bdd->prepare("SELECT amount, id_ressource FROM building_generation WHERE building_type = :type AND building_level = :level");
        $query4 = $bdd->prepare("UPDATE ressources_own SET amount = amount + :value WHERE id_member = :member AND id_ressource = :ressource");
        $query5 = $bdd->prepare("UPDATE member SET ressources_date = :value WHERE Member_ID = :member");

        $query->execute(['member'=>$_SESSION['Member_ID']]);
        $result = $query->fetch();

        $query2->execute(['member'=>$_SESSION['Member_ID']]);
        while($result2 = $query2->fetch()) {
            if($result2['id_type'] < 5 && !$result['option_holidays']) {
	            $query3->execute(['type'=>$result2['id_type'], 'level'=>$result2['building_level']]);
	            while($result3 = $query3->fetch()) {
                    $a[$result2['id_type']] = $result3['amount'];
                    if(isset($_GET['a'])) {
                        if(!$_GET['a']) {
                            $time = time_diff($result['ressources_date']);
                        }else{
                            $time = 1;
                            $value = 1;
                        }
                        $query4->execute(['value'=>$result3['amount']*$time, 'member'=>$_SESSION['Member_ID'], 'ressource'=>$result3['id_ressource']]);
                    }
    	        }
            }
        }
        $query7 = $bdd->prepare("   SELECT ressources_own.amount, ressources.Name, ressources.image
                                    FROM ressources_own, ressources, member
                                    WHERE member.Member_ID = :id AND ressources.Ressources_ID = :value AND ressources_own.id_member = :id AND ressources_own.id_ressource = :value");
        echo "<div class='container-fluid'>
                <div class='row'>";
            for($i=1 ; $i <= 4 ; $i++) {
                $query7->execute([
                                    "id"=>$_SESSION['Member_ID'],
                                    "value"=>$i
                                ]);

                while($result7 = $query7->fetch()) {
                    echo "<div class='col-xs-3 style-ressource' style='color : white;'>
                            <div class='inter_style_ressource'>
                                <img src='".$result7['image']."' class='logo2'> ".$result7['amount']." ".$result7['Name'];
                            if($a[$i] != NULL) {
                                echo " (+".$a[$i].")";
                            }
                    echo "  </div>
                        </div>";
                }
            }
            echo "</div>
            </div>";
        $query5->execute(['value'=>date('Y-m-d H-i-s'), 'member'=>$_SESSION['Member_ID']]);
    }
?>
