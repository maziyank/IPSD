<?php

class Register extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();			
		$this->load->model('M_places');
		$this->load->model('M_categories');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['categories'] = $this->M_categories->search(); 
		// $this->load->view('v_register',$data);	
		$this->load->view('v_register',$data);	

	}
	
	function signup()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags|is_unique[tbl_places.place_username]');
		$this->form_validation->set_rules('password', 'Password', 'required|md5');         		
		$this->form_validation->set_rules('name', 'Nama', 'required|trim|strip_tags');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|strip_tags');
	    $this->form_validation->set_rules('address', 'Alamat', 'required|trim|strip_tags');
		$this->form_validation->set_rules('category', 'Kategori', 'required|trim|strip_tags');
		$this->form_validation->set_message('required', 'Kolom %s wajib diisi');		

		if ($this->form_validation->run() == FALSE) {			
			$data['register_error']	= validation_errors();
			$data['categories'] = $this->M_categories->search(); 
			$this->load->view('v_register',$data);							
		} else {
					$data = array(			
					'place_name'  => $this->input->post('name'),
					'place_address'  => $this->input->post('address'),
					'place_email'  => $this->input->post('email'),					
					'place_category'  =>$this->input->post('category'),
					'place_username'  => $this->input->post('username'),
					'place_password'  => $this->input->post('password'),);

				$this->M_places->insert($data);

				$id= $this->db->insert_id();
				// echo 'Sukses';							
				$this->load->view('v_register_success',$data);	
			}
		}

		
	
	}

?>