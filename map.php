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
                $query = $bdd->prepare("SELECT Pseudo FROM member  WHERE Faction = :value ORDER BY Member_ID DESC");
                echo "<div class='col-sm-12 classement font'>
                		<table width='80% border='1' class='text-center'>
                			<tr>
                				<th class='text-center'>Alharbi</th>";
                		$query->execute(['value'=>1]);
               			while($Alharbi = $query->fetch()) {
               				$i++;
               				echo "<tr>
               						<td>".$Alharbi['Pseudo']."</td>
           						</tr>";
           				}
                echo "	</table>
                	</div>";
            }else{
                echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
                echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
            }
echo "		</div>";
require "jauge.php";
echo"		</div>
	</div>";