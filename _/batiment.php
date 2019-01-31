<?php 
require 'header.php'; 

if ( isConnected()){
    
$bdd = connectBdd();
    
?>
<body class="head2 font">
    <section>
        <div class="container-fluid">
              <div class="row">
                   <?php require "ressource.php" ?>
            </div>
            <div class="row">
                <?php require 'sidebar.php'; ?>
                <div class="main-box col-md-8">
                        <div class="col-md-12 text-center">
                            <?php require "nav.php" ?>
                        </div>
                    <div class="col-md-12">
                        <div class="box-bat text-center">
                            <table class="table-bat">
                               <?php     
                                $result = $bdd->query("SELECT * FROM buildings_types");     
                                while ( $data = $result->fetch() ){
                                echo "
                                <tr>
                                    <td class='td-img'><img src=".$data['image']." class='logo'></td>
                                    <td class='td-desc'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                    <td id=".$data['name']."><a class='btn btn-success' href='up.php?id=".$data['id']."' onclick='Up(mine)'>UP</a></td>
                                </tr>";
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <?php 
                    require 'jauge.php'
                ?>
            </div>
        </div>
    </section>
</body>
<?php 
}
else {
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
        echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
    }
?>