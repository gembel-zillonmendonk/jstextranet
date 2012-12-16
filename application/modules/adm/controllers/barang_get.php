<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_get extends CI_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
		 $this->load->view("barang_list_popup");
	}
	
	
	 
}	