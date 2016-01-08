<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>IPSD - Ver 1.0 Beta</title>

  <!-- CSS  -->
  <?php
  echo load_css(res_folder('css','materialize.min.css'));
  echo load_css(res_folder('font','material_icon.css'));

  ?>
</head>
<body>

  <ul id="dropdown1" class="dropdown-content" style="width:300px">
    <li><a href="<?php echo make_url('manage/changepass')?>">Ganti Password</a></li>
    <li><a href="<?php echo make_url('login/out')?>">Keluar</a></li>                
  </ul>
  <div class="navbar-fixed">
    <nav class="blue-grey darken-3">
      <div class="col s10 nav-wrapper blue-grey darken-3" style="width:83.33%;margin:0 auto">      
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down">        
          <li><a href="<?php echo make_url('manage/')?>"><i class="material-icons left">assessment</i>Dashboard</a></li>
          <li><a href="<?php echo make_url('manage/general')?>"><i class="material-icons left">business</i>Data Umum</a></li>
          <li><a href="<?php echo make_url('manage/about')?>"><i class="material-icons left">business</i>Profil Singkat</a></li>
          <li><a href="<?php echo make_url('manage/services')?>"><i class="material-icons left">contact_phone</i>Edit Layanan</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">          
          <li><a class="dropdown-button" data-activates="dropdown1" href="#"><i class="material-icons left">lock</i>Atur Account</a></li>       
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="<?php echo make_url('manage/')?>"><i class="material-icons left">assessment</i>Dashboard</a></li>
          <li><a href="<?php echo make_url('manage/general')?>"><i class="material-icons left">business</i>Data Umum</a></li>
          <li><a href="<?php echo make_url('manage/about')?>"><i class="material-icons left">business</i>Profil Singkat</a></li>
          <li><a href="<?php echo make_url('manage/services')?>"><i class="material-icons left">contact_phone</i>Edit Layanan</a></li>
          <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
              <li>
                <a class="collapsible-header">Atur Account<i class="mdi-navigation-arrow-drop-down"></i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="<?php echo make_url('manage/changepass')?>">Ganti Password</a></li>
                    <li><a href="<?php echo make_url('login/out')?>">Keluar</a></li>                          
                  </ul>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <style>
  html,body{height: 100%;}

  html{font-family: sans-serif;background-color: #e3dfdf}

  .page-title{height: 80px;margin-left:0.75rem}
  .title{color:#fff;}
  .divider{margin:20px;}
  p{margin-left: 10px;margin-right: 10px;margin-top: 35px}

  </style>

<?php
    echo load_js('jQuery/jQuery-2.1.4.min.js');    
    echo load_js('Materialize/materialize.min.js');    
  ?>


  <script type="text/javascript">
  $(document).ready(function(){
    $('.button-collapse').sideNav({
          menuWidth: 300, // Default is 240
          edge: 'left', // Choose the horizontal origin
          closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
        }
        );
});

</script>