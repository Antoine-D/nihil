<?php
$i = 0;
require 'header.php';
echo "<body class='head2 font'>";
    echo "<div class='container-fluid'>";
    $bdd = connectBdd();
        echo "<div class='row'>";
            require "ressource.php";
        echo "</div>";
        echo "<div class='row'>";
        require 'sidebar.php';
            echo "<div class='col-sm-8 main-box'>";
            if (isConnected() ){
                require "nav.php";
                $query = $bdd->query("SELECT Points, Pseudo FROM member ORDER BY Points DESC");
                echo "<center>";
                echo "<div class='col-sm-12 classement font'>";
                    echo "<table width='80%' border='1' class='text-center'>";
                        echo "<tr>
                                <th class='text-center'>Place</th>
                                <th class='text-center'>Joueur</th>
                                <th class='text-center'>Points</th>";

                    while ( $data = $query->fetch() ){
                        $i ++;
                         echo "<tr>";
                            echo "<td>".$i."</td>";
                            echo "<td>".$data['Pseudo']."</td>";
                            echo "<td>".$data['Points']."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                echo "</div>";
                echo "</center>";
                
            }
            else {
                echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
                echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
            }
            echo "</div>";
            require "jauge.php";
        echo "</div>";
    echo "</div>";