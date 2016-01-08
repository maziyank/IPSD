<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_services extends IPSD_Model {

    function search_by_key($key) {   
       $k = addquotes("%$key%");
       $data = $this->search("place_id, place_name","place_name LIKE $k","","","");   
       return $data;
    }

    function my_services() {   
        $id = $this->session->userdata('id');
        $data = $this->search("service_id, service_image,service_name, service_active","service_place=$id","","","");   
        return $data;
    }

    function list_services($id) {           
        $data = $this->search("service_id, service_description,service_image,service_name, service_active","service_place=$id AND service_active=1 AND service_deleted=0","","","");   
        return $data;
    }
		
}
?>