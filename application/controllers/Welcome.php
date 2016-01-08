<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->map();
	}

	public function map()
	{		

		$this->load->library('googlemaps');

		$config = array();

		if ($this->input->get('address')){
			$config['center'] = $this->input->get('address');
		} else{
			$config['center'] = 'Jakarta Timur';
		}

		$config['places'] = TRUE;
		$config['placesAutocompleteInputID'] = 'search';
		$config['placesAutocompleteBoundsMap'] = TRUE;
		$config['zoom'] = 16;
		$config['sensor'] = FALSE;
		$config['ondragend'] = 'addmarker()';		
		$config['onzoomchanged'] = 'addmarker()';
		$config['disableStreetViewControl'] = TRUE;
		$config['disableMapTypeControl'] = TRUE;		 
		$config['minifyjs'] = TRUE;		
		$this->googlemaps->initialize($config);		

		$data['map'] = $this->googlemaps->create_map();        
        $this->template->public_view('v_map', $data);        
	
	}

	public function places()
	{		       
        $this->template->public_view('v_daftar');        
	
	}
}
