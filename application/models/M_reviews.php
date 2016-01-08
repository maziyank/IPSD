<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_reviews extends IPSD_Model {	


function lastmonthrating($id) {           
     $data = $this->get_data("IFNULL(ROUND(AVG(review_rating),1),0) as `rating`","MONTH(review_date) >= MONTH(NOW()) AND review_places=$id")->rating;   
     return $data;
    }

function lastmonth_feeling($id,$feel){           
     $query = $this->db->query("SELECT IFNULL((SELECT IFNULL(COUNT(*),0) FROM tbl_reviews A WHERE MONTH(A.review_date) >= MONTH(NOW()) AND A.review_places=$id and A.review_rating=$feel GROUP by A.review_rating)/COUNT(*)*100,0) as rating FROM tbl_reviews B WHERE MONTH(B.review_date) >= MONTH(NOW()) AND B.review_places=$id");   

     if ($query->num_rows() > 0) $row = $query->row(); 
     return $row->rating;
    }

 function monthlyrating($id,$tahun){           
     $data = $this->db->query("SELECT * FROM om_rating WHERE place=$id and tahun=$tahun ORDER by bulan DESC");   
     return $data->result();
    }

 function monthlyrating_all($id,$tahun){           
     $data = $this->db->query("SELECT * FROM om_rating_all WHERE place=$id and tahun=$tahun ORDER by bulan DESC");   
     return $data->result();
    }

  function allcomments($id,$tahun){           
     $data = $this->db->query("SELECT GROUP_CONCAT(review_comment SEPARATOR ' ') as words FROM tbl_reviews WHERE review_places=$id and YEAR(review_date)=$tahun");   
     return $data->row()->words;
    }


}
?>