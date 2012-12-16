<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kel_jasa_get extends CI_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
		 $this->load->view("kel_jasa_list_popup");
	}
	
	
	 
}	