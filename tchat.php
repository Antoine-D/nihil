<?php
require "header.php";
if(isConnected() && VerifBan($_SESSION['Mail']) ) {
	if(VerifHolidays()){
		$bdd = connectBdd();
		$query = $bdd->prepare('SELECT Faction FROM member WHERE Member_ID = :member');
		$query->execute(['member'=>$_SESSION['Member_ID']]);
		$page = $query->fetch();
		if($_GET['p'] != 1 && $_GET['p'] != ($page['Faction']+1)) { //si le joueur arrive sur le tchat de l'autre faction
			header("Location: tchat.php"); //redirige vers tchat.php sans get (le header marche pas)
		}else{
?>
			<body class="head2">
				<div class="container">
					<div class="row">
						<div class="col-xs-2 box_style">
							<div class="row">Joueurs connectés sur cette conversation</div>
							<div class='row'>
								<div id='connected' class='col-xs-12'>
									<?php
										if(!isset($_GET['p'])) {
											echo "Vous n'êtes pas autorisé d'accéder à cette conversation";
										}
									?>
								</div>
							</div>
						</div>
						<div class="col-xs-8">
							<div class='col-lg-12 box_style' id="box_message"></div>
							<div class="form-group">
								<input type="text" id="message" name="message" class='form-control' placeholder="Votre message">
							</div>
							<div class='row'>
								<?php
									echo "<ul class='list-inline'>";
									for($i=1 ; $i < 4 ; $i++) {
										echo "<li><a href='tchat.php?p=".$i."'><span class='list-type'>Salon".$i."</span></a>"; //A améliorer avec un foreach et une liste of conv (Générale, Alharbi, Sharki)
									}
									echo "</ul>";

									/*<ul class="list2 list-inline">
		       							 <li><a href="batiment.php"><span class="list-type">Batiments</span></a></li>
									*/
								?>
							</div>
						</div>
						<div class="col-xs-2"></div>
					</div>
				</div>
			</body>
	<?php
			echo"	<script>
						tchat(".$_GET['p'].");
						receive(0, ".$_GET['p'].");
						connected(".$_GET['p'].");
					</script>";
		}
	}else{
		echo "<p class='text-center'>Vous être en mode vacances vous ne pouvez donc pas acceder au tchat</p>";
		echo "<p class='text-center'>Cliquer<a href='game.php'> ici</a> pour revenir sur l'accueil</p>";
	}
}else{
	echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
   	echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}
?>