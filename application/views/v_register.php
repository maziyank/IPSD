
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

<div class="card" style="width:500px;margin-top:10px;margin-right:auto;margin-left:auto;">    
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Institusi | <b>Register</b></span>
      
     <?php if((isset($register_error))||(validation_errors()==true)) {?> 
        <div class="card-panel teal">
          <span class="white-text"><?php echo $register_error;?>
          </span>
        </div>
          <?php }?>     


        <form class="col s12" method="POST" action="<?php echo make_url('register/signup');?>">
      <div class="row">
        <div class="input-field col s12">
          
          <input id="icon_prefix" type="text" class="validate" name="name" value="<?php echo set_value('name');?>">
          <label for="icon_prefix">Nama</label>
        </div>

        <div class="input-field col s12">          
          <input id="icon_prefix" type="text" class="validate" name="email" value="<?php echo set_value('email');?>">
          <label for="icon_prefix">Email</label>
        </div>

        <div class="input-field col s12">
          
          <input id="icon_prefix" type="text" class="validate" name="address" value="<?php echo set_value('address');?>">
          <label for="icon_prefix">Alamat</label>
        </div>

       <div class="input-field col s12">
              <select id="category" name="category">

                <option value="" disabled selected>Pilih Kategori</option>
                <?php foreach ($categories as $c) {?>              
                <option <?php if(set_value('name')==$c->cat_id) 'Selected'?> value="<?php echo $c->cat_id;?>"><?php echo $c->cat_name;?></option>            
                <?php }?>
              </select>
             </div> 


        <div class="input-field col s12">
          
          <input id="icon_prefix" type="text" class="validate" name="username" value="<?php echo set_value('username');?>">
          <label for="icon_prefix">Username</label>
        </div>

        <div class="input-field col s12">
          
          <input id="icon_telephone" type="password" class="validate" name="password" value="">
          <label for="icon_telephone">Password</label>
        </div>



        <div class="input-field col s12"><center>
            <button class="btn waves-effect waves-light" onclick="history.go(-1)" type="button" name="action">Kembali</button>
            <button class="btn waves-effect waves-light" type="submit" name="action">Daftar</button>
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

<script type="text/javascript">
   $('select').material_select();

</script>


</html>