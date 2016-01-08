<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_places extends IPSD_Model {

    function search_by_key($key) {   
       $k = addquotes("%$key%");
       $data = $this->search("place_id, place_name","place_name LIKE $k","","","");   
       return $data;
    }
	
    function check($u,$p) {
		$this->db->select('place_id');
        $this->db->where("(place_username='$u') AND place_password='$p'");           
        $query = $this->db->get('tbl_places');	

        if($query->num_rows()>0){
		return $query->row()->place_id;
        } else{
        	return -1;
        }	
	}

    public function changepass($id, $pass){        
        $this->db->set('place_password', $pass); 
        $this->db->where('place_id', $id);      
        $update = $this->db->update('tbl_places');
        return $update;     
    }

    public function check_logged(){
         if ($this->session->userdata('login') == false) {
            redirect('login');
         }        
    }
    
    public function get_places_data($place_id)
    {                 
        return $this->get_data("place_id,place_name,place_username,place_category,place_longitude,place_latitude","place_id=$place_id");; 
    }



		
}
?>