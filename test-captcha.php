<?php
require 'recaptchalib.php';
$siteKey = '6Lc83x0TAAAAAPwNza21SUpT-reTvyp7nPUBW-pg'; // votre clé publique
$secret = '6Lc83x0TAAAAABqFcB6axJD5KVjDi5-uWU-kGQ66'; // votre clé privée
?>
<html>

<head>
<title>Ma page</title>
<script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
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
<form action="test-captcha.php" method="POST">
<div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
<input type="submit" value="Envoyer">
</form>
</body>

</html>