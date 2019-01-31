<?php
    $query = $bdd->prepare("SELECT ressources_own.amount FROM ressources_own, ressources, member WHERE Member_ID = :titi AND Ressources_ID = 1 AND ressources_own.id_member = Member_ID AND ressources_own.id_ressource = Ressources_ID");    
    $query->execute(["titi"=>$_SESSION['Member_ID']]);
    
    $query2 = $bdd->prepare("SELECT ressources.Name FROM ressources WHERE Ressources_ID = :value ");
    $query2->execute(['value'=>1]);
    
    $query3 = $bdd->prepare("SELECT ressources_own.amount FROM ressources_own, ressources, member WHERE Member_ID = :titi AND Ressources_ID = 2 AND ressources_own.id_member = Member_ID AND ressources_own.id_ressource = Ressources_ID");  
    $query3->execute(["titi"=>$_SESSION['Member_ID']]);
    
    $query4 = $bdd->prepare("SELECT ressources.Name FROM ressources WHERE Ressources_ID = :value");
    $query4->execute(['value'=>2]);
    
    $query5 = $bdd->prepare("SELECT ressources_own.amount FROM ressources_own, ressources, member WHERE Member_ID = :titi AND Ressources_ID = 3 AND ressources_own.id_member = Member_ID AND ressources_own.id_ressource = Ressources_ID");    
    $query5->execute(["titi"=>$_SESSION['Member_ID']]);
    
    $query6 = $bdd->prepare("SELECT ressources.Name FROM ressources WHERE Ressources_ID = :value ");
    $query6->execute(['value'=>3]);
    
    $query7 = $bdd->prepare("SELECT ressources_own.amount FROM ressources_own, ressources, member WHERE Member_ID = :titi AND Ressources_ID = 4 AND ressources_own.id_member = Member_ID AND ressources_own.id_ressource = Ressources_ID");    
    $query7->execute(["titi"=>$_SESSION['Member_ID']]);
    
    $query8 = $bdd->prepare("SELECT ressources.Name FROM ressources WHERE Ressources_ID = :value");
    $query8->execute(['value'=>4]);
?>
    <div class="col-xs-12">
                            <div class="ressource">
                                <div class="col-xs-3 style-ressource" style="color : white;">
                                    <div class="inter_style_ressource">
                                        <?php
                                            while( $result = $query->fetch() ){
                                                echo $result['amount'];
                                            } 
                                            echo " ";
                                            while( $result2 = $query2->fetch() ){
                                                echo $result2['Name'];
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-xs-3 style-ressource" style="color : white;">
                                    <div class="inter_style_ressource">
                                        <?php
                                            while($result3 = $query3->fetch() ) {
                                                echo $result3['amount'];
                                            }
                                            echo " ";
                                            while($result4 = $query4->fetch() ) {
                                                echo $result4['Name'];
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-xs-3 style-ressource" style="color : white;">
                                    <div class="inter_style_ressource">
                                        <?php
                                            while( $result5 = $query5->fetch() ) {
                                                echo $result5['amount'];
                                            }
                                            echo " ";
                                            while( $result6 = $query6->fetch() ) {
                                                echo $result6['Name'];
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-xs-3 style-ressource" style="color : white;">
                                    <div class="inter_style_ressource">
                                        <?php
                                            while( $result7 = $query7->fetch() ) {
                                                echo $result7['amount'];
                                            }
                                            echo " ";
                                            while( $result8 = $query8->fetch() ) {
                                                echo $result8['Name'];
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
    </div>