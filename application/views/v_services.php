


<div class="row" style="background-color:#e3dfdf;height:100%;margin-bottom:0">  
  <div class="col s10 z-depth-1" style="margin:0 8.335%;min-height:100%;background-color:#fff;padding:0px">      
    <div class="col s12 pink accent-3">
      <div class="page-title valign-wrapper left-align">
        <h4><a class="title">Daftar Layanan</a></h4>
      </div>
    </div>
    
    <div class="row"> 


      <div class="fixed-action-btn" style="bottom: 45px; right: 150px;">
       <a href="<?php echo make_url('manage/newservices');?>" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>   
     </div>
     

     <div class="col s12 m12 l12">            
      <div class="col s12 m12 l3 grey-text text-lighten-1">            
       <p>Bagian ini berisi daftar layanan yang diberikan oleh unit Anda. Melalui menu yang tersedia anda bisa menambah dan melakukan pengaturan terhadap layanan anda.                 
       </br>                                          
     </div>
     
     <div class="col s12 m12 l9" style="margin-top:30px;height:100%">             
       <div class="row">
        <?php foreach ($data as $d) {?>                    
        
        <div class="col s12 m4 l4">
          
          <div class="<?php echo ($d->service_active=='1')?'card':'card grey lighten-4'?>" id="<?php echo 'card'.$d->service_id;?>">                    

            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="<?php echo res_folder('images/services/display/'.set_data($d->service_image,'avatar.jpg'));?>">
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4"><?php echo simplify_text($d->service_name,15);?><i class="mdi-navigation-more-vert right"></i></span>
              <p><a href="<?php echo make_url('manage/editservices/'.$d->service_id);?>">Edit</a> | <a onclick="askfordel(this)" data-id="<?php echo $d->service_id;?>" class="modal-trigger" href="#modal1">Hapus</a></p>
            </div>

            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"> <i class="mdi-navigation-close right"></i></span>
              <p><?php echo $d->service_name;?>.</p>
            </div>
            
          </div>
        </div>
        <?php }?>

        
      </div>
    </div>

    
  </form>
  
</div>


</div></div>


</div>

<div id="modal1" class="modal">
  <div class="modal-content">
    <h4>Hapus Layanan</h4>
    <p>Apa anda akan menghapus layanan ini?</p>
  </div>
  <div class="modal-footer">
    <a href="#!" id="btnNo" class=" modal-action modal-close waves-effect waves-green btn-flat">Tidak</a>
    <a href="#!" id="btnYes" data-id="" onclick="delservices(this)" class=" modal-action waves-effect waves-green btn-flat">Ya</a>
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

.note-editor{
  border-left: 3px solid #F50057;
  border-bottom: 3px solid #F50057;
  border-right: 3px solid #F50057;

}
</style>
<script>


function askfordel(a){       
  $('#modal1').openModal();   
  $('#btnYes').attr('data-id',$(a).attr('data-id'));         
};

function delservices(e){    

 $.ajax({
  url: '<?php echo make_url('services/delete/')?>',
  data: "&id="+$(e).attr('data-id'),
  dataType: 'json',
  type: 'POST',                          
  success: function(data) {
    if (data.status) {
      $('#modal1').closeModal();                
      Materialize.toast('Layanan Berhasil dihapus', 4000);           
      $("#card"+$(e).attr('data-id')).remove();
    } else {
      $('#modal1').closeModal();  
      Materialize.toast('Layanan Tidak dapat dihapus', 4000); 
    }
  }
});

 
};  

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
      url: "<?php echo make_url('manage/uploadimage/')?>",
      cache: false,
      contentType: false,
      processData: false,
      success: function(url) {
        Materialize.toast('Gambar Berhasil diunggah', 4000);    
        $("#description").materialnote("insertImage", url, ''); 
      }
    });
  }


  $('#aboutform').submit(function(event) {       
    var formData = {
      'description': $("#description").code(),
    };

    $.ajax({
      type        : 'POST', 
      url         : '<?php echo make_url('manage/save_profile_about/')?>', 
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