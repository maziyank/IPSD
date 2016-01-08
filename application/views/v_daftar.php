  <div id="content" clas="cardcontainter">    
     <!-- Card Here -->        
  </div>

  <nav style="position:fixed;bottom:80px;width:40%;left:40px;margin-right:auto;">
    <div class="nav-wrapper blue-grey darken-2">
      <form method="get" action="<?php echo make_url('welcome/map')?>">
        <div class="input-field">
          <input id="search" name="address" type="text" placeholder="Masukan Kota Anda...">
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

#map_canvas{
  height: calc(100% - 114px) !important;
  width: 100%;
}

footer {position:fixed;left:0px; bottom:0px; width:100%;}
</style>

<script type="text/javascript">
   $(document).ready(function(){
    $('#listmenu').addClass('active');
  })

  function load_content(map,marker,infowindow,id){
  $.ajax({
    url: '<?php echo make_url("places/getinfo/")?>' + id,
    success: function(data){      
      infowindow.setContent(data);
      infowindow.open(map, marker);
    }
  });
} 

</script>