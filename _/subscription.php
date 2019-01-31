
<?php 
require "header.php"; 
require 'recaptchalib.php';

$sitekey = '6Lc83x0TAAAAAPwNza21SUpT-reTvyp7nPUBW-pg';
$secret = '6Lc83x0TAAAAABqFcB6axJD5KVjDi5-uWU-kGQ66';

?>


  <?php
        if(isset($_SESSION['subscription'])){
        $_POST=$_SESSION['subscription'];
  ?>          
     <div class='container'>
      <div class='col-lg-3'></div>
      <div class="col-lg-6">
          <form method='POST' action='register.php'>
            <legend class='text-center'>Inscription</legend>
            <div class='form-group'>
              <label for='texte'>Pseudo : ( 2 caractères minimum )</label>
              <input id='pseudo' name='Pseudo' type='text' class='form-control' placeholder='Pseudo' value="<?php echo (isset($_POST['Pseudo']))?$_POST['Pseudo']:""; ?>">
              <?php    
                foreach ($_SESSION['error_subscription'] as $error) {
                  if($error == 1) {
                    echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
                  }
                  if($error == 8) {
                    echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
                  }
                }
              ?>
            </div>
            <div class='form-group'>
              <label for='texte'>Mot de passe : ( 8 cacractères minimum )</label>
              <input name='Password' type='password' class='form-control' placeholder='Mot de passe' value="<?php echo (isset($_POST['Password']))?$_POST['Password']:""; ?>">
              <?php    
                foreach ($_SESSION['error_subscription'] as $error) {
                  if($error == 3) {
                    echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
                  }
                }
              ?>
            </div>
            <div class='form-group'>
              <label for='texte'>Confirmation du mot de passe : </label>
              <input name='passwordverif' type='password' class='form-control' placeholder='Mot de passe' value="<?php echo (isset($_POST['passwordverif']))?$_POST['passwordverif']:""; ?>">
              <?php    
                foreach ($_SESSION['error_subscription'] as $error) {
                  if($error == 4) {
                    echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'>".$list_of_errors[$error]."</div></li></ul>";
                  }
                }
              ?>
            </div>
            <div class='form-group'>
              <label for='texte'>Email : </label>
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
            <div class='form-group'>
              <label for='texte'>Confirmation de votre Email : </label>
              <input name='emailverif' type='text' class='form-control' placeholder='Email' value="<?php echo (isset($_POST['emailverif']))?$_POST['emailverif']:""; ?>">
              <?php    
                foreach ($_SESSION['error_subscription'] as $error) {
                  if($error == 5) {
                    echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
                  }
                }
              ?>
            </div>
            <div class='form-group'>
              <label for='select'>Faction : </label>
              <select name="Faction" id="select" class="form-control">
                <option></option>
                <option>Alharbi</option>
                <option>Sharki</option>
              </select>
              <?php    
                foreach ($_SESSION['error_subscription'] as $error) {
                  if($error == 6) {
                    echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
                  }
                }
              ?>
            </div>
            <div class='form-group'>
              <input type='checkbox' name='cgu' id='cgu'><label for='cgu'>J'accepte les CGUs/CGVs</label><br>
            </div>
            <?php
                $reCaptcha = new ReCaptcha($secret);
                if(isset($_POST["g-recaptcha-response"])) {
                    $resp = $reCaptcha->verifyResponse(
                        $_SERVER["REMOTE_ADDR"],
                        $_POST["g-recaptcha-response"]
                        );
                    if ($resp != null && $resp->success) {echo "OK";}
                    else {echo "CAPTCHA incorrect";}
                    }
            ?> 
            <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
            <button class='btn btn-primary'>Envoyer</button><br><br>
          </form>
         </div>
         <div class="col-lg-3"></div>
    </div>
<?php
  session_destroy();
  }else{
?>      
   <div class="container">
  <div class="col-lg-3"></div>  
    <form class="col-lg-6" method="POST" action="register.php">
    	<legend class="text-center">Inscription</legend>
    	<div class="form-group">
          <label for="texte">Pseudo : ( 2 caractères minimum )</label>
          <input id="pseudo" value="" name="Pseudo" type="text" class="form-control" placeholder="Pseudo" required/>
        </div>
        <div class="form-group">
          <label for="texte">Mot de passe : ( 2 caractères minimum )</label>
          <input name="Password" type="password" class="form-control" placeholder="Mot de passe" required/>
        </div>
        <div class="form-group">
          <label for="texte">Confirmation du mot de passe : </label>
          <input name="passwordverif" type="password" class="form-control" placeholder="Mot de passe" required/>

        </div>
        <div class="form-group">
          <label for="texte">Email : </label>
          <input name="Mail" type="mail" class="form-control" placeholder="Email" required/>

        </div>
        <div class="form-group">
          <label for="texte">Confirmation de votre Email : </label>
          <input name="emailverif" type="text" class="form-control" placeholder="Email" required/>

        </div>
        <div class="form-group">
          <label for="select">Faction : </label>
          <select name="Faction" id="select" class="form-control">
          	<option></option>
            <option>Alharbi</option>
            <option>Sharki</option>
          </select>
       	</div>
       	<div class="form-group">
          <input type='checkbox' name='cgu' id='cgu' required=""><label for='cgu'>J'accepte les CGUs/CGVs</label><br>
       	</div>
       	<?php
       	 $reCaptcha = new ReCaptcha($secret);
    if(isset($_POST["g-recaptcha-response"])) {
        $resp = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
            );
        if ($resp != null && $resp->success) {echo "OK";}
        else {echo "CAPTCHA incorrect";}
        }
        ?>
        <div class="text-center">
       	    <div class="g-recaptcha" data-sitekey="6Lc83x0TAAAAAPwNza21SUpT-reTvyp7nPUBW-pg"></div>
        </div>
       	<br>
       	<br>
       	<div class="text-center">
       	<button class="btn btn-primary">Envoyer</button>
        </div>
        <br>
        <br>
       </form>
</div>
<?php
}
?>