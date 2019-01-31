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
                        <p class="scorp">Alharbi, la force brute. Ils règnent sur le royaume tout entier et imposent leur domination au sein du peuple. SANANIS Le Grand
                        				 chef des armées Alarbique, contrôle la totalité du territoire Egyptien et fait de chaque membre de son peuple un ouvrier, un soldat ou encore 
                        				 un forgeron pour accroître sa domination sur les différents pays. Le territoire Alharbique est en conflit permanent avec
                        				 les Sharkis, logés de l'autre côté du Nil. Ces derniers sont un groupe de soldats rebelles qui refusent l'autorité exercée par SANANIS Le Grand
                        				 sur l'empire Egyptien. Pour montrer sa grandeur il n'hésite pas à faire prisonnier autant que possible les membres des Sharkis
                        				 pour les torturer et récupérer des informations sur les stratégies d'attaques des Sharkis. Il n'hésite pas à faire de chaque rebelle une
                        				 nouvelle execution publique, toutes aussi sanglantes les unes que les autres. La guerre avec les rebelles Sharki est à son paroxysme
                        				  et SANANIS Le Grand n'a pas l'intention de leur laisser le moindre répit.</p>
                    <div class="col-lg-12 text-center">
                        <form method="post" action="subscription.php">
                            <input type="hidden" name="Faction" value="Alharbi">
                            <button class="btn btnn btn-warning btn-scroll">Rejoindre !</button>
                        </form>
                    </div>
                    </div>
                    <div class="col-lg-6">
                        <p class="titre">Sharki</p>
                        <p class="serp">Sharki, l'intelligence et la reflexion incarnée. Les Sharki, dirigés par l'humble CHERFAWI, sont la rebellion qui s'élève
                        				contre l'état Alharbique et ses méthodes qu'ils jugent trop impitoyables. Ils se battent chaque jour contre l'état 
                        				Alharbique pour fragiliser son pouvoir. Leur dessein bien qu'honorables, implique des méthodes plus qu'immorales: chantages,
                        				enlèvements, assassinats, attentats... dans le seul but d'arriver à leur fin. La rebellion grandissante, on peut entendre de
                        				plus en plus leur hymne parcourir les rivages du Nil: l'hymne ZizeZize. Les deux camps sont en grand conflit depuis plusieurs années
                        				maintenant et la guerre n'est pas près de se terminer. Les attaques sont de plus en plus massives et impréssionantes de chaque côté du 
                        				rivage, les bateaux coulent, les soldats périssent au combat. Qui vaincra ? Qui dominera ? A toi de le décider</p>
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
