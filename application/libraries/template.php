<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class template {
    protected $_ci;    

    public function __construct() {
         $this->_ci = &get_instance();
     }

    public function admin_view($viewname,$viewdata=NULL) {                        
        $this->_ci->load->view('v_header_a');                        
        $this->_ci->load->view($viewname, $viewdata);                           
    }

    public function public_view($viewname,$viewdata=NULL) {
        $this->_ci->load->model('M_categories');    
        $headerdata['categories'] = $this->_ci->M_categories->search();                    
        $this->_ci->load->view('v_header',$headerdata);                        
        $this->_ci->load->view($viewname, $viewdata);                          
    }


}

