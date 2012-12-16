<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
 
	}
	
	
	public function index()
	{
	 
			$this->load->model('Menu_management','menu');
			$data["menu"] = $this->menu->setMenu();
			$this->layout->view('menu_management', $data  );
 
	}

}	