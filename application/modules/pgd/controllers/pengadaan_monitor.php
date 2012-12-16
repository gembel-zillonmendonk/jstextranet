<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengadaan_monitor extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();		  
	}

	function index() {
		$this->layout->view("pengadaan_monitor_list");
	}
	
}	