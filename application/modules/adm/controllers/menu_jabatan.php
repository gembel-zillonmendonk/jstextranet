<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {
 	
	function __construct()
    {
        parent::__construct();
 
	}
	
	
	public function index()
	{
	 
			$this->load->model('Menu_jabatan','menu');
			$data["menu"] = $this->menu->setMenu();
			$this->layout->view('menu_jabatan', $data  );
 
	}

}	