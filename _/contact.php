<?php
require 'header.php';
require 'pop-up.php';

$bdd = connectBdd();

if(isConnected()){
    if (isset($_POST['comment'])) {
            $adresse = $_SESSION['Mail'];
            $contenu = $_POST['comment'];
            $destinataire = 'nihil.staff@gmail.com' ;
            $sujet = $_POST['objet'] ;
            $entete = "From: ".$_SESSION['Pseudo'] ;
            $message = 'Message envoyé par : '.$adresse.'
            '.$contenu.'';
             
            mail($destinataire, $sujet, $message, $entete) ;
        }       
    }else{
        echo "<div class='container'>";
            echo "<div class='row contactRow'>";
                echo "<div class='col-md-2'></div>";
                echo "<div class='col-md-8'>";
                    echo "<div class='contactMail'><u>Vous souhaitez nous contacter ? Veuillez-vous inscrire ou à vous connecter</u></div>";
                echo "</div>";
                echo "<div class='col-md-2'></div>";
            echo "</div>";
        echo "</div>";
    }
?>
  
<body class="head2 font">
    <div class="container"> 
        <div class="row">
            <div class="col-lg-5 text-center">
                <legend class="text-center contact-title">Liens Utiles</legend>
                <a href="https://www.facebook.com/Nihil-1544794465817749/" class="btn btn-default btn-lg Fb-color" target="_blank"><i class="fa fa-facebook fa-2x"></i> <span class="network-name">Facebook</span></a><br><br>
                <a href="https://twitter.com/Staff_Nihil" class="btn btn-default btn-lg Fb-color" target="_blank"><i class="fa fa-twitter fa-2x"></i> <span class="network-name">Twitter</span></a><br><br>
                <a href="http://www.esgi.fr/ecole-informatique.html" class="btn btn-default btn-lg Fb-color" target="_blank"><i class="fa fa-graduation-cap fa-2x"></i> <span class="network-name">ESGI</span></a>
            </div>

            <div class="col-lg-1"></div>

            <div class="col-lg-6">

                <legend class="text-center contact-title">Contact</legend>
                     <div class="col-xs-1"></div>
                        <form class="col-lg-10" method="POST" action=""> 

                                <div class="form-group">
                                  <label for="select">Email : </label>
                                      <input name="mailContact" type="text" class="form-control" value="nihil.staff@gmail.com">
                                </div>

                                <div class="form-group">
                                    <label for="text">Objet</label>
                                    <input name="objet" type="text" class="form-control" placeholder="Objet de votre message">
                                </div>

                                <div class="form-group">
                                    <label for="text">Message</label>
                                    <textarea name="comment" class="form-control" placeholder="Votre message"></textarea>
                                </div>

                                <button class="btn btn-primary">Envoyer</button>
                        </form> 
                    <div class="col-xs-1"></div>
            </div>
        </div>   

    </div>
</body>