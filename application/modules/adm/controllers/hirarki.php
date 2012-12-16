<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hirarki extends CI_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 
		
		 
	}
	
	
	public function index()
	{
			$this->layout->view('hirarki' );
 
	}

}	