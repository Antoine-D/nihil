<div class="guild row">
    <div class="row" style="margin-top:5px;">
        <div class="col-md-4 text-left">
            <legend><br><p class="guild-name text-center"><?php echo $resultGuild['Name'];?></p></legend>
        </div>

        <div class="col-md-4 text-center"><img src="<?php echo $resultGuild['Logo'];?>" class="logo"></div>

        <div class="col-md-4 text-right">
            <legend><br><p class="text-center">[<?php echo $resultGuild['Tag'];?>]</p></legend>
        </div>
    </div> 

        <div class="row" style="margin-top:20px;">
            <div class="col-md-4"><legend><p class="text-center"> Liste des membres :</p></legend></div>

            <div class="col-md-7">
                <div class="text-center">
                    <?php

                        echo "<table border='1' class='member-list text-center'>";
                            echo "<tr>";
                                echo "<th class='text-center'>Pseudo</th>";
                                echo "<th class='text-center'>Rang</th>";   
                                if ( isGuildChief() ){
                                    echo "<th class='text-center'> Donner les droits </th>";
                                }
                            echo "</tr>";

                            echo "<tr>";
                            $GID = $_SESSION["Guild_ID"];

                            $request = $bdd ->prepare(" SELECT Pseudo, Guild_Rank, Member_ID FROM member WHERE Guild_ID =:GID ");
                            $request->execute([ "GID"=>$GID ]);

                                while ( $res = $request->fetch() ){
                                echo '<td>'.$res['Pseudo'].'</td>';
                                echo "<td>".rank($res['Guild_Rank'])."</td>";
                                if ( isGuildChief() ){
                                    echo "<td class='text-center'><a href='giveRights.php?Pseudo=".$res["Pseudo"]."'>Donner les droits</a></td>";
                                }
                            echo"</tr>";                                                            
                        }
                        echo "</table>";
                    ?>
                </div>
            </div>

            <div class="col-md-1"></div>
        </div>

        <div class="row" style="margin-top:20px;">
            <div class="col-md-4"><legend><p class="text-center">Description :</p></legend></div>

            <div class="col-md-7">
                <div class="description">
                    <?php
                            echo "<input type='text' class='desc-size disabled' ";
                    ?>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>

        <div class="row" style="margin-top:10%;">
            <div class="col-md-5"></div>
            <div class="col-md-2 text-center">
                <a href='exitGuild.php?Guild_ID="$GID"' class='btn btn-exit btn-danger'>Quitter la guilde</a><!-- exitGuilde.php?Guild_ID=".$data2['Guild_ID']." -->
            </div>
            <div class="col-md-5"></div>
        </div>
    </div>
</div>
 