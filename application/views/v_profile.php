
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



  <nav class="navbar-fixed">
    <div class="nav-wrapper blue-grey darken-3">
        <a href="#" class="brand-logo" style="font-size:20px;margin-left:20px"><?php echo $data->place_name;?></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="<?php echo make_url();?>"><i class="material-icons left">language</i>Halaman Depan</a></li>
         </ul>
      <ul class="side-nav" id="mobile-demo">
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
            <li><a ref="<?php echo make_url();?>"><i class="material-icons left">language</i>Halaman Depan</a></li>
          </ul>
        </li>
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


  <div class="container">
    <div class="section content z-depth-1" style="margin-top:50px">

      <!--   Icon Section   -->
      <div class="row">
      <nav class="blue-grey darken-1 z-depth-0">    
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="#">Nilai Keseluruhan <?php echo$rating;?></a></li>        
      </ul>    

      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li class="active"><a href="#">Profil Unit</a></li>
        <li><a href="<?php echo make_url('places/review/').$data->place_id?>">Review Masyarakat</a></li>        
      </ul>    
  </nav>
		<div class="col s12 m12">
			<div class="col s12 m4 left-side">
				<img src="<?php echo res_folder('images/profile/'.$data->place_image);?>" alt="" class="circle user-img responsive-img">
			  <hr>
	
			  <div class="block">
				
					<p><i class="mdi-maps-pin-drop indigo-text"></i> <?php echo $data->place_address;?><br>
					<i class="mdi-communication-phone indigo-text"></i> <?php echo $data->place_phone1;?><br>
					<i class="mdi-communication-email indigo-text"></i> <?php echo $data->place_email;?><br>
					<i class="mdi-content-link indigo-text"></i> <a href=<?php echo '"'.$data->place_website.'"'?> class="indigo-text" target="_blank"><?php echo $data->place_website;?></a>
					</p>
			  </div>

			    <div class="block">
				<h5 class="left-align"><i class="mdi-maps-map"></i>
					Peta 
				</h5>
					<?php echo $map['html']; ?> 
			  </div>

			
        </div>

			<div class="col s12 m8 right-side">
			
          <div class="block">
            
			<h5><i class="mdi-social-domain"></i> Profil</h5>			
            <p><?php echo $data->place_description;?></p>
          </div>
	
		  <h5 class="left-align"><i class="mdi-social-pages"></i> Daftar Layanan</h5>
		  <div class="block">
		  <div class="row">
			    <?php foreach ($services as $d) {?>                            
		        <div class="col s12 m4 l4">
		          
		          <div class="card" id="<?php echo 'card'.$d->service_id;?>">                   
		          <a onclick="serviceinfo(<?php echo $d->service_id;?>)">
		            <div class="card-image waves-effect waves-block waves-light">
		              <img class="activator" src="<?php echo res_folder('images/services/display/'.set_data($d->service_image,'avatar.png'));?>">
		            </div>
		            <div class="card-content">
		              <span class="card-title activator grey-text text-darken-4"><?php echo simplify_text($d->service_name,15);?></span>		          
		            </div></a>

		            
		          </div>
		        </div>
		        <?php }?>	

		</div>
		</div>
		</div>
      </div>
    </div>

  </div>


 <div id="modal1" class="modal" style="display: none; opacity: 1; top: 10%;">
              <div class="modal-content" style="padding: 0;">
                <nav class="blue-grey">
                  <div class="nav-wrapper">
                    <div class="left col s12 m5 l5">
                      <ul>
                        <li><a href="#!" class="email-menu"><i class="modal-action modal-close  mdi-hardware-keyboard-backspace"></i></a>
                        </li>
                      </ul>
                    </div>                     
                  </div>
                </nav>
              </div>
              <div class="modal-content main-content">
                
              </div>
            </div>

  <!--  Scripts-->
  <?php		
    echo load_js('jQuery/jQuery-2.1.4.min.js');    
    echo load_js('Materialize/materialize.min.js');  
	echo load_js('profile/slider.js');   
	echo load_js('profile/hammer.min.js');   
	echo load_js('profile/cards.js');   
	echo load_js('profile/init.js');  
	

?>

<script type="text/javascript">
function serviceinfo(id){  
  $.ajax({
    url: '<?php echo make_url("services/getinfo/")?>' + id,
    success: function(data){      
      $('.main-content').empty();
      $('.main-content').append(data);
      $('#modal1').openModal();
    }
  });
}

</script>


 <style>
 body {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
  /*background-color: #efefef;*/
}

.truncate {
    /*display: inline;*/
    white-space: normal; 
    margin-right: 30px;
}

.section{
	padding-top: 0;
    padding-bottom: 0;
}

.container .row {
    margin-left: 0;
    margin-right: 0;
    padding-bottom: 100px;
    }

.secondary-content{
	top:8px !important;
	font-size: 12px;
}

footer {position:fixed;left:0px; bottom:0px; width:100%;z-index: 100}
</style>

</div>
    <footer class="page-footer" style="margin-top:0px;padding-top:0px">       
    <div class="footer-copyright blue-grey darken-3">
      <div class="container" style="width:95%">
        © 2015 Indonesia Public Service Directory 
      </div>
    </div>
  </footer>  
  </body>

<?php echo $map['js'];     
?>

  </html>