<?php
    require 'init.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <?php 
        
        if ( isConnected() ){
        
            $bdd = connectBdd();
            $query = $bdd->prepare("SELECT theme_id FROM member WHERE Member_ID = :id");
            $query->execute([
                "id"=>$_SESSION['Member_ID']
            ]);
            $result = $query->fetch();

            ?>
            <meta charset="utf-8">
            <meta name="google-site-verification" content="cid4TRC5P5B0WOLbLMUJ3pUrNdMXaVTvH9McsmrOy3w">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="keywords" content="nihil, game, nihil-game, jeu, startégie, egypte, NIHIL, GAME, NIHIL-GAME, Egypte, EGYPTE, STRATEGIE">
            <meta name="description" content="Nihil-game jeu de stratégie en ligne sur le thème de l'Egypte Antique ! venez vous amuser !">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="shortcut icon" type="image" href="/image/favicon.ico" />
            <title>NiHil</title>
            <link href="boostrap/css/bootstrap.css" rel="stylesheet">
            <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
            <?php
                if ( $result['theme_id'] == 0) {
            echo "<link href='style.css' rel='stylesheet' type='text/css'>";
                }
            else {
                if ( $result['theme_id'] == 1 ){
                    echo "<link href='style2.css' rel='stylesheet' type='text/css'>";
                }
                else {
                    if ( $result['theme_id'] == 2 ){
                        echo "<link href='style3.css' rel='stylesheet' type='text/css'>";
                    } 
                    else {
                        echo "<link href='style4.css' rel='stylesheet' type='text/css'>";
                    }
                }
            }
            ?>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="js/animation.js"></script>
            <script src="js/code.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="boostrap/js/bootstrap.js"></script>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <?php
        }
        else {
            ?>
            <meta charset="utf-8">
            <meta name="google-site-verification" content="cid4TRC5P5B0WOLbLMUJ3pUrNdMXaVTvH9McsmrOy3w">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="keywords" content="nihil, game, nihil-game, jeu, startégie, egypte, NIHIL, GAME, NIHIL-GAME, Egypte, EGYPTE, STRATEGIE">
            <meta name="description" content="Nihil-game jeu de stratégie en ligne sur le thème de l'Egypte Antique ! venez vous amuser !">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="shortcut icon" type="image" href="/image/favicon.ico" />
            <title>NiHil</title>
            <link href="boostrap/css/bootstrap.css" rel="stylesheet">
            <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
            <link href='style.css' rel='stylesheet' type='text/css'>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="js/animation.js"></script>
            <script src="js/code.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="boostrap/js/bootstrap.js"></script>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <?php  
        }
        ?>
    </head>
    
    <body>
        <section id="section">
            <header>
                <nav>
                    <!-- navbar navbar-default -->
                    <div class="navbar navbar-default" role="navigation">
                        <div class="container">
                            <!-- navbar-header -->
                            <div class="navbar-header page-scroll">

                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <?php
                                if (isConnected()){
                                ?>
                                    <a href="game.php" class="navbar-brand"><img class="img" src="image/nihil.png"></a>
                                <?php
                                    }else
                                    {
                                ?>
                                <a href="index.php" class="navbar-brand"><img class="img" src="image/nihil.png"></a>
                                <?php
                                    }
                                ?>
                            </div>
                            <!-- /navbar-header -->

                            <!-- navbar -->

                            <div class="navbar-collapse collapse" style="height: 1px;">
                                <?php
                                    if (isConnected()){
                                ?>
                                <ul class="nav navbar-nav">
                                    <li id='notif'>
                                        <a href="mail.php"><span class="fa fa-envelope"></span> Messages</a>
                                    </li>
                                    <li>
                                        <a href="contact.php">Contact</a>
                                    </li>
                                    <?php 
                                        if (isAdmin()){
                                    ?>
                                    <li>
                                        <a href='backOffice.php'>Back-office</a>
                                    </li>
                                    <?php    
                                        }  
                                    ?>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <a href="options.php"><span class="fa fa-cog"></span> Options</a>
                                    </li>
                                    <li>
                                        <a href="logout.php"><span class="fa fa-sign-out"></span> Se deconnecter</a>
                                    </li>
                                </ul>  
                                <?php
                                    echo "  <script>
                                                notif();
                                            </script>";
                                    }else{
                                ?>
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="new.php">News</a>
                                    </li>
                                    <li>
                                        <a href="contact.php">Contact</a>
                                    </li>
                                    <li class="page-scroll">
                                        <a href="#story">Histoire</a>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <a href="subscription.php">
                                            <span class="fa fa-user">
                                            </span> Inscription
                                        </a>
                                    </li>
                                    <li>
                                        <a data-toggle="modal" data-target="#myModal" >
                                            <span class="fa fa-sign-in">
                                            </span> Se connecter
                                        </a>
                                    </li>
                                </ul>
                                <?php
                                    }
                                ?>
                            </div><!-- /navbar -->
                        </div>
                    </div><!-- /navbar navbar-default -->
                </nav>
            </header>