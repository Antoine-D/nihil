            <?php 
                require 'header.php'; 
                require 'pop-up.php';
            ?>

            <div class="container fadein">
             <div class="row">
                    <div class="col-lg-12">
                        <img class="img-responsive imgd" src="image/Nihil.png">
                        <?php

                        if(isset($_SESSION['connection'])){
                        $_POST=$_SESSION['connection'];

                        ?>
                        
                    <div class="modal-dialog modal-lg font">
                        <div class="modal-content">
                              <div class="row">
                                   <div class="col-lg-10"></div>
                                   <div class="col-lg-1">
                                       <br><button type="button" class="close" data-dismiss="modal"></button> 
                                   </div>
                                  <div class="col-lg-1"></div>
                              </div>    
                              <div class="row">
                                <div class="col-lg-2"></div>
                                  <form method="POST" action="verifPop-up.php" class="col-lg-8">
                                    <div class="form-group">
                                      <label for="texte">Mail : </label>
                                      <input name="Mail" id="text" value="<?php echo (isset($_POST['Mail']))?$_POST['Mail']:""; ?>" type="email" class="form-control" placeholder="Mail">
                                      <?php    
                                        foreach ($_SESSION['error_connection'] as $error) {
                                          if($error == 15) {
                                            echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
                                          }
                                          if($error == 16) {
                                            echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
                                          }
                                        if($error == 17) {
                                            echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
                                          }
                                         if($error == 18) {
                                            echo"<ul class='deco-none list-group'><li class='list-group-item2'><div class='alert alert-danger'><strong>".$list_of_errors[$error]."</strong></div></li></ul>";
                                          }
                                        }
                                      ?>
                                    </div>
                                    <div class="form-group">
                                      <label for="texte">Mot de passe : </label>
                                      <input name="Password" id="text" value="" type="password" class="form-control" placeholder="Mot de passe">
                                    </div>
                                    <div class="col-lg-2"></div>
                                      <button class="btn btnn btn-warning col-lg-8">Valider</button>
                                    <div class="col-lg-2"></div>
                                  </form>
                                <div class="col-lg-2"></div>
                            </div>
                            <div class="row forgetPwd">
                              <div class="col-lg-6">
                                <a href="forgetPwd.php">Mot de passe oublié ?</a>
                              </div>
                            </div>
                        </div>
                        <?php
                          session_destroy();
                          }else {
                              header("Location: game.php");
                          }
                        ?> 
                    </div>
                 </div>
                 <div class="col-lg-4"></div>
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
