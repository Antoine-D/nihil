<?php 
require 'header.php';

if ( isConnected() && VerifBan($_SESSION['Mail']) ){
    $bdd = connectBdd();

    $queryGuild = $bdd ->prepare(" SELECT * FROM guild WHERE Guild_ID = :id ");
    $queryGuild->execute(["id"=>$_SESSION["Guild_ID"]]);
    $resultGuild=$queryGuild->fetch();
    

    ?>

<body class="head2 font">
    <section>
        <div class="container-fluid">
            <div class="row">
            <?php require "ressource.php"; ?>
            </div>
            <div class="row"> 
                <?php require 'sidebar.php'; ?>
                    <div class="box-guild col-sm-8">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list4">
                                    <?php 
                                        if (isInGuild()){
                                        ?>
                                            <a href="myGuild.php"><span class="list-guild">Ma Guilde</span></a>
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
                    <?php 
                        if (isInGuild()){
                            require "myGuild.php";
                        }
                        else {
                        ?>   
                        <div class="row">                             
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

                                           <label for="picture"> s</label>&nbsp;
                                            <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
                                            <input
                                                    id="test"
                                                    type="file"
                                                    class="form-control"
                                                    name="logo"
                                            ><br>
                                           
                                           <button class="btn btn-warning" >Valider</button><br><br>
                                        </form>

                                    </div>
                                </div>
                            <div class="col-md-1"></div>
                        </div>
                            <?php 
                            } 
                        ?> 
                    </div>  
                    <?php require "jauge.php"; ?>
                </div>
            </div>
        </section>
    <?php
}
    else {
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
        echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
    }