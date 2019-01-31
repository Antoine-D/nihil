<?php
require 'header.php';
?>
<body class="head2 font">
    <div class="container-fluid">
        <div class="row">
            <?php $bdd = connectBdd(); ?>
            <?php require "ressource.php"; ?>
        </div>
        <div class="row">
            <?php require "sidebar.php"; ?>
                <div class="main-box col-sm-8">
                    <?php
                        if ( isConnected() ){
                        
                            $result = $bdd->query('SELECT * FROM guild');
                            $data2 = $result->fetch();

                            $query = $bdd->prepare('SELECT * FROM guild WHERE Guild_ID = :id');
                            $query->execute(["id"=> $_GET['Guild_ID']]);
                            $data = $query->fetch();

                            $GID = $_GET["Guild_ID"];

                            $request = $bdd ->query(" SELECT Pseudo, Guild_Rank FROM member WHERE Guild_ID = $GID ");


                            ?>
                                <?php require "nav.php"; ?>
                            <div class="col-sm-12 font">
                                <div class="guild">

                                    <div class="row">
                                        <div class="col-sm-4 text-left">
                                            <legend><br><p class="text-center"><?php echo $data['Name'];?></p></legend>
                                        </div>

                                        <div class="col-sm-4 text-center"><img src="<?php echo $data['Logo'];?>" class="logo"></div>

                                        <div class="col-sm-4 text-right">
                                            <legend><br><p class="text-center">[<?php echo $data['Tag'];?>]</p></legend>
                                        </div>
                                    </div> 
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-4"><legend><p class="text-center"> Liste des membres :</p></legend></div>

                                        <div class="col-sm-7">
                                            <p class="text-center">
                                                <?php 
                                                    echo "<table border='1' class='member-list text-center'>";
                                                        echo "<tr>";
                                                            echo "<th class='text-center'>Pseudo</th>";
                                                            echo "<th class='text-center'>Rang</th>";
                                                        echo "</tr>";
                                                    while ( $resultat = $request->fetch() ){
                                                        echo "<tr>";
                                                            echo "<td>".$resultat['Pseudo']."</td>";
                                                            echo "<td>".rank($resultat['Guild_Rank'])."</td>";
                                                        echo "</tr>";
                                                    }
                                                     echo "</table>";
                                                ?>
                                            </p>
                                        </div>

                                        <div class="col-sm-1"></div>
                                    </div>

                                    <div class="">
                                        <div class="row">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-4"><legend><p class="text-center"> Description :</p></legend></div>
                                            <div class="col-sm-4"></div>                
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-4 text-center"><?php echo $data['Description'] ?></div>
                                            <div class="col-sm-4"></div>    
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="button-guild">
                                            <div class="col-sm-5"></div>

                                            <div class="col-sm-2">
                                                <?php
                                                    if ( isInGuild () == true){

                                                    }
                                                    else {
                                                        ?>
                                                            <?php echo"<a class='btn btn-exit btn-warning' href='joinGuilde.php?Guild_ID=".$data['Guild_ID']."'>Rejoindre !</a>"?>
                                                    <?php
                                                    }
                                                ?>
                                            </div>

                                            <div class="col-sm-5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        }
                        else{
                            echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
                            echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
                        }
                ?>
                </div>
            <?php
            require "jauge.php";
            ?>
        </div>
    </div>
</body>