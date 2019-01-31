<?php
require 'header.php';

?>
<body class="head2 font">
    <div class="container-fluid">
        <?php $bdd = connectBdd();
        require "ressource.php";?>
        <div class="row">
            <?php
                require 'sidebar.php';
                ?>
                <div class="main-box col-sm-8">
                    <?php
                    if ( isConnected() && VerifBan($_SESSION['Mail']) ){
                        require "nav.php";

                        $result = $bdd->query('SELECT * FROM guild');
                        echo "<center>";
                        echo "<div class='col-sm-12 listguilde font'>";
                            echo "<table class='text-center table-striped guild-tab font'>";
                                echo "<tr>
                                        <th class='text-center'>Nom de la guilde</th>
                                        <th class='text-center'>TAG</th>
                                        <th class='text-center'>Faction</th>
                                        <th class='text-center'>Nombre de joueurs</th>
                                        <th class='text-center'>Points</th>
                                        <th class='text-center'>Page de Guilde</th>";  
                                        if ( isAdmin() ){
                                            echo "<th class='text-center'>Supprimer une Guilde</th>";
                                        }

                                while ( $data = $result->fetch() ){

                                    echo "<tr>";
                                        echo "<td>".$data['Name']."</td>";
                                        echo "<td>[".$data['Tag']."]</td>";
                                        echo "<td>";
                                            if ( $data['Faction'] == 0){
                                                echo"Alharbi";
                                            }
                                            else{
                                                echo"Sharki";
                                            }
                                        echo"</td>";
                                        echo"<td>".$data['Number_Players']."</td>";
                                        echo "<td>".$data['Points']."</td>";
                                        echo "<td><a href='guildeDetail.php?Guild_ID=".$data["Guild_ID"]."'>Voir</a></td>"; 
                                        if ( isAdmin() ){
                                            echo "<td><a href='deleteGuild.php?Guild_ID=".$data["Guild_ID"]."'>Supprimer</a</td>";
                                        }
                                    echo"</tr>";
                                }
                            echo "</table>";
                        echo "</div>";
                        echo "</center>";
                    }
                    else{
                        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
                        echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
                    }
                    ?>
                </div>
            <?php require "jauge.php"; ?>
        </div>
    </div>
<body>