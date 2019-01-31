<?php 
require 'header.php';
require 'sidebar.php';


if(isConnected() && VerifBan($_SESSION['Mail']) ) {
        
    $bdd = connectBdd();

    $result = $bdd->prepare('SELECT * FROM member WHERE Member_ID = :member');
    $result->execute(['member'=>$_SESSION['Member_ID']]);
    $data = $result->fetch();
}
?>
<div class="container-fluid font">
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
                <form method="POST" action="validate.php?part=1" class="option-form">
                    <br><input type='text' name="pseudo" value="<?php echo $data['Pseudo']?>" placeholder="votre Pseudo"></br>

                   </br><input type='text' value="<?php echo $data['Mail']?>" placeholder="votre Email"></br>
                   </br><input type='mail' name="new_mail" placeholder="Nouvel Email"></br>
                   </br><input type='mail' name="new_mail2" placeholder="Confirmez"></br></br>

                   <input type='password' name="pwd" placeholder='Entrez ancien mot de passe'></br></br>
                   <?php    
		                foreach ($_SESSION['error_subscription'] as $error) {
		                	if($error == 4) {
		                    	echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
		                  	}
		                }
		            ?>
                   <input type='password' name="pwd2" placeholder='Nouveau mot de passe'></br></br>
                   <input type='password' name="pwd3" placeholder='Confirmez mot de passe'></br></br>
                   <button>Valider les modifications</button><br><br>
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
                <form method="post" action="validate.php?part=2" class="option-form">
                	<?php
                    echo "	<input type='checkbox' name='score' class='check' ".(($data['option_score'] == 1) ? "checked='checked'" : "")."><br><br>
                    		<input type='checkbox' name='ressources' class='check' ".(($data['option_ressources'] == 1) ? "checked='checked'" : "")."><br><br>";
                    ?>
                    <select name="theme" class="theme">
                        <?php                               
                        foreach ($list_of_themes as $key => $theme) {    
                            echo "<option ".(($data["theme_id"] == $key) ? "selected='selected'" : "") . "value='".$key."'>".$theme."</option>";
                        }                        
                        ?>
                    </select><br><br>
                    <button>Valider les modifications</button><br><br>
                </form>
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
                        <td><a onclick="<?php echo 'delete_('.$_SESSION['Member_ID'].')';?>">Supprimer le compte</a></td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-6">
                <br>
                <form method="POST" action="validate.php?part=3" class="option-form">
                    <?php echo "<input type='checkbox' name='holidays' class='check' ".(($data['option_holidays'] == 1)? "checked='checked'":"")."><br><br>" ?>
                    <br><br><br><button>Valider les modifications</button><br><br>
                </form>
                <br>
            </div>
            <div class="col-xs-2"></div>
        </div>
    </div>
    <div class="4"></div>
</div>