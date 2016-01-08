

<style>
body{background-color: #e3dfdf}

</style>

<div class="card" style="width:500px;margin-top:75px;margin-right:auto;margin-left:auto;">    
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Ganti | <b>Password</b></span>
      
     <?php if((isset($login_error))||(validation_errors()==true)) {?> 
        <div class="card-panel teal">
          <span class="white-text"><?php echo $login_error;?>
          </span>
        </div>
          <?php }?>     


        <form class="col s12" method="POST" action="<?php echo make_url('placess/resetpass');?>">
      <div class="row">
    
        <div class="input-field col s12">
          <i class="material-icons prefix">vpn_key</i>
          <input id="icon_telephone" type="password" class="validate" name="old_pass">
          <label for="icon_telephone">Password Lama</label>
        </div>

            <div class="input-field col s12">
          <i class="material-icons prefix">vpn_key</i>
          <input id="icon_telephone" type="password" class="validate" name="new_pass">
          <label for="icon_telephone">Password Baru</label>
        </div>

            <div class="input-field col s12">
          <i class="material-icons prefix">vpn_key</i>
          <input id="icon_telephone" type="password" class="validate" name="new_pass2">
          <label for="icon_telephone">Konfirmasi Password Baru</label>
        </div>

        <div class="input-field col s12"><center>            
            <button class="btn waves-effect waves-light" type="submit" name="action">Ganti</button>
        </center>
        <div>
      </div>
    </form>
    </div>
 
  </div>


</body>





</html>