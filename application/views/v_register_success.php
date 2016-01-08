
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

<div class="card" style="width:500px;margin-top:100px;margin-right:auto;margin-left:auto;">    
    <div class="card-content">
         <div class="row">
        <div class="input-field col s12"><center>
        <img style="margin-top:5px;" width="60%" src="<?php echo res_folder('images/ipsd-logo2.png')?>"></center>
        </div><div class="input-field col s12">
    <h4>Registrasi Selesai</h4>
    <p align="justify"> "Registrasi telah berhasil. Kami ucapkan terimakasih atas kesediannya untuk berkontribusi dalam IPSD. Akun anda sementara harus kami verifikasi terlebih dahulu. Kami akan mengaktifkan Akun anda pada kesempatan pertama setalah proses verifikasi selesai.</p>
    </div>

    <div class="right input-field col s12"><center>
     <button class="btn waves-effect waves-light" type="submit" onclick="window.location.href = '<?php echo make_url();?>'" name="action">Kembali</button></center></div>
   
     </div> 
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