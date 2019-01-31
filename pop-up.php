  <!-- Modal -->
<div class="modal fade font" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
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
                      <input name="Mail" id="text" type="email" class="form-control" placeholder="Mail">
                    </div>
                    <div class="form-group">
                      <label for="texte">Mot de passe : </label>
                      <input name="Password" id="text" type="password" class="form-control" placeholder="Mot de passe">
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
    </div>
</div>