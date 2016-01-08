<?php

class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();					
     	$this->load->model('M_places');     	
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		if($this->session->userdata('login')==true)
		{	
			redirect('manage');
		}
		else 			
			$this->load->view('v_login');
	}

	function go()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags');
		$this->form_validation->set_rules('password', 'Password', 'required|md5');        
		$this->form_validation->set_message('required', 'Kolom %s wajib diisi');		

		if ($this->form_validation->run() == FALSE) {			
			$data['login_error']	= validation_errors();
			$data['udd']	= false;
			$this->load->view('v_login',$data);							
		} else {
			$match=$this->M_places->check($this->input->post('username'), $this->input->post('password'));
			if($match>-1)
			{
				$this->sess($match);								
				redirect('manage');
			}
			else
			{			
				$data['login_error']	= "Username dan Password tidak cocok";
				$data['udd']	= false;
				$this->load->view('v_login',$data);								
			}
		}
		
	}

	function sess($acc)
	{
		$query=$this->M_places->get_places_data($acc);

		$data = array(
			'id'  => $query->place_id,			
			'username'  => $query->place_username,
			'name'  => $query->place_name,			
			'longitude'  => $query->place_longitude,
			'latitude'  => $query->place_latitude,
			'login'=>true);

		$this->session->set_userdata($data);
	}

	function out()
	{
		$this->session->sess_destroy();
		redirect('welcome');
	}

	
	
}

?>