<?php 
require 'header.php'; 


if ( isConnected() && VerifBan($_SESSION['Mail']) ){
    
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
                    <?php require "nav.php";
                    
                    $query = $bdd->prepare("SELECT member.Points, member.Pseudo, faction.Name
                                            FROM member, faction
                                            WHERE member.Member_ID = :id AND faction.Faction_ID = member.Faction");
                    $query->execute([ "id"=>$_SESSION['Member_ID']]);
                    $result = $query->fetch();
                    
                    ?>
                    
                    <div class="col-lg-12 bvn">
	                    <div class="container-fluid">
	                    	<center><img class="bvnimg" src="image/Nihil.png"></center>
	                    	<hr class="star-light">
	                        <u><center><h2>Bienvenue <?php echo $result['Pseudo'] ?> !</h2></center></u>
	                        <center>Tu es membre de la faction: <?php echo $result['Name'] ?></center>
	                        <center><p>Tu as actuellement <?php echo $result['Points'] ?> points</p></center>
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