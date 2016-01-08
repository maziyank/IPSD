<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends CI_Controller {

	function __construct()
	{
		parent::__construct();			
		$this->load->model('M_cities');
		$this->load->library('form_validation');   
	}
	
	public function index()
	{	
       echo 'Ora Teyeng';
  }

  public function change()
  { 
    $this->load->library('user_agent');
    $input = $this->input->post('city_id');    
    $prev_page = $this->input->post('prev_page');
       $array = array(
         'city' => $input,
         'city_name' => $this->M_cities->get_individual_data('city_name',"city_id='$input'")->city_name,
       );
       
       $this->session->set_userdata($array);

       redirect($this->agent->referrer());
   }

   public function get_all_cities() {
    $data = $this->M_cities->search("city_id, city_name","","","","");   
      $i = 0; 
      foreach ($data as $s) {
        $cities[$i]['city_id']=$s->city_id;            
        $cities[$i]['city_name']=$s->city_name;                                           
        $i++;
    }     

    if (count($data)==0){
        $cities = array();
    }     
    echo json_encode($cities);
   }

 
public function search() {
    $key = $this->input->get('query');
    $data = $this->M_cities->search_by_key($key);
          
    foreach($data as $row)
    {
      $arr['query'] = $key;
      $arr['suggestions'][] = array(
        'data' =>$row->city_id,
        'value' =>$row->city_name
      );
    }
    
    echo json_encode($arr); 
}

}