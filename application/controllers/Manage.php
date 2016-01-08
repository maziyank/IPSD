<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

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
	

	public function index()
	{	  
		  $id = $this->session->userdata('id');
		  $viewdata['feel1']= $this->M_reviews->lastmonth_feeling($id,1);
		  $viewdata['feel2']= $this->M_reviews->lastmonth_feeling($id,2);
		  $viewdata['feel3']= $this->M_reviews->lastmonth_feeling($id,3);
		  $viewdata['feel4']= $this->M_reviews->lastmonth_feeling($id,4);
		  $viewdata['feel5']= $this->M_reviews->lastmonth_feeling($id,5);		  

		  $viewdata['monthly']= $this->M_reviews->monthlyrating($id,date("Y"));
		  $viewdata['overall']= $this->M_reviews->monthlyrating_all($id,date("Y"));

		  $words = extract_common_words($this->M_reviews->allcomments($id,date("Y")));    
		  $viewdata['words']=  $words;
		  $this->template->admin_view('v_dashboard',$viewdata);
		  
	}

	public function general() {
		$id = $this->session->userdata('id');
		$data = $this->M_places->get_data('*',"place_id=$id");
		$city_id = $data->place_city;
		
		$data2 = array(
		 	'place_city_name' => $this->M_cities->get_field_data('city_name',"city_id=$city_id"));
		
		foreach ($data2 as $key => $value){$data->$key = $value;}

		$viewdata['data'] = $data;                               
		$viewdata['categories'] = $this->M_categories->search();    
		$this->template->admin_view('v_general_edit', $viewdata);
		}

	 public function changepass() {          
	    $viewdata['login_error']  = '';
	    $viewdata['success'] = false;          
	    $this->template->admin_view('v_change_pass');
  }

	public function about() {
		$id = $this->session->userdata('id');
		$data = $this->M_places->get_data('place_id,place_description',"place_id=$id");
		$viewdata['data'] = $data;                                
		$this->template->admin_view('v_about', $viewdata);
		}  

	public function services() {
		$id = $this->session->userdata('id');
		$viewdata['data'] = $this->M_services->my_services();
		$this->template->admin_view('v_services', $viewdata);
		}  
	

	public function editservices() {		
		$id = $this->uri->segment(3);
		$viewdata['title'] = 'Edit Layanan';
		$viewdata['mode'] = 'Edit';
		$viewdata['data'] = $this->M_services->get_data('*',"service_id=$id");
		$this->template->admin_view('v_services_edit',$viewdata);
	}
 
 	public function newservices() {		
		$id = $this->uri->segment(3);
		$viewdata['title'] = 'Tambah Layanan';		
		$viewdata['mode'] = 'New';				 
		$this->template->admin_view('v_services_edit',$viewdata);
	}

	}
