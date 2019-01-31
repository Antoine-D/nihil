<?php
	require 'header.php';
	require 'pop-up.php';
	require'PHPMailer/class.phpmailer.php';
	$caracteres = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN123456789";
	$caracteres = str_shuffle($caracteres);
	$taille_pwd = 10;
	$nouveau_pwd = substr($caracteres, 0, $taille_pwd);

	if(isset($_POST['Mail'])){
        $mail = new PHPMailer();
	    $mail->Host = 'http://s621664320.onlinehome.fr/';
	    $mail->SMTPAuth = false;
	    $mail->Port = 25; // Par défaut
	    $mail->CharSet = "utf-8";
	    // Expéditeur
	    $mail->SetFrom('nihil.staff@gmail.com');
	    // Destinataire
	    $mail->AddAddress($_POST['Mail']);
	    // Objet
	    $mail->Subject = 'Nouveau mot de passe.';

	    // Votre message
	    $mail->MsgHTML('Voici votre nouveau mot de passe: 
	    
	    '.$nouveau_pwd.'<br>

	    Veuillez ne pas copier/coller le mot de passe, la connexion ne fonctionnera pas.
	    ');

	    // Envoi du mail avec gestion des erreurs
	    if(!$mail->Send()) {
	      echo 'Erreur : ' . $mail->ErrorInfo;
	    } else {
	      ?> 
	          <meta charset="utf-8">
	          <p>Mot de passe modifier avec succes.</p>
	          <meta http-equiv="refresh" content="5;index.php">
	        <?php
	    } 
        
        $nouveau_pwd = password_hash($nouveau_pwd, PASSWORD_DEFAULT);
	    $bdd = connectBdd();
	    $query = $bdd->prepare("UPDATE member SET Password = :pwd WHERE Mail=:Mail");
	    $query->execute(["Mail"=>$_POST["Mail"], 'pwd'=>$nouveau_pwd]);
    }

?>
<div class="container"> 
	<div class="row">
		<div class="col-lg-3"></div>
			<div class="col-lg-6 text-center">
				<form method="POST" action="">
					<div class='form-group'>
		              <label for='texte'>Entrez votre adresse mail : </label>
		              <input name='Mail' type='mail' class='form-control' placeholder='Email' value="<?php echo (isset($_POST['Mail']))?$_POST['Mail']:""; ?>">
		              <?php    
		                foreach ($_SESSION['error_subscription'] as $error) {
		                  if($error == 2) {
		                    echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
		                  }
		                  if($error == 7) {
		                    echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
		                  }
		                }
		              ?>
		            </div>
		            <br>
			       	<br>
			       	<div class="text-center">
			       		<button class="btn btn-primary">Envoyer</button>
			        </div>
				</form>
			</div>
		<div class="col-lg-3"></div>
	</div>
</div>


