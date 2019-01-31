<?php 
require 'header.php'; 

if ( isConnected() && VerifBan($_SESSION['Mail']) ){
    
   $bdd = connectBdd();

?>
<body class="head2 font">
    <section>
        <div class="container-fluid">
              <div class="row">
                   <div class="text-center">
                       <?php require "ressource.php"; ?>
                   </div>
            </div>
            <div class="row">
                <?php require 'sidebar.php'; ?>
                <div class="main-box col-md-8">
                        <div class="col-md-12 text-center">
                            <?php require "nav.php"; ?>
                        </div>
                    <div class="col-md-12">
                        <div class="box-bat text-center">
                            <table border="1" class="table-bat">
                                <?php     
                                /*$result = $bdd->query("SELECT * FROM buildings_types WHERE id >= 20 && id < 30");     
                                while ( $data = $result->fetch() ){
                                echo "
                                <tr>
                                    <tr>
                                    <td class='td-img'><img src=".$data['image']." class='logo'></td>
                                    <td class='td-desc'>Nom : ".$data['name']." Niveau : ".$data2['building_level']."<br> Prix : Bois ".$data3['Needed_wood']."  Or ".$data3['Needed_gold']."  Métal ".$data3['Needed_iron']."</td>
                                    <td id=".$data['name'].">";
                                    
                                    if ( $data3['Needed_iron'] > $ressource[3] || $data3['Needed_gold'] > $ressource[1] || $data3['Needed_wood'] > $ressource[2] || $data2['building_level'] == 10 || !VerifHolidays()){
                                        echo "<button class='btn btn-success disabled'>UP</button>";
                                    }
                                    else {
                                        if ( $data3['Needed_iron'] <= $ressource[3] && $data3['Needed_gold'] <= $ressource[1] && $data3['Needed_wood'] <= $ressource[2] && $data2['building_level'] < 10){
                                            echo "<a class='btn btn-success' href='up.php?id=".$data['id']."'>UP</a>";
                                        }
                                    }
                                     
                                        
                                    "</td>
                                </tr>";
                                    }
                                */?>
                            </table>
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
}
else {
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
        echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
    }
?>