
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

                      <div class="right col s12 m5 l5">
                      <ul>
                        <li><a href="#" onclick="$('#new_review').submit()" class="email-type">Kirim Review</a>
                        </li>
                      </ul>
                    </div>
           
           

                  </div>
                </nav>
              </div>
              <div class="model-email-content">
                <div class="row">
                  <form class="col s12" id="new_review" method="post">
                  <input id="place" type="hidden" value="<?php echo $data->place_id;?>" class="validate">
                      <div class="row" style="margin-bottom:0">
                      <div class="input-field col s12">
                        <input id="name" type="text" class="validate">                        
                        <label for="to_email">Nama Anda</label>
                      </div>
                    </div>

                    <div class="row" style="margin-bottom:0">
                      <div class="input-field col s12">
                        <input id="email" type="email" class="validate">
                        <label for="from_email">Email Anda</label>
                      </div>
                    </div> 
                    <div class="row" style="margin-bottom:0">
                      <div class="input-field col s12">
                        <textarea id="comment" class="materialize-textarea" length="500"></textarea>
                        <label for="compose" class="">Kritik/Masukan/Komentar</label>
                      </div>
                    </div>

                     <div class="row" style="margin-bottom:0">
                      <div class="input-field col s12">
                       
                       <select id="rating" class="rating">
                       <option value="1">Sangat Kecewa</option>
                         <option selected value="2">Kecewa</option>
                         <option value="3">Biasa Saja</option>
                         <option value="4">Puas</option>                        
                         <option value="5">Sangat Puas</option>                        
                      </select>

                      </div>
                    </div>


                     

                  </form>
                </div>
              </div>
            </div>

<div class="fixed-action-btn" style="bottom: 65px; right: 24px;">
              <a class="btn-floating btn-large red modal-trigger" onclick="newcomment()">
                <i class="large mdi-editor-mode-edit"></i>
              </a>
            </div>

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
    echo load_css(res_folder('plugins/barrating/themes','bars-pill.css'));


    
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


      <ul id="nav-mobile" class="right hide-on-med-and-down ">
        <li><a href="<?php echo make_url('places/detail/').$data->place_id?>">Profil Unit</a></li>
        <li class="active"><a href="#">Review Masyarakat</a></li>           
      </ul>    
  </nav>
		<div class="col s12 m12">
			<div class="col s12 m4 left-side">
				<img src="<?php echo res_folder('images/profile/'.$data->place_image);?>" alt="" class="user-img responsive-img">
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
		  <div class="row">
		        <div class="col s12 m12 l12">	  

		        <ul class="collection">                            
                  </ul>   
                  <div class="center-align"><button onclick="load_review(false)" id="morebtn" class="waves-effect waves-light btn">More..</button></div>
                        
		        </div>
		</div>
		</div>
		</div>
      </div>
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


 <style>
 body {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
  /*background-color: #efefef;*/
}

.circle {
    position: absolute;
    width: 42px;
    height: 42px;
    overflow: hidden;
    left: 15px;
    display: inline-block;
    vertical-align: middle;
    text-align: center;
    font-size: 1.5rem;
    color: #fff;
    font-weight: 300;
    padding: 10px;
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
echo load_js('barrating/jquery.barrating.min.js');  
?>
<script type="text/javascript">
function newcomment(){
  $("#name").val('');
  $("#comment").val('');
  $("#email").val('');
  $("#rating").val('');
  $('#modal1').openModal();

  }

  $(document).ready(function(){
     load_review(true);

     $('#new_review').submit(function(event) {       
        var formData = {
            'name': $("#name").val(),
            'comment': $("#comment").val(),
            'email': $("#email").val(),
            'rating': $("#rating").val(),            
            'place': $("#place").val(),  
        };

        $.ajax({
            type        : 'POST', 
            url         : '<?php echo make_url('places/savereview')?>', 
            data        : formData, 
            dataType    : 'json',
            encode       : true
        }).         
          success(function(data) {
            if (data.status) {
                var a = '<li class="collection-item avatar email-unread"><span class="circle '+data.review_color+'">'+data.review_name.charAt(0)+'</span><span class="email-title">'+data.review_name+'</span> <p class="truncate grey-text ultra-small">'+data.review_comment+'</p><a href="#!" class="secondary-content email-time"><span class="blue-text ultra-small">'+data.review_date+' ('+data.review_text+')</span></a></li>';
                
                $(".collection").prepend(a);

                $('#modal1').closeModal();
                Materialize.toast('Berhasil Ditambahkan', 4000);
              } else {
                Materialize.toast(data.message, 4000);       
              }                
            });
        event.preventDefault();
    });


      $('.rating').barrating('show', {
            theme: 'bars-pill',
            initialRating: '1',
            showValues: true,
            showSelectedRating: false           
        });

    })


var pos = 0;


function load_review(r) {
  var a='';    
  if (r) {pos=0};
  $.ajax({
    url: "<?php echo make_url('places/load_review?id='.$data->place_id)?>&step="+pos,
    dataType:'json',
    success: function(response) {
      var array = response;
      pos += 10;
      if (r) {$(".collection").html(''); $('#morebtn').show()}; 
      if (array.length<10) {$('#morebtn').hide()};           
      if (array != '')
      {
        for (i in array) {            
          a = '<li class="collection-item avatar email-unread"><span class="circle '+array[i].review_color+'">'+array[i].review_name.charAt(0)+'</span><span class="email-title">'+array[i].review_name+'</span> <p class="truncate grey-text ultra-small">'+array[i].review_comment+'</p><a href="#!" class="secondary-content email-time"><span class="blue-text ultra-small">'+array[i].review_date+' ('+array[i].review_text+')</span></a> </li>';
          $(".collection").append(a);
        }
      }

     
    }
  })
}

</script>

  </html>