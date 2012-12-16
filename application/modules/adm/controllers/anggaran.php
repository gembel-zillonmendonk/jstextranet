<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anggaran extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
	}
	
	function index() {
			$this->layout->view('anggaran_list' );
	}	
	 
	
	
}	
	