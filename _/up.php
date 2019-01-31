<?php

$heure = time();
$heure = date("H:i:s", $heure);

$ressource[1]; // GOLD
$ressource[2]; // BOIS
$ressource[3]; // IRON
$ressource[4]; // SCIENCE

$i = 0;

require 'init.php';


$bdd = connectBdd() ;

for ( $i = 1; $i < 4; $i++){     // FOR POUR LES DIFFERENTS ID DE RESSOURCES
    
$query = $bdd->prepare("SELECT ressources_own.amount FROM ressources_own, ressources, member WHERE Member_ID = :titi AND Ressources_ID = :tutu AND ressources_own.id_member = Member_ID AND ressources_own.id_ressource = Ressources_ID");
$query->execute([
    "titi"=>$_SESSION['Member_ID'],            // SELECTIONNE LE MONTANT DE TOUTES LES RESSOURCES D'UN JOUEUR
    "tutu"=>$i
    ]);
$result = $query->fetch();
$ressource[$i] = $result['amount'];
}

$query2 = $bdd->prepare("SELECT building_level FROM buildings_own WHERE id_member = :toto AND id_building = :titi");
$query2->execute([
    "toto"=>$_SESSION['Member_ID'],
    "titi"=>$_GET['id']                                  // SELECTIONNE LE NIVEAU DU BATIMENT A UP
]);
$result2 = $query2->fetch();
  
$level = $result2['building_level'] + 1;
echo $level;
$query3 = $bdd->prepare("SELECT Needed_wood, Needed_gold, Needed_iron FROM buildings_levels WHERE Level = :titi AND building_id = :tutu");
$query3->execute([
    "titi"=> $level,              // SELECTIONNE LE PRIX DU NIVEAU SUPERIEUR
    "tutu"=>$_GET['id']
]);
$result3 = $query3->fetch();

$query4 = $bdd->prepare("INSERT INTO buildings_construction (construction_time, id_member, id_buildings, construction_start) VALUES ( :titi, :tutu, :tata, :toto)");
$query4->execute([
    "titi"=>$res['construction_time'],
    "tutu"=>$_SESSION['Member_ID'],              // INSERE UN NOUVEAU UP DANS LA TABLE DE CONSTRUCTION
    "tata"=>$result2['Level'],
    "toto"=> $heure
]);

/*$query5 = $bdd->prepare("SELECT construction_start FROM buildings_construction WHERE id_member = :titi");
$query5->execute([ "titi"=> $_SESSION['Member_ID']]);
$result5 = $query5->fetch();
*/
$query6 = $bdd->prepare("UPDATE buildings_construction SET construction_end = construction_start + construction_time WHERE id_member = :tata");
$query6->execute([
    "tata"=>$_SESSION['Member_ID'] // REQUETE POUR CONNAITRE L'HEURE DE FIN
]);

$query7 = $bdd->prepare("SELECT * from buildings_construction WHERE id_member = :titi");
$query7->execute([
    "titi"=>$_SESSION['Member_ID'] // REQUETE TOUS LES UP EN COURS D'UN MEMBRE
]);

while ( $result7 = $query7->fetch() ){
    $end = $result7['construction_end'];
}

$exist = 0;
if ( $ressource[1] >= $result3[1] && $ressource[2] >= $result3[0] && $ressource[3] >= $result3[2] ){ // SI LES RESSOURCES SONT SUFFISANTES
    $query8 = $bdd->prepare("SELECT id_building, building_level FROM buildings_own WHERE id_member = :titi");
    $query8->execute([
        "titi"=>$_SESSION['Member_ID']
    ]);
    while ( $res8 = $query8->fetch() ){
        if ( $res8['id_building'] == $_GET['id'] ){ // SI LE LEVEL EXISTE, $EXIST = 1 
            $exist = 1;
            break;
        }
    }
    $newLevel = $res8['building_level'] + 1; // ON AJOUTE 1 AU LEVEL
    if ( $exist == 1 ){
        $query9 = $bdd->prepare("UPDATE buildings_own SET building_level = :tata WHERE id_building = :titi AND id_member = :toto");
        $query9->execute([
            "tata"=>$newLevel,
            "titi"=>$_GET['id'],
            "toto"=>$_SESSION['Member_ID']
        ]);
        
        $gold = $ressource[1] - $result3[1];
        $wood = $ressource[2] - $result3[0];
        $iron = $ressource[3] - $result3[2];
        
        $query10 = $bdd->prepare("UPDATE ressources_own SET amount = :titi WHERE id_ressource = :tata AND id_member = :toto");
        $query10->execute([
            "titi"=>$gold,
            "tata"=>1,
            "toto"=>$_SESSION['Member_ID']
        ]);
        $query11 = $bdd->prepare("UPDATE ressources_own SET amount = :titi WHERE id_ressource = :tata AND id_member = :toto");
        $query11->execute([
            "titi"=>$wood,
            "tata"=>2,
            "toto"=>$_SESSION['Member_ID']
        ]);
        $query12 = $bdd->prepare("UPDATE ressources_own SET amount = :titi WHERE id_ressource = :tata AND id_member = :toto");
        $query12->execute([
            "titi"=>$iron,
            "tata"=>3,
            "toto"=>$_SESSION['Member_ID']
        ]);
        header("Location: batiment.php");
    }
    else {
        if ( $exist == 0) {
        $query9 = $bdd->prepare("INSERT INTO buildings_own ( amount, id_building, id_member, building_level) VALUES (1, :titi, :toto, 1)");
        $query9->execute([
            "titi"=>$_GET['id'],
            "toto"=>$_SESSION['Member_ID']
        ]);
        
        $gold = $ressource[1] - $result3[1];
        $wood = $ressource[2] - $result3[0];
        $iron = $ressource[3] - $result3[2];
        
        $query10 = $bdd->prepare("UPDATE ressources_own SET amount = :titi WHERE id_ressource = :tata AND id_member = :toto");
        $query10->execute([
            "titi"=>$gold,
            "tata"=>1,
            "toto"=>$_SESSION['Member_ID']
        ]);
        $query11 = $bdd->prepare("UPDATE ressources_own SET amount = :titi WHERE id_ressource = :tata AND id_member = :toto");
        $query11->execute([
            "titi"=>$wood,
            "tata"=>2,
            "toto"=>$_SESSION['Member_ID']
        ]);
        $query12 = $bdd->prepare("UPDATE ressources_own SET amount = :titi WHERE id_ressource = :tata AND id_member = :toto");
        $query12->execute([
            "titi"=>$iron,
            "tata"=>3,
            "toto"=>$_SESSION['Member_ID']
        ]);
        header("Location: batiment.php");
        
        }
    } 
}


?>