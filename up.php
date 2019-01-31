<?php
require 'init.php';

$heure = time();
$heure = date("H:i:s", $heure);

$ressource[1] = 0; // GOLD
$ressource[2] = 0; // BOIS
$ressource[3] = 0; // IRON
$ressource[4] = 0; // SCIENCE

if(isConnected()) {
    $bdd = connectBdd();
    if(isset($_GET['id'])) {
        if(!construction($_GET['id'])) {
            for($i = 1 ; $i < 4 ; $i++) {     // FOR POUR LES DIFFERENTS ID DE RESSOURCES
                $query = $bdd->prepare("SELECT ressources_own.amount 
                                        FROM ressources_own, ressources, member
                                        WHERE member.Member_ID = :member_id
                                            AND Ressources_ID = :ressource_id
                                            AND ressources_own.id_member = member.Member_ID
                                            AND ressources_own.id_ressource = Ressources_ID");
                $query->execute([
                    "member_id"=>$_SESSION['Member_ID'],            // SELECTIONNE LE MONTANT DE TOUTES LES RESSOURCES D'UN JOUEUR
                    "ressource_id"=>$i
                ]);
                $result = $query->fetch();
                $ressource[$i] = $result['amount'];
            }

            $query8 = $bdd->prepare("SELECT id_type, building_level FROM buildings_own WHERE id_member = :member_id AND id_type = :type");
            $query8->execute([
                "member_id"=>$_SESSION['Member_ID'],
                "type"=>$_GET['id']
            ]);
            $res8 = $query8->fetch();
            $newLevel = $res8['building_level'] + 1; // ON AJOUTE 1 AU LEVEL

            $request = $bdd->prepare("SELECT construction_time FROM buildings_levels WHERE Level = :lvl");
            $request->execute([
                "lvl"=>$newLevel        // SELECTIONNE LE TEMPS DE CONSTRUCTION
            ]);
            $res = $request->fetch();


            $import = $bdd->prepare("INSERT INTO buildings_construction
                                     VALUES (:value, :member, :id, :start)");
            $import->execute([
                "value"=>$res['construction_time'],
                "member"=>$_SESSION['Member_ID'],              // INSERE UN NOUVEAU UP DANS LA TABLE DE CONSTRUCTION
                "id"=>$_GET['id'],
                "start"=> $heure
            ]);


            
            $query3 = $bdd->prepare("SELECT Needed_wood, Needed_gold, Needed_iron FROM buildings_levels WHERE Level = :lvl AND building_id = :building");
            $query3->execute([
                "lvl"=>$newLevel,              // SELECTIONNE LE PRIX DU NIVEAU SUPERIEUR
                "building"=>$_GET['id']
            ]);
            $result3 = $query3->fetch();

            
            $gold = $ressource[1] - $result3[1];
            $wood = $ressource[2] - $result3[0];
            $iron = $ressource[3] - $result3[2];
            
            $_SESSION["Points"] += (($result3[2] / 100) + ($result3[1] / 130) + ($result3[0] / 150));
            
            $queryPoint = $bdd->prepare("UPDATE member SET Points = :points WHERE Member_ID = :id");
            $queryPoint->execute([
                "points"=>$_SESSION["Points"],
                "id"=>$_SESSION['Member_ID']
            ]);
            
            $query10 = $bdd->prepare("UPDATE ressources_own SET amount = :amount WHERE id_ressource = :ressource AND id_member = :member_id");
            $query10->execute([
                "amount"=>$gold,
                "ressource"=>1,
                "member_id"=>$_SESSION['Member_ID']
            ]);
            $query11 = $bdd->prepare("UPDATE ressources_own SET amount = :amount WHERE id_ressource = :ressource AND id_member = :member_id");
            $query11->execute([
                "amount"=>$wood,
                "ressource"=>2,
                "member_id"=>$_SESSION['Member_ID']
            ]);
            $query12 = $bdd->prepare("UPDATE ressources_own SET amount = :amount WHERE id_ressource = :ressource AND id_member = :member_id");
            $query12->execute([
                "amount"=>$iron,
                "ressource"=>3,
                "member_id"=>$_SESSION['Member_ID']
            ]);
        }
    }else{
        for($i=1 ; $i < 4 ; $i++) {     // FOR POUR LES DIFFERENTS ID DE RESSOURCES
            $queryRessource = $bdd->prepare("SELECT ressources_own.amount, ressources.image
                                             FROM ressources_own, ressources, member
                                             WHERE Member_ID = :member_id
                                                AND Ressources_ID = :ressource_id
                                                AND ressources_own.id_member = Member_ID
                                                AND ressources_own.id_ressource = Ressources_ID");
            $queryRessource->execute([
                "member_id"=>$_SESSION['Member_ID'],  // SELECTIONNE LE MONTANT DE TOUTES LES RESSOURCES D'UN JOUEUR
                "ressource_id"=>$i
            ]);
            $resultRessource = $queryRessource->fetch();
            $ressource[$i] = $resultRessource['amount'];
            $picture[$i] = $resultRessource['image'];
        }

        if($_GET['category'] == 10) {
            $min = 1;
        }else{
            if($_GET['category'] == 20) {
                $min = 10;
            }else{
                if($_GET['category'] == 30) {
                    $min = 20;
                }
            }
        }
        $result = $bdd->prepare("SELECT * FROM buildings_types WHERE id < :max AND id >= :min");   
        $result->execute(['max'=>$_GET['category'], 'min'=>$min]);
        $i=0;
        while($data = $result->fetch()) {
            $i++;
            $query = $bdd->prepare("SELECT building_level FROM buildings_own WHERE id_member = :id AND id_type = :building");
            $query->execute([
                "id"=>$_SESSION['Member_ID'],
                "building"=>$data['id']
            ]);
            $data2 = $query->fetch();

            $query2 = $bdd->prepare("SELECT Needed_wood, Needed_gold, Needed_iron
                                     FROM buildings_levels, buildings_types
                                     WHERE Level = :lvl AND building_id = buildings_types.id"); 
            $query2->execute([
                "lvl"=>$data2['building_level'] + 1
            ]);
            $data3 = $query2->fetch();
            echo "
            <tr>
                <td class='td-img'><img src='".$data['image']."' class='logo'></td>
                <td class='td-desc'>".$data['name']." Niveau ".$data2['building_level']."<br> Prix niveau suivant : <img src='".$picture[1]."' class='logo2'> ".$data3['Needed_gold']."  <img src='".$picture[2]."' class='logo2'> ".$data3['Needed_wood']."  <img src='".$picture[3]."' class='logo2'> ".$data3['Needed_iron'];
            $time = $bdd->prepare("SELECT construction_start, construction_time
                                   FROM buildings_construction
                                   WHERE id_member = :member AND id_buildings = :building");
            $time->execute(['member'=>$_SESSION['Member_ID'], 'building'=>$data['id']]);
            if($time_result = $time->fetch()) {

                $current = date_create(date()); //prend la valeur de l'heure actuelle et la met en format date
                $date = date_create($time_result['construction_start']); //transforme la date récupérée en BDD en format date
                $time = date_diff($current, $date); //calcul la différence des deux
                $time = $time->format('%Y-%m-%d %H:%i:%s'); //retourne le résultat en format string
                $current = strtotime($time)-943916400; //permet de convertir un string en secondes uniquement
                
                $time = strtotime($time_result['construction_time'])-strtotime(gmdate('H:i:s', '00:00:00'));
                if($current <= $time) {
                    echo "<div id='time_display'> Progression : ".$current." / ".$time."</div>";
                }else{
                    $time2 = $bdd->prepare('DELETE FROM buildings_construction WHERE id_member = :member AND id_buildings = :building');
                    $time2->execute(['member'=>$_SESSION['Member_ID'], 'building'=>$_GET['category']-10+$i]);
                    
                    $query9 = $bdd->prepare("UPDATE buildings_own SET building_level = building_level+1 WHERE id_type = :building AND id_member = :member_id");
                    $query9->execute([
                        "building"=>$data['id'],
                        "member_id"=>$_SESSION['Member_ID']
                    ]);
                }
            }
            echo "  </td>
                <td id=".$data['name'].">";
            if( $data3['Needed_iron'] > $ressource[3] || 
                $data3['Needed_gold'] > $ressource[1] || 
                $data3['Needed_wood'] > $ressource[2] || 
                $data2['building_level'] == 10        || 
                !VerifHolidays() || 
                construction($data['id'])) {
                echo "<button class='btn btn-success disabled'>UP</button>";
            }else{
                if( $data3['Needed_iron'] <= $ressource[3] && 
                    $data3['Needed_gold'] <= $ressource[1] && 
                    $data3['Needed_wood'] <= $ressource[2] && 
                    $data2['building_level'] < 10) {

                    echo "<a class='btn btn-success' onclick='build(".$_GET['category'].", ".$data['id'].")'>UP</a>";
                }

            }
            echo "  
                </td>
            </tr>";
        }
    }
}else{
    echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}
?>