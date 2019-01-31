<?php 
require 'header.php';
require 'sidebar.php';
?>

<?php
    if (isConnected() ){
        if ( isAdmin() ){
            $bdd = connectBdd();
            $result = $bdd->query('SELECT * FROM member');
        echo "<body class='head2'>
                <div class='font' style='margin-top: 6%;'>";
            echo "<table class='text-center tab-backoffice'>";
            echo "<tr>
                    <th class='text-center'>Member_ID</th>
                    <th class='text-center'>Pseudo</th>
                    <th class='text-center'>Email</th>
                    <th class='text-center'>Faction</th>
                    <th class='text-center'>Guilde_name</th>
                    <th class='text-center'>Privileges</th>
                    <th class='text-center'>Registration_Date</th>
                    <th class='text-center'>Ban</th>";

            while ( $data = $result->fetch() ){ 
                echo "<tr>";
                    echo "<td>".$data['Member_ID']."</td>";
                    echo "<td>".$data['Pseudo']."</td>";
                    echo "<td>".$data['Mail']."</td>";

                    $query = $bdd->prepare("SELECT Name FROM faction WHERE Faction_ID = :id");
                    $query->execute(['id'=>$data['Faction']]);
                    $faction = $query->fetch();
                    echo "<td>".$faction['Name']."</td>";

                    $query2 = $bdd->prepare('SELECT Name FROM guild WHERE Guild_ID = :id');
                    $query2->execute(['id'=>$data['Guild_ID']]);
                    $guild = $query2->fetch();
                    echo "<td>".$guild['Name']."</td>";
                    echo "<td>".$data['Privileges']."</td>";
                    echo "<td>".$data['Registration_Date']."</td>";
                    echo "<td>".$data['Ban']."</td>";

                    echo "<td><a href='delete.php?Member_ID=".$data["Member_ID"]."'>Supprimer</a></td>";
                    echo "<td><a href='modify.php?Member_ID=".$data["Member_ID"]."'>Modifier</a></td>";


                    if ($data['Ban'] == 0) {
                    echo "<td><a href='ban.php?Member_ID=".$data["Member_ID"]."'>Ban</a></td>";
                    }else{
                        echo "<td><a href='deban.php?Member_ID=".$data["Member_ID"]."'>DeBan</a></td>";
                    }

                    if ($data['Privileges'] == 1) {
                    echo "<td><a href='modo.php?Member_ID=".$data["Member_ID"]."'>Passer Modérateur</a></td>";
                    }else{
                        if($data['Privileges'] == 2) {
                            echo "<td>Modérateur<a href='NoModo.php?Member_ID=".$data["Member_ID"]."' title='Retirer modération'> x</a></td>";
                        }else{
                            echo "<td>Admin</td>";
                        }
                    }

                echo"</tr>";
            }
            echo "</table>";
        echo "</div>
        </body>";
        }
        else {
        
            echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p>";
            echo "<p class='text-center'>Cliquez <a href='game.php'>ici</a> pour retourner sur la page de jeu.</p>";
        }
    }
    else {
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
        echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
    }
	
?>