<?php

require 'init.php';

$heure = time();
$heure = date("H:i:s", $heure);
$scienceDebut = 0; // SCIENCE


if(isConnected()) {
    $bdd = connectBdd();
    if(isset($_GET['id'])) {
        if(!ResearchBuild($_GET['id'])) {
            echo "ICI ça passe";
            $query = $bdd->prepare("SELECT ressources_own.amount FROM ressources_own, ressources, member WHERE Member_ID = :member_id AND Ressources_ID = :ressource_id AND ressources_own.id_member = Member_ID AND ressources_own.id_ressource = Ressources_ID");
            $query->execute([
                "member_id"=>$_SESSION['Member_ID'],            // SELECTIONNE LE MONTANT DE SCIENCE D'UN JOUEUR
                "ressource_id"=>4
                ]);
            $result = $query->fetch();
            $scienceDebut = $result['amount'];
            
            $queryExist = $bdd->prepare("SELECT research_type, research_level FROM research_own WHERE id_member = :member_id AND research_type = :type");
            $queryExist->execute([
                "member_id"=>$_SESSION['Member_ID'],
                "type"=>$_GET['id']
            ]);
            $resExist = $queryExist->fetch();
            $newLevel = $resExist['research_level'] + 1; // ON AJOUTE 1 AU LEVEL
            
            $request = $bdd->prepare("SELECT construction_time FROM research WHERE Level = :lvl");
            $request->execute([
                "lvl"=>$newLevel        // SELECTIONNE LE TEMPS DE CONSTRUCTION
            ]);
            $res = $request->fetch();
            
            $import = $bdd->prepare("INSERT INTO research_construction
                                     VALUES (:value, :member, :id, :start)");
            $import->execute([
                "value"=>$res['construction_time'],
                "member"=>$_SESSION['Member_ID'],              // INSERE UN NOUVEAU UP DANS LA TABLE DE CONSTRUCTION
                "id"=>$_GET['id'],
                "start"=> $heure
            ]);
            
            $queryRressSupp = $bdd->prepare("SELECT Needed_science FROM research WHERE Level = :lvl AND research_type = :research");
            $queryRressSupp->execute([
                "lvl"=>$newLevel,              // SELECTIONNE LE PRIX DU NIVEAU SUPERIEUR
                "research"=>$_GET['id']
            ]);
            $resultRressSupp = $queryRressSupp->fetch();
            
            $scienceDebut = $scienceDebut - $resultRressSupp['Needed_science'];
            
            $_SESSION['Points'] += $resultRressSupp['Needed_science'] / 50;
            
            $queryPoint = $bdd->prepare("UPDATE member SET Points = :points WHERE Member_ID = :id");
            $queryPoint->execute([
                "points"=>$_SESSION["Points"],
                "id"=>$_SESSION['Member_ID']
            ]);
            
            $query10 = $bdd->prepare("UPDATE ressources_own SET amount = :amount WHERE id_ressource = :ressource AND id_member = :member_id");
            $query10->execute([
                "amount"=>$scienceDebut,
                "ressource"=>4,
                "member_id"=>$_SESSION['Member_ID']
            ]);
        }
    }else {
        echo " Et là ??";
        $queryRessource = $bdd->prepare("SELECT ressources_own.amount, ressources.image FROM ressources_own, ressources, member
        WHERE Member_ID = :member_id
        AND Ressources_ID = :ressource_id
        AND ressources_own.id_member = Member_ID
        AND ressources_own.id_ressource = Ressources_ID");
        $queryRessource->execute([
            "member_id"=>$_SESSION['Member_ID'],  // SELECTIONNE LE MONTANT DE TOUTES LES RESSOURCES D'UN JOUEUR
            "ressource_id"=>4
        ]);
        $resultRessource = $queryRessource->fetch();
        $scienceDebut = $resultRessource['amount'];
        $picture = $resultRessource['image'];
        
         $result = $bdd->prepare("SELECT * FROM research_types");   
        $result->execute();
        
        $i = 0;
        while( $data = $result->fetch() ){
            $i++;
            $query = $bdd->prepare("SELECT research_level FROM research_own WHERE id_member = :id AND research_type = :type");
            $query->execute([
                "id"=>$_SESSION['Member_ID'],
                "type"=>$data['id']
            ]);
            $data2 = $query->fetch();
            
            $query2 = $bdd->prepare("SELECT Needed_science
                                     FROM research, research_types
                                     WHERE Level = :lvl AND research_type = research_types.id"); 
            $query2->execute([
                "lvl"=>$data2['research_level'] + 1
            ]);
            $data3 = $query2->fetch();
            echo "
            <tr>
                <tr>
                <td class='td-img'><img src=".$data['image']." class='logo'></td>
                <td class='td-desc'>Nom : ".$data['Name']." Niveau : ".$data2['research_level']."<br> Prix niveau suivant : <img src=".$resultRessource['image']." class='logo2'> ".$data3['Needed_science'];
            
            $time = $bdd->prepare("SELECT construction_start, construction_time FROM research_construction WHERE id_member = :member AND research_type = :type");
            $time->execute(["member"=>$_SESSION['Member_ID'],
                           "type"=>$data['id']]);
            if ( $time_result = $time->fetch() ) {
                
                $current = date_create(date()); //prend la valeur de l'heure actuelle et la met en format date
                $date = date_create($time_result['construction_start']); //transforme la date récupérée en BDD en format date
                $time = date_diff($current, $date); //calcul la différence des deux
                $time = $time->format('%Y-%m-%d %H:%i:%s'); //retourne le résultat en format string
                $current = strtotime($time)-943916400; //permet de convertir un string en secondes uniquement

                $time = strtotime($time_result['construction_time']) - strtotime(gmdate('H:i:s', '00:00:00'));
                if ( $current <= $time ) {
                    echo "<div> Progression : ".$current." / ".$time."</div>";
                }else{
                    $time2 = $bdd->prepare("DELETE FROM research_construction WHERE id_member = :member AND research_type = :type");
                    $time2->execute(["member"=>$_SESSION['Member_ID'],
                                    "type"=>$i]);
                    $query9 = $bdd->prepare("UPDATE research_own SET research_level = research_level + 1 WHERE research_type = :type AND id_member = :member");
                    $query9->execute([
                        "type"=>$data['id'],
                        "member"=>$_SESSION['Member_ID']
                    ]);
                }
            }
             echo "</td>
                <td id=".$data['Name'].">";
            if ( $data3['Needed_science'] > $scienceDebut ||
               $data2["research_level"] == 10 ||
               !VerifHolidays() ||
               ResearchBuild($data['id']) ) {
                   echo "<button class='btn btn-success disabled'>UP</button>";
            }else{
               if ( $data3['Needed_science'] <= $scienceDebut &&
                    $data2["research_level"] < 10 ){

                   echo "<a class='btn btn-success' onclick='search1(".$data['id'].")'>UP</a>";
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










