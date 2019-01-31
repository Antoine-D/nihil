<?php 
require 'header.php'; 

if ( isConnected()){
    
   $bdd = connectBdd();
    
?>
<body class="head2 font">
    <section>
        <div class="container-fluid">
              <div class="row">
                   <div class="text-center">
                       <?php require "ressource.php"; ?>
                   </div>
            </div>
            <div class="row">
                <?php require 'sidebar.php'; ?>
                <div class="main-box col-md-8">
                        <div class="col-md-12 text-center">
                            <?php require "nav.php"; ?>
                        </div>
                    <div class="col-md-12">
                        <div class="box-bat text-center">
                            <table border="1" class="table-bat">
                                <tr>
                                    <td class="td-img">image</td>
                                    <td class="td-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                    <td class="td-up"><button class="btn btn-success">UP</button></td>
                                </tr>
                                <tr>
                                    <td class="td-img">image</td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                    <td class="td-up"><button class="btn btn-success">UP</button></td>
                                </tr>
                                <tr>
                                    <td class="td-img">image</td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                    <td class="td-up"><button class="btn btn-success">UP</button></td>
                                </tr>
                                <tr>
                                    <td class="td-img">image</td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                   <td class="td-up"><button class="btn btn-success">UP</button></td>
                                </tr>
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