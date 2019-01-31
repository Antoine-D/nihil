<?php 
require 'header.php';

if ( isConnected()){
	$bdd = connectBdd();
	$query = $bdd->prepare("SELECT player_score, bot_score, waiting_time FROM member WHERE Member_ID = :titi ");
    $query->execute(['titi'=>$_SESSION['Member_ID']]);
    $result = $query->fetch();
    $_SESSION['player_score'] = $result['player_score'];
    $_SESSION['bot_score'] = $result['bot_score'];
    $_SESSION['waiting_time'] = $result['waiting_time'];
?>
<body class='head2 font'>
    <section>
        <div class='container-fluid'>
        	<?php require 'ressource.php'; ?>
            <div class='row'> 
            	<?php require 'sidebar.php'; ?>
				<div class='main-box col-sm-8'>
					<div class='col-xs-4'>
						<center><h2><div id="player_score"></div></h2><center>
					</div>
			   		<div class='col-xs-4'>
			            <ul class='list2 list-inline'>
			                <li><a href='#' onclick="pfc_game(1)"><span class='list-type'>Pierre</span></a></li>
			                <li><a href='#' onclick="pfc_game(2)"><span class='list-type'>Feuille</span></a></li>
			                <li><a href='#' onclick="pfc_game(3)"><span class='list-type'>Ciseaux</span></a></li>
			       		</ul>
					</div>
					<div class='col-xs-4'>
			   			<center><h2><div id="bot_score"></div></h2></center>
					</div>
					<div class='col-lg-12 bvn'>
						<center><div id="res" class='container-fluid'><br><br><br></div></center>
					</div>
   				</div>
   				<?php require 'jauge.php'; ?>
    		</div>
    	</div>
	</section>
	<script>
		pfc_game();
	</script>
</body>
<?php
}else{
	echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
	echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}
?>
