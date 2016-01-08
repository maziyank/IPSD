
  <div class="row" style="background-color:#e3dfdf;height:100%;margin-bottom:0">  
    <div class="col s10  z-depth-1" style="margin:0 8.335%;min-height:100%;background-color:#fff;padding:0px">      
      <div class="col s12 pink accent-3">
        <div class="page-title valign-wrapper left-align">
          <h4><a class="title">Data Umum</a></h4>
        </div>
      </div>

      <form name="generalform" id="generalform" action="" method="POST">       
        <div class="row">            
          <div class="col s12 m12 l12">

             <div class="col s12 m12 l3 grey-text text-lighten-1">
               <p>Bagian ini mengharuskan anda mengisi nama unit pelayanan anda, kategori pelayanan dan lokasi dimana unit anda berada. Khusus untuk kolom longitude dan latitude diisi dengan data koordinat google maps.</p>                  
              </div>
           
              <div class="col s12 m12 l9" style="margin-top:30px;height:100%">

                <div class="row">
                 <div class="input-field col s6 m6 l6">
                  <input placeholder="Masukan Nama Unit Pelayanan" id="name" name="name" type="text" class="validate" value="<?php echo set_data($data->place_name,set_value('place_name'));?>">
                  <label for="first_name">Nama Unit</label>
                 </div>

                 <div class="input-field col s6 m6 l6">
                  <select id="category" name="category">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <?php foreach ($categories as $c) {?>              
                    <option <?php echo ((set_data($data->place_category) == $c->cat_id) or (set_value('place_category')) == $c->cat_id) ? 'selected' : '';?> value="<?php echo $c->cat_id;?>"><?php echo $c->cat_name;?></option>            
                    <?php }?>
                  </select>
                  <label>Kategori Layanan</label>
                 </div>           
                </div>      

              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <textarea placeholder="Alamat Unit Pelayanan" id="address" name="address" class="materialize-textarea"><?php echo set_data($data->place_address,set_value('place_address'));?></textarea>
                  <label for="first_name">Alamat</label>
                </div>        
              </div>       

              <div class="row">
                <div class="input-field col s12 m4 l14">
                  <input placeholder="Kota" id="city_name" name="city_name" type="text" class="validate" value="<?php echo set_data($data->place_city_name,set_value('place_city_name'));?>">
                  <input placeholder="Kota" id="city" name="city" type="hidden" class="validate" value="<?php echo set_data($data->place_city,set_value('place_city'));?>">
                  <label>Kota</label>
                </div>        

                <div class="input-field col s12 m4 l4">
                  <input placeholder="Koordinat X" id="longitude" name="longitude" type="text" class="validate" value="<?php echo set_data($data->place_longitude,set_value('place_longitude'));?>">
                  <label for="first_name">Longitude</label>
                </div>      

                <div class="input-field col s12 m4 l4">
                  <input placeholder="Koordinat Y" id="longitude" name="latitude" type="text" class="validate" value="<?php echo set_data($data->place_latitude,set_value('place_latitude'));?>">
                  <label for="first_name">Latitude</label>
                </div>      
              </div>


          </div>

          </div>

          <div class="col s12 m12 l12">
            <div class="divider"></div>
            <div class="col s12 m12 l3 grey-text text-lighten-1">
            
               <p>Anda harus mengisi informasi kontak untuk keperluan korespondensi anda dengan pengguna layanan anda. Data yang harus diisi meliputi alamat email, website, dan telepon. Pastikan data kontak yang anda isikan masih aktif.</p>                  
              </div>
           
              <div class="col s12 m12 l9" style="margin-top:30px;height:100%">             

              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <input  placeholder="Masukan Alamat Email" id="email" name="email" type="email" class="validate" value="<?php echo set_data($data->place_email,set_value('place_email'));?>">
                  <label for="email">Email</label>
                </div>

                <div class="input-field col s12 m6 l6">
                  <input  placeholder="Masukan Alamat Website" id="website" name="website" type="text" class="validate" value="<?php echo set_data($data->place_website,set_value('place_website'));?>">
                  <label for="email">Website</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <input  placeholder="Masukan Nomor Telepon 1" id="phone1" name="phone1" type="text" class="validate" value="<?php echo set_data($data->place_phone1,set_value('place_phone1'));?>">
                  <label for="email">Telepon 1</label>
                </div>

                <div class="input-field col s12 m6 l6">
                  <input  placeholder="Masukan Nomor Telepon 2" id="phone2" name="phone2" type="text" class="validate" value="<?php echo set_data($data->place_phone2,set_value('place_phone2'));?>">
                  <label for="email">Telepon 2</label>
                </div>
              </div>

               <div class="row">
                <div class="input-field col s12 m12 l12">
                  <button class="btn waves-effect waves-light right" type="submit" name="action">Simpan</button>
                </div>
              </div>   
              </form>
          
          </div>
          </div>

            <div class="col s12 m12 l12">
            <div class="divider"></div>
            <div class="col s12 m12 l3 grey-text text-lighten-1">            
               <p>Upload Logo unit pelayanan anda. Logo yang diupload ini selanjutnya juga akan menjadi profile picture.</p>                  
              </div>
           
              <div class="col s12 m12 l9" style="margin-top:30px;height:100%">           

              <div class="row">
                <div class="input-field col s12 m4 l4">
                  <div class="card">
                      <div class="card-image">
                        <img id="profileimage" src="<?php echo res_folder('images/profile/'.set_data($data->place_image,'avatar.jpg'))?>" alt="profile image">
                      </div>
              
                      <div class="card-action">
                        <button onclick="fileimage.click()" style="width:100%" type="button" class="btn btn-primary">Ganti</button>
                        <form name="picform" id="picform" method="post" action="#" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo set_data($data->place_id,-2);?>">
                        <input type="file" onchange="upload()" id="fileimage" name="fileimage" style="width:0">                 
                        </form> 
                        

                      </div>
                    </div>
             
                </div>   


          
          </div>
          </div>
           
      </div>
    </div>


  </div>


