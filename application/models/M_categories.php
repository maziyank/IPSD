<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_categories extends IPSD_Model {	

function search_by_key($key) {	 
	$k = addquotes("%$key%");
	$data = $this->M_categories->search("cat_id, cat_name","cat_name LIKE $k","","","");   
	return $data;
	}

}
?>