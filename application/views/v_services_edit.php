


  <div class="row" style="background-color:#e3dfdf;height:100%;margin-bottom:0">  
    <div class="col s10 z-depth-1" style="margin:0 8.335%;min-height:100%;background-color:#fff;padding:0px">      
      <div class="col s12 pink accent-3">
        <div class="page-title valign-wrapper left-align">
          <h4><a class="title"><?php echo $title;?></a></h4>
        </div>
      </div>
  
        <div class="row">            
    

          <div class="col s12 m12 l12">            
            <div class="col s12 m12 l3 grey-text text-lighten-1">            
               <p>Bagian ini digunakan untuk mengisi data mengenai layanan yang disediakan oleh unit anda. Pada bagian ini, Anda juga bisa menemukan pilihan untuk mengaktifkan layanan atau menonaktifkan.</p>                  
            </div>
           
            <div class="col s12 m12 l9" style="margin-top:30px;height:100%">         
             <form action="" name="serviceform" id="serviceform" method="POST">        
                 <div class="row">
                 <div class="input-field col s9 m9 l9">
                  <input placeholder="Masukan Nama Layanan" id="name" name="name" type="text" class="validate" value="<?php echo isset($data->service_name)?$data->service_name:'';?>">
                  <label for="first_name">Nama Layanan</label>
                 </div>

                 <div class="input-field col s3 m3 l3">
                   <div class="switch">
                      <label>
                        Non Aktif
                        <input <?php echo ((isset($data->service_active))&&(($data->service_active=='1')))?'checked':'';?> id="active" name="active" type="checkbox">
                        <span class="lever"></span>
                        Aktif
                      </label>
                    </div>
                 </div>
          
                </div>      

                 <div class="row">
                 <div class="col s12 m12 l12">
                  <textarea id="description" name="description"><?php echo isset($data->service_description)?$data->service_description:'';?></textarea></br>                         
                  <button class="btn waves-effect waves-light right" type="submit" name="action">Simpan</button>
                </form>
                 </div>          
                </div> 

           
                   
            </div>         
         </div>


                 <div class="col s12 m12 l12">
            <div class="divider"></div>
            <div class="col s12 m12 l3 grey-text text-lighten-1">            
               <p>Upload Logo unit layanan anda. File yang diizinkan adalah jpeg dan png.</p>                  
              </div>
           
              <div class="col s12 m12 l9" style="margin-top:30px;height:100%">           

              <div class="row">
                <div class="input-field col s12 m4 l4">
                  <div class="card">
                      <div class="card-image">
                        <img id="profileimage" src="<?php echo (isset($data->service_image))?res_folder('images/services/display/'.$data->service_image):res_folder('images/services/display/avatar.jpg');?>" alt="profile image">
                      </div>
              
                      <div class="card-action">
                        <button onclick="fileimage.click()" style="width:100%" type="button" class="btn btn-primary">Ganti</button>
                        <form name="picform" id="picform" method="post" action="#" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo (isset($data->service_id))?$data->service_id:'';?>">
                        <input type="file" onchange="upload()" id="fileimage" name="fileimage" style="width:0">                 
                        </form> 
                        

                      </div>
                    </div>
             
                </div>   


          
          </div>
          </div>
           
      </div>




  </div>


</body>

<?php
echo load_css(plugin_folder('materialNote/css','materialNote.css'));
echo load_js('materialNote/js/ckMaterializeOverrides.min.js');   
echo load_js('materialNote/js/materialNote.min.js');    

?>


<style>
.note-editor .note-toolbar,.note-editor .btn,.note-editor .note-resizebar {
    background-color: #F50057;
}


.lean-overlay{
  display: none !important;
}

.note-editor{
    border-left: 3px solid #F50057;
    border-bottom: 3px solid #F50057;
    border-right: 3px solid #F50057;
    z-index: 1;

}
</style>
<script>
var mode= '<?php echo $mode;?>';
var id= '<?php echo (isset($data->service_id))?$data->service_id:'nn';?>';


$('#picform')
  .submit(function(e){
    $.ajax({
      url: '<?php echo make_url('Services/uploadpic/')?>',
      type: 'POST',
      data: new FormData(this),
      datatype: 'json',
      cache: 'false',
      processData: false,
      contentType: false,
      success: function(data){
      if (JSON.parse(data).status) {            
            $("#profileimage").attr('src', '<?php echo res_folder("images/profile/")?>'+JSON.parse(data).message);
            Materialize.toast('Foto Profil Layanan Berhasil Diubah', 4000)
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
  $('#description').materialnote({
    minHeight: 300,
    height:300,   
    onImageUpload: function(files, editor, welEditable) {
        sendFile(files[0], editor, welEditable);
    }
});

  function sendFile(file, editor, welEditable) {
      data = new FormData();
      data.append("file", file);
      $.ajax({
          data: data,
          type: "POST",
          url: "<?php echo make_url('Services/uploadimage/')?>",
          cache: false,
          contentType: false,
          processData: false,
          success: function(url) {
            Materialize.toast('Gambar Berhasil diunggah', 4000)    
            $("#description").materialnote("insertImage", url, ''); 
            // editor.insertImage(welEditable, url);
          }
      });
  }


$('#serviceform').submit(function(event) {       
      var formData = {
          'id': id,
          'description': $("#description").code(),
          'name': $("#name").val(),
          'mode': mode,
          'active':Number($("#active").is(':checked')),
      };

      $.ajax({
          type        : 'POST', 
          url         : '<?php echo make_url('Services/savedata/')?>', 
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