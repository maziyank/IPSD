  <div id="content">    
   <div class="row" style="margin:0">
  	<div id="mapview" class="col s12 m8 l8" style="padding:0">
      <?php echo $map['html']; ?> 
    </div>

    <div id="listview" class="row col s12 m4 l4" style="overflow-y: scroll; height: calc(100% - 114px) !important;padding:0">
      <ul class="collection">
                  
      </ul>
    </div>
  </div>
  </div>

  <nav style="position:fixed;bottom:80px;width:40%;left:40px;margin-right:auto;">
    <div class="nav-wrapper blue-grey darken-2">
      <form method="get" id="searchform" action="<?php echo make_url('welcome/map')?>">
        <div class="input-field">
          <input id="search" name="address" type="text" placeholder="Masukan Kota Anda...">
          <input id="category" name="category" type="hidden" value="all">
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
        <a class="grey-text text-lighten-4 right" href="<?php echo make_url('register')?>" style="margin-left:10px;font-size:13px">  Unit Register  </a> 
        <a class="grey-text text-lighten-4 right" href="<?php echo make_url('login')?>" style="margin-left:10px;font-size:13px">  Unit Login  </a> 
               
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
}

footer {position:fixed;left:0px; bottom:0px; width:100%;}
</style>

<?php echo $map['js'];     
?>
<script type="text/javascript">   

$(document).ready(function(){
  setTimeout("addmarker()",1000);
})

  var markers = [];
  function addmarker(){
   var NewMapCenter = map.getBounds();
   var ne = NewMapCenter.getNorthEast(); 
   var sw = NewMapCenter.getSouthWest(); 

   $.ajax({
    url:    "<?php echo make_url('places/getmarker')?>",
    type : 'POST',
    data : 'cat='+$('#category').val()+'&nelat='+ne.lat()+'&swlng='+sw.lng()+'&swlat='+sw.lat()+'&nelng='+ne.lng(),
    dataType: 'json',
    success : function(data) {                    
      for(var i=0; i < markers.length; i++){
        markers[i].setMap(null);
      }
      $('.collection').empty();
      var list ='';

      if (data.length==0) { 
        $('#mapview').attr('class','col s12 m12 l12');
        google.maps.event.trigger(map, 'resize');
         $('#listview').hide();

      } else{
        $('#mapview').attr('class','col s12 m8 l8');
        $('#listview').show();

      }


      for( i = 0; i < data.length; i++ ) {        

        list ='<li class="collection-item avatar"><a target="_blank" href="<?php echo make_url("places/detail/")?>'+data[i].id+'"><img src="'+data[i].image+'" alt="" class="circle"><span class="email-title">'+data[i].name+'</span> <p class="truncate grey-text ultra-small">'+data[i].address+'</p> <a href="#!" class="secondary-content"><span class="new badge '+data[i].rating_color+'">'+data[i].rating+'</span></a></a></li>';

        $('.collection').append(list);   

       var d = data[i];
       var myLatlng = new google.maps.LatLng(data[i].latitude,data[i].longitude);
       var marker = new google.maps.Marker({
         position: myLatlng,
         map: map,
         icon: d.pin,
         idPropertyName: d.id,
         // animation: google.maps.Animation.DROP,
       }); 
       markers.push(marker); 
       marker.setMap(map);

       var infowindow = new google.maps.InfoWindow();

       google.maps.event.addListener(marker, 'click', function() {
        load_content(map,this,infowindow);      

      });

       google.maps.event.addListener(infowindow, 'domready', function() {                
        var iwOuter = $('.gm-style-iw');
        var iwBackground = iwOuter.prev();
        iwBackground.children(':nth-child(2)').css({'display' : 'none'});
        iwBackground.children(':nth-child(4)').css({'display' : 'none'});
        iwOuter.parent().parent().css({left: '115px'});
        iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});
        iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});
        iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
        var iwCloseBtn = iwOuter.next();
        iwCloseBtn.css({opacity: '100', right: '58px', top: '23px'});

        if($('.iw-content').height() < 140){$('.iw-bottom-gradient').css({display: 'none'});}

        iwCloseBtn.mouseout(function(){$(this).css({opacity: '1'});
      });
      });

}
},        
async : true
});
}

function changecategory(id,e){    
  $('#category').val(id);       
  Materialize.toast('Tampil Kategori '+$(e).html(),1000); 
  addmarker();
}

function load_content(map,marker,infowindow){
  marker.setAnimation(google.maps.Animation.BOUNCE);
  $.ajax({
    url: '<?php echo make_url("places/getinfo/")?>' + marker.idPropertyName,
    success: function(data){      
      infowindow.setContent(data);
      infowindow.open(map, marker);
    }
  });
}





</script>




