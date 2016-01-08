
<html lang="en">
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
      <li><a href="#" onclick="changecategory('all')">Semua</a></li>
      <?php foreach ($categories as $c) {
        echo '<li><a href="#" onclick="changecategory('.$c->cat_id.',this)">'.$c->cat_name.'</a></li>';
     }?>              
      </ul>

    <!--   <ul id="dropdown2" class="dropdown-content" style="width:300px">
          <li><a href="#" onclick="">Peta</a></li>
          <li><a href="#" onclick="">Daftar</a></li>           
      </ul>
 -->
  <nav class="navbar-fixed">
    <div class="nav-wrapper blue-grey darken-3">
      <a href="#!" class="brand-logo" style="margin-left:10px"><img style="margin-top:5px;"src="<?php echo res_folder('images/ipsd-logo.png')?>"></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li id="catmenu"><a class="dropdown-button" data-activates="dropdown1" href="#"><i class="material-icons left">store</i>Pilih Kategori</a></li>
        <!-- <li id="catmenu"><a class="dropdown-button" data-activates="dropdown2" href="#"><i class="material-icons left">store</i>Tampilan</a></li> -->
        <!-- <li id="mapmenu"><a href="<?php echo make_url('welcome/map')?>"><i class="material-icons left">language</i>Tampil Peta</a></li>
        <li id="listmenu"><a href="<?php echo make_url('welcome/places')?>" onclick="addmarker();"><i class="material-icons left">view_list</i>Tampil Daftar</a></li> -->
        <!-- <li><a href="sass.html"><i class="material-icons left">stars</i>Peringkat</a></li> -->
        
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
            <li>
              <a class="collapsible-header" >Pilih Kategori<i class="mdi-navigation-arrow-drop-down"></i></a>
              <div class="collapsible-body">
                <ul>
                    <?php foreach ($categories as $c) {
                      echo '<li><a href="#" onclick="changecategory('.$c->cat_id.',this)">'.$c->cat_name.'</a></li>';
                   }?>
                </ul>
              </div>
            </li>
          </ul>
        </li>
<!--         <li><a href="<?php echo make_url('Welcome/map')?>"><i class="material-icons left">language</i>Tampil Peta</a></li>
        <li><a href="<?php echo make_url('Welcome/places')?>"><i class="material-icons left">view_list</i>Tampil Daftar</a></li> -->
        <!-- <li><a href="sass.html"><i class="material-icons left">stars</i>Peringkat</a></li> -->
      </ul>
    </div>
  </nav>


  <?php
    echo load_js('jQuery/jQuery-2.1.4.min.js');    
    echo load_js('Materialize/materialize.min.js');    
    echo load_css(res_folder('css','infowindow.css'));
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