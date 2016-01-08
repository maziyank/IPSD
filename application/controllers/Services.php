<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	function __construct()
	{
		parent::__construct();			     	
		$this->load->model('M_cities');
		$this->load->model('M_places');    	
		$this->load->model('M_categories');    	
		$this->load->model('M_services');    	
		$this->load->library('form_validation');
	}
	

	public function index()
	{
		redirect('404');

	}

   public function delete() {
        $id = $this->input->post('id');                                      
        $r = $this->M_services->delete_permanent("service_id=$id"); 
        $result = array('status' => ($r>0));

        echo(json_encode($result));
    } 

    public function getinfo() {
        $id = $this->uri->segment(3);
        $r = $this->M_services->get_data("*","service_id=$id and service_active=1 and service_deleted=0"); 
        $result = '<h4>'.$r->service_name.'</h4>';
        $result .= '<p>'.$r->service_description.'</p>';

        echo $result;
    } 

	function savedata()
  {
    $this->form_validation->set_rules('name', 'Nama', 'required|trim|strip_tags');    
    $this->form_validation->set_rules('description', 'Penjelasan ', '');
    $this->form_validation->set_rules('active', 'Status', 'trim|strip_tags');

    if ($this->form_validation->run() == FALSE) {     
      $status = array('status' => false, 'message' => validation_errors());      
      echo validation_errors();
    } else {      

      $data = array(
        'service_name'  => $this->input->post('name'),  
        'service_description'  => $this->input->post('description'),
        'service_active'  => $this->input->post('active'),                    
        'service_place'  => $this->session->userdata('id'),
        );
      
      if ($this->input->post('mode')=='Edit') {
        $id = $this->input->post('id');
        $this->M_services->update($data,"service_id=$id");         
      } else
      if ($this->input->post('mode')=='New'){
        $this->M_services->insert($data);                 
        $id = $this->db->insert_id();        
      }

      $status = array('status' => true, 'message' => 'Sukses Edit', 'id'=> $id, 'mode'=> 'Edit');   
    }

    echo json_encode($status);


  }  

  public function uploadpic() {        
    $name = $_FILES['fileimage']['name'];
    $config['file_name'] = $name;
    $config['allowed_types'] = 'jpg|png';
    $config['upload_path'] = './resources/images/Services/display';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if ($this->upload->do_upload('fileimage')) {            
      $get_name = $this->upload->data();
      $uploaddata['services_image'] = $get_name['file_name'];            
      $place_id = addquotes($this->input->post('id'));
      $id = $this->M_services->update($uploaddata,"place_id=$place_id");

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
        $config['upload_path'] = './resources/images/Services/general';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('file');

        echo base_url('resources/images/services/general/'.$filename);
      }
      else
      {
        echo  $message = 'Ooops!  Terjadi kesalahan saat unggah gambar '.$_FILES['file']['error'];
      }
    }
  }


}
