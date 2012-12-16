<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kom_alurkerja extends MY_Controller {
 	
	function __construct()
        {
            parent::__construct();
	
             $this->load->model('alurkerja','alur');
        }
        
        function index() {
           
             $this->alur->mulai(1);
             $rs = $this->alur->getTransisi(10002);
             print_r($rs);
            
        }
        
	
}	
	