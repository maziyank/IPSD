<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_cities extends IPSD_Model {	

function search_by_key($key) {	 
	$k = addquotes("%$key%");
	$data = $this->M_cities->search("city_id, city_name","city_name LIKE $k","","","");   
	return $data;
	}

}
?>