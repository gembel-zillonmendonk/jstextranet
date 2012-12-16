<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_jasa_get extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
		 $this->load->view("barang_jasa_list_popup");
	}
	
	
	 
}	