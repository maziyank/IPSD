  <div id="content">    
  	<!-- <div id="map" style="background-color:#efefef;"></div>    -->
    <?php echo $map['mapdiv']; ?> 
  </div>

  <nav style="position:fixed;bottom:80px;width:40%;left:40px;margin-right:auto;">
    <div class="nav-wrapper blue-grey darken-2">
      <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>


  <footer class="page-footer" style="margin-top:0px;padding-top:0px">       
    <div class="footer-copyright blue-grey darken-3">
      <div class="container" style="width:95%">
        © 2015 Indonesia Public Service Directory 
      </div>
    </div>
  </footer>         
</body>
</div>
<style>

 body {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
}

#map{
  height: calc(100% - 114px);
  width: 100%;
}

footer {position:fixed;left:0px; bottom:0px; width:100%;}

</style>



<footer>
	<?php
     echo $map['javascript']; 

	// echo load_js('http://maps.google.com/maps/api/js?sensor=false&amp;language=en',true);
	// echo load_js('gmap3/gmap3.js');  	
  ?>

  <script type="text/javascript">

  	// $(document).ready(function(){


   //    $("#map").gmap3({
   //      map:{
   //        address:"Jakarta",
   //        options:{
   //          zoom:16,
   //          mapTypeId: google.maps.MapTypeId.MAP,
   //          mapTypeControl: false,            
   //          navigationControl: true,
   //          scrollwheel: true,
   //          streetViewControl: true
   //        }
   //      }
   //    });

   //  });


  </script>

</footer>


