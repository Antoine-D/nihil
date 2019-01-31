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
            if (isConnected() && VerifBan($_SESSION['Mail']) ){
                require "nav.php";
                $query = $bdd->prepare("SELECT Points, Pseudo, Faction, option_score FROM member ORDER BY Points DESC");
                $query->execute();
                echo "<center>";
                echo "<div class='col-sm-12 classement font'>";
                    echo "<table width='80%' border='1' class='text-center'>";
                        echo "<tr>
                                <th class='text-center'>Place</th>
                                <th class='text-center'>Joueur</th>
                                <th class='text-center'>Faction</th>
                                <th class='text-center'>Points</th>";

                    while($data = $query->fetch()){
                        $i ++;
                        if($data['option_score']) {
                            echo "<tr>";
                            echo "<td ";
                            if($i == 1) {
                                echo "style='color: gold'>".$i;
                            }else{
                                if($i == 2) {
                                    echo "style='color: silver'>".$i;
                                }else{
                                    if($i == 3) {
                                        echo "style='color: brown'>".$i;
                                    }else{
                                        echo ">".$i;
                                    }
                                }
                            }
                            "</td>";
                            echo "<td>".$data['Pseudo']."</td>";
                            $query2 = $bdd->prepare('SELECT Name FROM faction WHERE Faction_ID = :id');
                            $query2->execute(['id'=>$data['Faction']]);
                            $result = $query2->fetch();
                            echo "<td>".$result['Name']."</td>";
                            echo "<td>".$data['Points']."</td>";
                            echo "</tr>";
                        }
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