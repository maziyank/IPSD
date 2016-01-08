


<div class="row" style="background-color:#e3dfdf;height:100%;margin-bottom:0">  
  <div class="col s10 z-depth-1" style="margin:0 8.335%;min-height:100%;background-color:#fff;padding:0px">      
    <div class="col s12 pink accent-3">
      <div class="page-title valign-wrapper left-align">
        <h4><a class="title">Profil Singkat</a></h4>
      </div>
    </div>
    
    <div class="row">            


      <div class="col s12 m12 l12">            
        <div class="col s12 m12 l3 grey-text text-lighten-1 scrollspy">            
         <p>Pada bagian ini Anda dapat mengisikan informasi mengenai profil singkat unit layanan Anda. Tidak ada batasan mengenai apa yang harus dijelaskan disini, tetapi harus cukup representatif menggambarkan unit organisasi anda.</p>                  
       </div>
       
       <div class="col s12 m12 l9" style="margin-top:30px;height:100%">             
         <div class="row">    
          <form action="" name="aboutform" id="aboutform" method="POST">    
            <textarea id="description" name="description"><?php echo $data->place_description;?></textarea>       
            
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m12 l12">
            <button type="submit" class="btn waves-effect waves-light right" type="submit" name="action">Simpan</button>
          </div>
        </div>
      </form>
      
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

  .note-editor .note-resizebar .note-icon-bar{
    border-top: 2px solid #FFFEFE;
  }

  .lean-overlay{
    display: none !important;
  }

  .note-editor{
    border-left: 3px solid #F50057;
    border-bottom: 3px solid #F50057;
    border-right: 3px solid #F50057;
    z-index: 100;

  }
</style>
<script>



  $(document).ready(function(){
    $('.scrollspy').scrollSpy();

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
        url: "<?php echo make_url('places/uploadimage/')?>",
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


    $('#aboutform').submit(function(event) {       
      var formData = {
        'description': $("#description").code(),
      };

      $.ajax({
        type        : 'POST', 
        url         : '<?php echo make_url('places/save_profile_about/')?>', 
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