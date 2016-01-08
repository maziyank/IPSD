<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Places extends CI_Controller {

	function __construct()
	{
		parent::__construct();			
    $this->load->model('M_cities');
    $this->load->model('M_places');     
    $this->load->model('M_categories');     
    $this->load->model('M_services');     
    $this->load->model('M_reviews');  
    $this->load->library('form_validation'); 
	}
	


    function save_profile_about()
    {
        $data = array('place_description'  => $this->input->post('description'));

        $id = $this->session->userdata('id');
        $this->M_places->update($data,"place_id=$id");                 
        $status = array('status' => true, 'message' => 'Sukses');       
      
        echo json_encode($status);
    }  



    function save_profile_general()
    {
      $this->form_validation->set_rules('name', 'Nama', 'required|trim|strip_tags');    
      $this->form_validation->set_rules('address', 'Alamat ', 'trim|strip_tags');
      $this->form_validation->set_rules('city', 'Kota', 'trim|strip_tags');
      $this->form_validation->set_rules('category', 'Kategori', 'trim|strip_tags');
      $this->form_validation->set_rules('email', 'Email', 'trim|strip_tags');     
      $this->form_validation->set_rules('website', 'Website', 'trim|strip_tags');    
      $this->form_validation->set_rules('phone1', 'Telepon 1', 'trim|strip_tags');  
      $this->form_validation->set_rules('phone2', 'Telepon 2', 'trim|strip_tags');  
      $this->form_validation->set_rules('longitude', 'Koordinat X', 'trim|strip_tags');  
      $this->form_validation->set_rules('latitude', 'Koordinat Y', 'trim|strip_tags');   

      if ($this->form_validation->run() == FALSE) {     
        $status = array('status' => false, 'message' => validation_errors());      
        echo validation_errors();
      } else {      

        $data = array(
          'place_name'  => $this->session->userdata('name'),
          'place_category'  => $this->input->post('category'),
          'place_address'  => $this->input->post('address'),
          'place_city'  => $this->input->post('city'),
          'place_email'  => $this->input->post('email'),
          'place_website'  => $this->input->post('website'),
          'place_phone1'  => $this->input->post('phone1'),
          'place_phone2'  => $this->input->post('phone2'),
          'place_longitude'  => $this->input->post('longitude'),
          'place_latitude'  => $this->input->post('latitude'),
          );

        $id = $this->session->userdata('id');
        $this->M_places->update($data,"place_id=$id");                 
         $status = array('status' => true, 'message' => 'Sukses');       
      }

      echo json_encode($status);
    }  


 

  public function resetpass() {
    $viewdata['title'] = 'Change Password';       
    $this->form_validation->set_rules('old_pass', 'Password Lama', 'md5|trim|strip_tags');
    $this->form_validation->set_rules('new_pass', 'Password Baru', 'trim|strip_tags|alpha_numeric|min_length[8]');
    $this->form_validation->set_rules('new_pass2', 'Password Konfirmasi', 'trim|strip_tags|required|matches[new_pass]');

    if ($this->form_validation->run() == FALSE) {     
      $viewdata['login_error']  = validation_errors();
      $viewdata['success'] = false;
      $this->template->admin_view('v_change_pass',$viewdata);
    } else {
      $match=$this->M_places->check($this->session->userdata('username'), $this->input->post('old_pass'));
      if($match>0)
      {     
        $this->M_places->changepass($this->session->userdata('id'), md5($this->input->post('new_pass')));
        $viewdata['login_error']  = "Password berhasil diubah";
        $viewdata['success'] = true;
        $this->template->admin_view('v_change_pass',$viewdata);
      }
      else
      {     
        $viewdata['success'] = false;
        $viewdata['login_error']  = "Password lama yang anda masukan salah.";        
        $this->template->admin_view('v_change_pass',$viewdata);
      }
    }
 }

     public function uploadpic() {        
        $name = $_FILES['fileimage']['name'];
        $config['file_name'] = $name;
        $config['allowed_types'] = 'jpg|png';
        $config['upload_path'] = './resources/images/profile/';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('fileimage')) {            
            $get_name = $this->upload->data();
            $uploaddata['place_image'] = $get_name['file_name'];            
            $place_id = addquotes($this->input->post('id'));
            $id = $this->M_places->update($uploaddata,"place_id=$place_id");
            
            $status = array('status' => true, 'message' => $uploaddata['place_image']);            
        } else {
            $status = array('status' => false, 'message' => $this->upload->display_errors());
        }

        echo json_encode($status);
    }

    public function uploadimage(){
      if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                $name = md5(rand(100, 200));
                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . $ext[1];

                $config['file_name'] = $filename;
            $config['allowed_types'] = 'jpg|png';
            $config['upload_path'] = './resources/images/about';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('file');
  
                echo base_url('resources/images/about/'.$filename);
            }
            else
            {
              echo  $message = 'Ooops!  Terjadi kesalahan saat unggah gambar '.$_FILES['file']['error'];
            }
        }
    }

    public function getinfo() {        
      $id = $this->uri->segment(3);
      $q = $this->M_places->get_data('*',"place_id=$id");
      $rating = $this->M_reviews->lastmonthrating($id); 


      $result = '<div id="iw-container">' .
                    '<div class="iw-title"><a target="a_blank" href="'.make_url('places/detail/').$q->place_id.'">'.$q->place_name.' ('.$rating.')</a></div>' .
                    '<div class="iw-content">' .                      
                      '<img src="'.res_folder('images/profile/').$q->place_image.'" height="83" width="83">' .
                      '<p>'.simplify_text($q->place_description,300).'</p>'.
                      '<div class="iw-subTitle">Korespondensi</div>' .
                      '<p>'.$q->place_address.
                      '<br>Telp. '.$q->place_phone1.'<br>e-mail: '.$q->place_email.'<br>Web: <a href="http://'.$q->place_website.'">'.$q->place_website.'</a></p>'.
                    '</div>'.'<div class="iw-bottom-gradient"></div>'.'</div>'; 

      echo $result;

    }

    public function getmarker() {        
        $nelat = floatval($this->input->post('nelat')); 
        $swlng = floatval($this->input->post('swlng')); 
        $swlat = floatval($this->input->post('swlat')); 
        $nelng = floatval($this->input->post('nelng')); 
        $category = $this->input->post('cat'); 

        $criteria = "(place_longitude BETWEEN $swlng AND $nelng)AND(place_latitude BETWEEN $swlat AND $nelat)";

        if ($category!=='all') $criteria .= " AND place_category=$category";

        $query = $this->M_places->search("place_id,place_name,place_category,place_longitude,place_latitude,place_address,place_phone1,place_website,place_email,place_description,place_image,(select cat_icon from tbl_categories where cat_id=place_category) as `place_pin`",$criteria); 
        $i = 0;       
        foreach ($query as $s) {
            $data[$i]['id']=$s->place_id;                                  
            $data[$i]['name']=$s->place_name;                                                                              
            $data[$i]['category']=$s->place_category;
            $data[$i]['phone1']=$s->place_phone1;
            $data[$i]['address']=$s->place_address;                                                                
            $data[$i]['image']=res_folder('images/profile/').$s->place_image; 
            $data[$i]['email']=$s->place_email; 
            $data[$i]['website']=$s->place_website; 
            $data[$i]['pin']= res_folder('images/pins/').$s->place_pin; 
            $data[$i]['longitude']=number_format($s->place_longitude,5,'.',',');                                                            
            $data[$i]['latitude']=number_format($s->place_latitude,5,'.',',');  
            $rating = $this->M_reviews->lastmonthrating($s->place_id); 
            $data[$i]['rating'] = $rating;                                                                 
            $data[$i]['rating_text'] = review_text(substr($rating, 0, 1));
            $data[$i]['rating_color'] = review_color(substr($rating,0, 1));
            $i++;
        }
        if (count($query)==0){
            $data = array();
        }        
        echo json_encode($data);
      }   


        public function detail()
        {          
          $id = $this->uri->segment(3);
          $viewdata['data'] = $this->M_places->get_data('*','place_id='.$id);
          $viewdata['services'] = $this->M_services->list_services($id);

          $this->load->library('googlemaps');
          $config['center'] = $viewdata['data']->place_latitude.','.$viewdata['data']->place_longitude;
          $config['disableDefaultUI'] = TRUE;
          $config['zoom'] = 16;
          $config['map_height'] = 250;
          $config['minifyjs'] = TRUE;   
          
          $marker = array();
          $marker['position'] =  $viewdata['data']->place_latitude.','.$viewdata['data']->place_longitude;
          $marker['icon'] = res_folder('images/pins/').$this->M_categories->get_field_data('cat_icon','cat_id='.$viewdata['data']->place_category);
          $this->googlemaps->add_marker($marker);
          $this->googlemaps->initialize($config);   

          $viewdata['map'] = $this->googlemaps->create_map();   
          $viewdata['rating'] = $this->M_reviews->lastmonthrating($id);            

          

          $this->load->view('v_profile',$viewdata);      
          
        }

        public function review()
        {          
          $id = $this->uri->segment(3);
          $viewdata['data'] = $this->M_places->get_data('*','place_id='.$id);
          $viewdata['services'] = $this->M_services->list_services($id);

          $this->load->library('googlemaps');
          $config['center'] = $viewdata['data']->place_latitude.','.$viewdata['data']->place_longitude;
          $config['disableDefaultUI'] = TRUE;
          $config['zoom'] = 16;
          $config['map_height'] = 250;
          $config['minifyjs'] = TRUE;   
          
          $marker = array();
          $marker['position'] =  $viewdata['data']->place_latitude.','.$viewdata['data']->place_longitude;
          $marker['icon'] = res_folder('images/pins/').$this->M_categories->get_field_data('cat_icon','cat_id='.$viewdata['data']->place_category);
          $this->googlemaps->add_marker($marker);
          $this->googlemaps->initialize($config);   

          $viewdata['map'] = $this->googlemaps->create_map();    
          $viewdata['rating'] = $this->M_reviews->lastmonthrating($id);                   

          $this->load->view('v_profile_review',$viewdata);      
          
        }


    public function load_review() {
      $id = $this->input->get('id');
      $step = $this->input->get('step');     
      $data = $this->M_reviews->search("*","review_places=$id","",'review_date','DESC',10,$step);   
      $i = 0; 
      foreach ($data as $s) {        
        $demand[$i]['review_id']=$s->review_id;   
        $demand[$i]['review_name']=$s->review_name;   
        $demand[$i]['review_email']=$s->review_email;   
        $demand[$i]['review_comment']=$s->review_comment;            
        $demand[$i]['review_rating']=$s->review_rating;
        $demand[$i]['review_text']=review_text($s->review_rating);
        $demand[$i]['review_color']=review_color($s->review_rating);        
        $demand[$i]['review_date']= date('d M Y', strtotime($s->review_date));;  

        $i++;
    }     

    if (count($data)==0){
        $demand = array();
    }     
    echo json_encode($demand);

} 

