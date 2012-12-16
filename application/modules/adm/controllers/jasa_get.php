<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jasa_get extends CI_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
		 $this->load->view("jasa_list_popup");
	}
	
	
	 
}	