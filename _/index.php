            <?php 
                require 'header.php'; 
                require 'pop-up.php';
            ?>

            <div class="container fadein">
             <div class="row">
                    <div class="col-lg-12">
                        <img class="img-responsive imgd" src="image/Nihil.png">
                        <div class="intro-text">
                            <hr class="star-light">
                            <div class="text">
                                <p>Nihil... <br>L'aventure commence maintenant.<br>Mais quel camp allez-vous choisir ?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="#story" class="btn btnn btn-warning btn-scroll">Histoire</a>
                    </div>
                </div>
            </div>
        </section>
        <section id="story">
            <div class="container size">
                <div class="row">
                    <div class="col-lg-12">
                        <img class="img-responsive hist imgd" src="image/histoires.png">
                        <hr class="star-light">
                    </div>
                </div>
                <div class="row hist">
                    <div class="col-lg-6">
                        <p class="titre">Alharbi</p>
                        <p class="scorp">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sintLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <div class="col-lg-12 text-center">
                        <form method="post" action="subscription.php">
                            <input type="hidden" name="Faction" value="Alharbi">
                            <button class="btn btnn btn-warning btn-scroll">Rejoindre !</button>
                        </form>
                    </div>
                    </div>
                    <div class="col-lg-6">
                        <p class="titre">Sharki</p>
                        <p class="serp">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sintLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <div class="col-lg-12 text-center">
                        <form method="post" action="subscription.php">
                            <input type="hidden" name="Faction" value="Sharki">
                            <button class="btn btnn btn-warning btn-scroll">Rejoindre !</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript">
                var c = document.getElementById("section");
                c.setAttribute("class", "head");
            </script>
        <?php require "footer.php";
        ?>
    </body>
