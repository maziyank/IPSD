
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>IPSD - Ver 1.0 Be</title>

  <!-- CSS  -->
  <?php
    echo load_css(res_folder('css','materialize.min.css'));
    echo load_css(res_folder('font','material_icon.css'));
    
  ?>
</head>

<body>

<style>
body{background-color: #e3dfdf}

</style>

<div class="card" style="width:500px;margin-top:200px;margin-right:auto;margin-left:auto;">    
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Institusi | <b>Login</b></span>
      
     <?php if((isset($login_error))||(validation_errors()==true)) {?> 
        <div class="card-panel teal">
          <span class="white-text"><?php echo $login_error;?>
          </span>
        </div>
          <?php }?>     


        <form class="col s12" method="POST" action="<?php echo make_url('login/go');?>">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" class="validate" name="username">
          <label for="icon_prefix">Access Name</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">vpn_key</i>
          <input id="icon_telephone" type="password" class="validate" name="password">
          <label for="icon_telephone">Password</label>
        </div>

        <div class="input-field col s12"><center>
            <button class="btn waves-effect waves-light" onclick="history.go(-1)" type="button" name="action">Kembali</button>
            <button class="btn waves-effect waves-light" type="submit" name="action">Masuk</button>
        </center>
        <div>
      </div>
    </form>
    </div>
 
  </div>


</body>


<?php
    echo load_js('jQuery/jQuery-2.1.4.min.js');    
    echo load_js('Materialize/materialize.min.js');    
  ?>



</html>