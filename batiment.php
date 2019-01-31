<?php 
require 'header.php'; 

if ( isConnected() && VerifBan($_SESSION['Mail']) ){
    
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
                            <table class="table-bat building_display"></table>
                        </div>
                    </div>
                </div>
                <?php 
                    require 'jauge.php';
                ?>
            </div>
        </div>
    </section>
    <?php
    echo "
    <script>
        build(10);
    </script>";
    ?>
</body>
<?php 
}
else {
        echo "<p class='text-center'>Vous n'êtes pas autorisé à accéder à ce contenu.</p><br>";
        echo "<p class='text-center'>Cliquez <a href='index.php'>ici</a> pour retourner sur la page d'index.</p>";
    }
?>