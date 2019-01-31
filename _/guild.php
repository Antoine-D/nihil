<?php 
require 'header.php';

if ( isConnected() ){
    $bdd = connectBdd();

    $queryGuild = $bdd ->prepare(" SELECT * FROM guild WHERE Guild_ID = :id ");
    $queryGuild->execute(["id"=>$_SESSION["Guild_ID"]]);
    $resultGuild=$queryGuild->fetch();
    
    

    $GID = $_SESSION["Guild_ID"];

    $request = $bdd ->query(" SELECT Pseudo, Guild_Rank, Member_ID FROM member WHERE Guild_ID = $GID ");

    ?>

    <body class="head2 font">
        <section>
            <div class="container-fluid">
            <div class="row">
                <?php require "ressource.php"; ?>
            </div>
                <div class="row"> 
                    <?php require 'sidebar.php'; ?>
                        <div class="box-guild col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list4">
                                        <?php 
                                            if (isInGuild()){
                                            ?>
                                                <a href="#"><span class="list-guild">Ma Guilde</span></a>
                                            <?php
                                            }
                                            else {
                                            ?>                                
                                                <a href="#"><span class="list-guild">Créer ma Guilde</span></a>
                                            <?php
                                            }
                                        ?>
                                        <a href="listGuild.php" class="list-guild">Liste des Guildes</a>
                                    </ul>
                                </div>
                            </div>

                        <div class="guild">
                            <?php 
                                if (isInGuild()){
                                ?>
                                    <div class="row" style="margin-top:5px;">
                                        <div class="col-md-4 text-left">
                                            <legend><br><p class="guild-name text-center"><?php echo $resultGuild['Name'];?></p></legend>
                                        </div>

                                        <div class="col-md-4 text-center"><img src="<?php echo $resultGuild['Logo'];?>" class="logo"></div>

                                        <div class="col-md-4 text-right">
                                            <legend><br><p class="text-center">[<?php echo $resultGuild['Tag'];?>]</p></legend>
                                        </div>
                                    </div> 

                                    <div class="row" style="margin-top:20px;">
                                        <div class="col-md-4"><legend><p class="text-center"> Liste des membres :</p></legend></div>

                                        <div class="col-md-7">
                                            <div class="text-center">
                                                <?php

                                                    echo "<table border='1' class='member-list text-center'>";
                                                        echo "<tr>";
                                                            echo "<th class='text-center'>Pseudo</th>";
                                                            echo "<th class='text-center'>Rang</th>";   
                                                            if ( isGuildChief() ){
                                                                echo "<th class='text-center'> Donner les droits </th>";
                                                            }
                                                        echo "</tr>";

                                                        echo "<tr>";
                                                            while ( $res = $request->fetch() ){
                                                            echo '<td>'.$res['Pseudo'].'</td>';
                                                            echo "<td>".rank($res['Guild_Rank'])."</td>";
                                                            if ( isGuildChief() ){
                                                                echo "<td class='text-center'><a href='giveRights.php?Pseudo=".$res["Pseudo"]."'>Donner les droits</a></td>";
                                                            }
                                                        echo"</tr>";                                                            
                                                    }
                                                    echo "</table>";
                                                ?>
                                            </div>
                                        </div>

                                        <div class="col-md-1"></div>
                                    </div>

                                    <div class="row" style="margin-top:20px;">
                                        <div class="col-md-4"><legend><p class="text-center">Description :</p></legend></div>

                                        <div class="col-md-7">
                                            <div class="description">
                                                <?php
                                                        echo "<input type='text' class='desc-size disabled' ";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>

                                    <div class="row" style="margin-top:10%;">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-2 text-center">
                                            <a href='exitGuild.php?Guild_ID="$GID"' class='btn btn-exit btn-danger'>Quitter la guilde</a><!-- exitGuilde.php?Guild_ID=".$data2['Guild_ID']." -->
                                        </div>
                                        <div class="col-md-5"></div>
                                    </div>

                                <?php
                                }
                                else {
                                ?>                                
                                <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <br>
                                        <legend class="text-center">Création de la guilde</legend>
                                        <div class="col-xs-6">
                                            <br>
                                            <table class="option-tab">
                                                <tr>
                                                    <td>Nom de la guilde</td>
                                                </tr>
                                            </table>
                                            <br>
                                            <table class="option-tab">
                                                <tr>
                                                    <td>TAG de la guilde</td>
                                                </tr>
                                            </table>
                                            <br>
                                            <table class="option-tab">
                                                <tr>
                                                    <td>Choisissez un logo ( JPG, PNG ou GIF max 20Ko)</td>
                                                </tr>
                                            </table>
                                            <br>
                                            <br>
                                            <table class="option-tab">
                                                <tr>
                                                    <td>Confirmer</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-xs-6">
                                           
                                            <form method="POST" action="createGuild.php" enctype="multipart/form-data">
                                               <input type='text' placeholder="Nom de votre guilde" name="guildName" class="form-control"><br>
                                               <input type='text' placeholder="TAG de votre guilde" name="tag" class="form-control">
                                               <input type="hidden" name="MAX_FILE_SIZE" value="1000000000000000">
                                               <br><input type='file' placeholder="Votre logo" name="logo"><br><br>
                                               <button class="btn btn-warning" >Valider</button><br><br>
                                            </form>
                                            
                                        </div>
                                    </div>
                                <div class="col-md-4"></div>
                                <?php } ?>                                                                             
                        </div>
                    </div>                    
                </div>
                <?php require "jauge.php"; ?>
            </div>
        </section>
    <?php
}
    else {
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
        echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
    }