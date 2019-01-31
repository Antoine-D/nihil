<?php 
require 'header.php';
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
                                                <a href="guild.php"><span class="list-guild">Créer ma Guilde</span></a>
                                            <?php
                                            }
                                        ?>
                                        <a href="listGuild.php" class="list-guild">Liste des Guildes</a>
                                    </ul>
                                </div>
                            </div>  
                            <div class="guild">
                              <?php
                                if ( isset($_SESSION['guild'])){
                                    $_POST=$_SESSION['guild'];
                                
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
                                           <input type='text' placeholder="Nom de votre guilde" name="guildName" class="form-control" <?php echo "value=".$_POST['guildName'].""; ?> ><br>
                                           <?php    
                                                foreach ($_SESSION['error_guild'] as $error) {
                                                if ( $error == 9) {
                                                    echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
                                                    }
                                                }
                                                ?>
                                           <input type='text' placeholder="TAG de votre guilde" name="tag" class="form-control" <?php echo "value=".$_POST['tag'].""; ?> >
                                           <?php    
                                                foreach ($_SESSION['error_guild'] as $error) {
                                                if ( $error == 10) {
                                                    echo"<div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div>";
                                                    }
                                                if ( $error == 11) {
                                                    echo"<div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div>";
                                                    }
                                                }
                                                ?>
                                           <input type="hidden" name="MAX_FILE_SIZE" value="1000000000000000">
                                           <br><input type='file' placeholder="Votre logo" name="logo"><br><br>
                                           <button class="btn btn-warning" >Valider</button><br><br>
                                        </form>

                                    </div>
                                </div>
                            <div class="col-md-4"></div>
                        </div>
                        <?php
                        }
                        else {
                            header("Location: guild.php");
                        }
                        ?>
                </div>
            </div>
            <?php require "jauge.php"; ?>
        </div>
    </section>
</body>