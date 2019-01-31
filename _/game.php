<?php 
require 'header.php'; 


if ( isConnected()){
    
   $bdd = connectBdd();
?>
<body class="head2 font">
    <section>
        <div class="container-fluid">
            <div class="row">
                <?php require "ressource.php"; ?>
            </div>
            <div class="row">
               	<?php require 'sidebar.php'; ?>
               	<div class="main-box col-sm-8">
                        <?php require "nav.php" ?>
                    <!--<div class="col-md-2">
                        <div class="box-type">
                            <ul class="list3 list-inline">
                                <li><a href="#"><span class="list-right">type 1</span></a></li>
                                <li><a href="#"><span class="list-right">type 2</span></a></li>
                                <li><a href="#"><span class="list-right">type 3</span></a></li>
                                <li><a href="#"><span class="list-right">type 4</span></a></li>
                                <li><a href="#"><span class="list-right">type 5</span></a></li>
                                <li><a href="#"><span class="list-right">type 6</span></a></li>
                            </ul>
                        </div>
                    </div>-->
                    <div class="col-lg-12 bvn">
	                    <div class="container-fluid">
	                    	<center><img class="bvnimg" src="image/Nihil.png"></center>
	                    	<hr class="star-light">
	                        <u><center><h2>Bienvenue <?php echo $_SESSION['Pseudo'] ?> !</h2></center></u>
	                        <center>Tu es membre de la faction: <?php if($_SESSION['Faction'] == 1){echo "Sharki";}else{echo "Alarhbi";} ?></center>
	                        <center><p>Tu as actuellement <?php echo $_SESSION['Points'] ?> points</p></center>
	                        <hr class="star-light">
	                    </div>
                    </div>
                </div>
                <?php 
                    require 'jauge.php';
                ?>
            </div>
        </div>
    </section>
</body>
<?php 
}
else {
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
        echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
    }
?>