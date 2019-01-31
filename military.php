<?php 
require 'header.php'; 

if ( isConnected() && VerifBan($_SESSION['Mail']) ){
    $bdd = connectBdd();
?>
<body class="head2 font">
    <section>
        <div class="container-fluid">
              <div class="row">
                   <?php require "ressource.php" ?>
            </div>
            <div class="row">
                <?php require 'sidebar.php'; ?>
                <div class="main-box col-md-8">
                        <div class="col-md-12 text-center">
                            <?php require "nav.php" ?>
                        </div>
                    <div class="col-md-12">
                        <div class="box-bat text-center">
                            <table class="table-bat building_display"></table>
                        </div>
                    </div>
                </div>
                <?php 
                    require 'jauge.php'
                ?>
            </div>
        </div>
    </section>
</body>
<?php
    echo "  <script>
                build(30)
            </script>";
}
else {
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
        echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
    }
?>










<?php 
        
                                $ressource[1] = 0; // GOLD
                                $ressource[2] = 0; // BOIS
                                $ressource[3] = 0; // IRON
                                $ressource[4] = 0; // SCIENCE

                                $i = 0;
                                for ( $i = 1; $i < 4; $i++){     // FOR POUR LES DIFFERENTS ID DE RESSOURCES

                                $queryRessource = $bdd->prepare("SELECT ressources_own.amount FROM ressources_own, ressources, member WHERE Member_ID = :member_id AND Ressources_ID = :ressource_id AND ressources_own.id_member = Member_ID AND ressources_own.id_ressource = Ressources_ID");
                                $queryRessource->execute([
                                    "member_id"=>$_SESSION['Member_ID'],            // SELECTIONNE LE MONTANT DE TOUTES LES RESSOURCES D'UN JOUEUR
                                    "ressource_id"=>$i
                                    ]);
                                $resultRessource = $queryRessource->fetch();
                                $ressource[$i] = $resultRessource['amount'];
                                }               
        
                                $result = $bdd->prepare("SELECT * FROM buildings_types WHERE id id >= 20 && id < 30");   
                                $result->execute();
    
                                
                                
                                while ( $data = $result->fetch() ){
                                    $query = $bdd->prepare("SELECT building_level FROM buildings_own WHERE id_member = :id AND id_type = :building");
                                    $query->execute([
                                        "id"=>$_SESSION['Member_ID'],
                                        "building"=>$data['id']
                                    ]);
                                    $data2 = $query->fetch();
                                    $query2 = $bdd->prepare("SELECT Needed_wood, Needed_gold, Needed_iron FROM buildings_levels, buildings_types WHERE Level = :lvl AND building_id = buildings_types.id"); 
                                    $query2->execute([
                                        "lvl"=>$data2['building_level'] + 1
                                    ]);
                                     $data3 = $query2->fetch();
                                echo "
                                <tr>
                                    <td class='td-img'><img src=".$data['image']." class='logo'></td>
                                    <td class='td-desc'>Nom : ".$data['name']." Niveau : ".$data2['building_level']."<br> Prix : Bois ".$data3['Needed_wood']."  Or ".$data3['Needed_gold']."  Métal ".$data3['Needed_iron']."</td>
                                    <td id=".$data['name'].">";
                                    
                                    if ( $data3['Needed_iron'] > $ressource[3] || $data3['Needed_gold'] > $ressource[1] || $data3['Needed_wood'] > $ressource[2] || $data2['building_level'] == 10){
                                        echo "<button class='btn btn-success disabled'>UP</button>";
                                    }
                                    else {
                                        if ( $data3['Needed_iron'] <= $ressource[3] && $data3['Needed_gold'] <= $ressource[1] && $data3['Needed_wood'] <= $ressource[2] && $data2['building_level'] < 10){
                                            echo "<a class='btn btn-success' href='up.php?id=".$data['id']."'>UP</a>";
                                        }
                                    }
                                     
                                        
                                    "</td>
                                </tr>";  //' onclick='Up(".$data['name'].")'
                                }
                                ?>