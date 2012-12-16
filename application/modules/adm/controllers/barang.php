<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 
		 
	}
	
	function index() {
			$this->layout->view('barang_list' );
	}	
	 
}	
	