</body>

<?php
echo load_css(plugin_folder('autocomplete','jquery.autocomplete.css'));
echo load_js('autocomplete/jquery.autocomplete.min.js');    
?>

<script>
$('#picform')
  .submit(function(e){
    $.ajax({
      url: '<?php echo make_url('places/uploadpic/')?>',
      type: 'POST',
      data: new FormData(this),
      datatype: 'json',
      cache: 'false',
      processData: false,
      contentType: false,
      success: function(data){
      if (JSON.parse(data).status) {            
            $("#profileimage").attr('src', '<?php echo res_folder("images/profile/")?>'+JSON.parse(data).message);
            Materialize.toast('Foto Profil Anda Berhasil Diubah', 4000)
          } else {            
            Materialize.toast(JSON.parse(data).message, 4000)            
          }
      }                        
    });
     e.preventDefault();
  });

 function upload(){    
   $('#picform').submit();
 } 

$(document).ready(function(){
  $('select').material_select();

  $("#city_name").autocomplete({                
   serviceUrl: "<?php echo make_url('/cities/search')?>",
   onSelect: function (suggestion) {
    $("#city").val(suggestion.data);                 
  },
  showNoSuggestionNotice: true,
  noSuggestionNotice: 'Sorry, no matching results',
}); 



  $('#generalform').submit(function(event) {       
      var formData = {
          'name': $("#name").val(),
          'category': $("#category").val(),
          'address': $("#address").val(),
          'city': $("#city").val(),
          'email': $("#email").val(),
          'website': $("#website").val(),
          'phone1': $("#phone1").val(),
          'phone2': $("#phone2").val(),
          'longitude': $("#longitude").val(),
          'latitude': $("#latitude").val(),
      };

      $.ajax({
          type        : 'POST', 
          url         : '<?php echo make_url('places/save_profile_general/')?>', 
          data        : formData, 
          dataType    : 'json',
          encode       : true
      }).         
        success(function(data) {
          if (data.status) {
               Materialize.toast('Berhasil Disimpan', 4000)       
            } else {
               Materialize.toast(data.message, 4000)       
            }                
          });
      event.preventDefault();
  });


});





</script>

</html>