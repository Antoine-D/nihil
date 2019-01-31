<?php 
require 'header.php';
require 'sidebar.php';


 if (isConnected() ) {
        
        $bdd = connectBdd();
        $result = $bdd->prepare('SELECT * FROM member');
        $result->execute();
        $data = $result->fetch();
 
    if ( !isset($data["Member_ID"])) {

            header("Location: game.php");

        }
        if ( empty($data) ) {
            
             header("Location: options.php");
            
        }else if ( empty($_POST)) {
            
            $_POST = $data;
            
        }
 }
?>
<div class="container-fluid font" style="border: 1px solid black;">
    <div class="row">
        
        <div class="col-xs-1"></div>
        <div class="col-xs-7">
            <br>
            <legend class="text-center">Données de l'utilisateur</legend>
            <div class="col-xs-6">
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Pseudo</td>
                    </tr>
                </table>
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Adresse Email courante</td>
                    </tr>
                </table>
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Nouvelle adresse Email</td>
                    </tr>
                </table>
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Confirmez</td>
                    </tr>
                </table>
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Ancien mot de passe</td>
                    </tr>
                </table>
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Nouveau mot de passe</td>
                    </tr>
                </table>
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Confirmez</td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-6">
                <form method="post" action="options.php" class="option-form">
                    <br><input type='text' value="<?php echo $_SESSION['Pseudo']?>" placeholder="votre Pseudo"></br>

                   </br><input type='text' value="<?php echo $_SESSION['Mail']?>" placeholder="votre Email"></br>
                   </br><input type='text' value="" placeholder="Nouvel Email"></br>
                   </br><input type='text' value="" placeholder="Confirmez"></br></br>

                   <input type='text' placeholder='Ancien mot de passe'></br></br>
                   <input type='text' placeholder='Nouveau mot de passe'></br></br>
                   <input type='text' placeholder='Confirmer mot de passe'></br></br>

                </form>
            </div>
            <legend class="text-center"><br>Options générales</legend>
            <div class="col-xs-6">
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Être affiché dans les records</td>
                    </tr>
                </table>
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Actualisation automatique des ressources</td>
                    </tr>
                </table>
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Changer de thème</td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-6">
                <br>
                <form>
                        <input type="checkbox" name="record" class="check">
                </form>
                <br>
                <form>
                        <input type="checkbox" name="record" class="check">
                </form>
                <br>
                <select name="theme" class="theme">
                    <?php
                    foreach ($list_of_themes as $key => $value) {           
                         echo "<option>".$value ."</option>";
                       };
                    ?>
                </select>
            </div>
            <legend class="text-center"><br>Options du compte</legend>
            <br>
            <div class="col-xs-6">
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Mode vacance</td>
                    </tr>
                </table>
                <br>
                <table border="1" class="option-tab">
                    <tr>
                        <td>Supprimer le compte</td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-6">
                <br>
                <form>
                        <input type="checkbox" name="record" class="check">
                </form>
                <br>
                <form>
                        <input type="checkbox" name="record" class="check">
                </form>
            </div>
        <div class="col-xs-2"></div>
    </div>
</div>
<div class="4"></div>