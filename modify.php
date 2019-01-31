<?php
    require "header.php";
    // Verifier que l'user soit connecté
    
if(isConnected()) {
    if(isAdmin()) {
        if(!isset($_GET["Member_ID"])){
            header("Location: game.php");
        }
        $bdd = connectBdd();
        if(isset ($_POST['Password']) && isset ($_POST['passwordverif'])) {
            if(!empty( $_POST['Password'])) {
                VerifPassword($_POST["Password"], $_POST["passwordverif"]);
                $_POST['Password'] = password_hash($_POST['Password'], PASSWORD_DEFAULT);
                $queryp = $bdd->prepare("UPDATE member SET Password = :Password WHERE Member_ID = :Member_ID");
                $_POST['Member_ID'] = $_GET['Member_ID'];
                $queryp->execute(["Password"=>$_POST['Password'],
                                  "Member_ID"=>$_POST['Member_ID']]);
                unset($_POST["passwordverif"]);
            }else{
                unset($_POST["Password"]);
            }
        }

        if(isset ($_POST['Pseudo']) &&
            isset ($_POST['Mail'])  &&
            isset ($_POST['Privileges']) &&
            isset ($_POST['Faction'])) {

            $_POST['Pseudo'] = trim($_POST['Pseudo']);
            unset($_SESSION["error_subscription"]); //Détruit la variable de session
            VerifPseudo ( $_POST["Pseudo"]);
            VerifFaction($_POST['Faction']);

            if(!isset($_SESSION["error_subscription"])) {
                if($_POST['Faction'] == $list_of_faction[0]) {
                    $_POST['Faction'] = 0;
                }else{
                    if($_POST['Faction'] == $list_of_faction[1]) {
                        $_POST['Faction'] = 1;
                    }
                }
                $query = $bdd->prepare("UPDATE member
                                        SET Mail = :Mail, Pseudo = :Pseudo, Privileges = :Privileges, Faction =:Faction
                                        WHERE Member_ID = :Member_ID"); 
                $_POST['Member_ID'] = $_GET['Member_ID'];

                $query->execute([
                                    "Mail"=>$_POST['Mail'],
                                    "Pseudo"=>$_POST['Pseudo'],
                                    "Privileges"=>$_POST['Privileges'],
                                    "Faction"=>$_POST['Faction'],
                                    "Member_ID"=>$_POST['Member_ID']
                                ]);

                header("Location: http://www.nihil-game.fr/game.php");
            }else{
                if (isset($_SESSION["subscription"])) {
                    echo "<ul>";
                    foreach ($_SESSION['error_subscription'] as $error) {
                        echo "<li>".$list_of_errors[$error]."</li>";
                    }
                    echo "</ul>";
                }
            }
        }
        
        $query = $bdd->prepare("SELECT * FROM member WHERE Member_ID = :Member_ID");
        $query->execute(["Member_ID" => $_GET["Member_ID"]] );
        $data = $query->fetch();
            
        if(empty($data)) {
            header("Location: backOffice.php");
        }else if ( empty($_POST)) {
            $_POST = $data;
        }  
    ?>
    <body class="head2 font">
        <div class="col-xs-5"></div>
        <div class="col-xs-2">
            <form method="post" action="modify.php?Member_ID=<?php echo $_GET["Member_ID"]?>">
               </br><input type='text' name='Pseudo' value="<?php echo $data['Pseudo']?>" placeholder="votre Pseudo"></br>
               </br><input type='text' name='Mail' value="<?php echo $data['Mail']?>" placeholder="votre Email"></br></br>

            <select name="Privileges">
                <?php
                foreach ($list_of_privileges as $key => $value) {
                     echo "<option ".(($_POST["Privileges"]-1 == $key) ? "selected='selected'" : "")."value='".$value."'>".$value."</option>";
                   };
                ?>
            </select>
            <br><br>
            <input type='password' placeholder='mot de passe'  name='Password'></br></br>
            <input type='password' placeholder='confirmer mot de passe'  name='passwordverif'></br></br>

            <select  name='Faction'>
                <?php
                foreach ($list_of_faction as $key => $value) {
                    echo "<option ".(($_POST["Faction"]-1 == $value) ? "selected='selected'" : "")."value='".$value."'>".$value."</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <button class="btn btn-warning">Envoyer</button>

            </form>
        </div>
        <div class="col-xs-5"></div>
    </body>
    
    <?php
        
    }
    else{
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p>";
        echo "<p class='text-center'>Cliquez <a href='game.php'>ici</a> pour retourner sur la page de jeu.</p>";
    }
}
else {
    echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
    echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
}
  