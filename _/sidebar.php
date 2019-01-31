<?php

if ( isConnected() ){

?>
    <div class="col-sm-2 font">
        <div class="left-box">
            <ul class="list">
                <p>Environnement</p>
                <a href="game.php"><li class="list-style">Accueil</li></a>
                <a href="guild.php"><li class="list-style">Guilde</li></a>
                <a href="#"><li class="list-style">Map</li></a>
                <a href="pfc.php"><li class="list-style">Jeux quotidien</li></a>
                <a href="classement.php"><li class="list-style">Classement</li></a>
                <a href="#"><li class="list-style">Expédition</li></a>
                <a href="#"><li class="list-style">Attaque</li></a>
            </ul>
        </div>
    </div>
<?php
}
else {
    echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}