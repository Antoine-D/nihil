    <div class="col-xs-12">
        <div id='ressource_display' class="ressource"></div>
    </div>
    <?php
        
        $query = $bdd->prepare("SELECT option_ressources FROM member WHERE Member_ID = :member");
        $query->execute(['member'=>$_SESSION['Member_ID']]);
        $result = $query->fetch();
		echo "	<script>
        			update(".$result['option_ressources'].");
    			</script>";
        
    ?>