function savereview()
    {
      $this->form_validation->set_rules('name', 'Nama', 'required|trim|strip_tags');    
      $this->form_validation->set_rules('email', 'Email ', 'required|trim|strip_tags');
      $this->form_validation->set_rules('rating', 'Rating', 'required|trim|strip_tags');
      $this->form_validation->set_rules('comment', 'Komentar', 'required|trim|strip_tags');      

      if ($this->form_validation->run() == FALSE) {     
        $status = array('status' => false, 'message' => validation_errors());      
        echo validation_errors();
      } else {      

        $data = array(
          'review_places'  => $this->input->post('place'),
          'review_name'  => $this->input->post('name'),
          'review_email'  => $this->input->post('email'),
          'review_comment'  => $this->input->post('comment'),
          'review_rating'  => $this->input->post('rating'),          
          );
        
        $this->M_reviews->insert($data);                 
        $status = array('status' => true, 
                        'message' => 'Sukses',
                        'review_id' => $this->db->insert_id(),
                        'review_name' =>  $this->input->post('name'),
                        'review_comment' => $this->input->post('comment'),
                        'review_rating' => $this->input->post('rating'),
                        'review_text' => review_text($this->input->post('rating')),
                        'review_color' =>review_color($this->input->post('rating')),
                        'review_date' => date('d M Y'),
                        );       
      }

      echo json_encode($status);
    }  

     


}