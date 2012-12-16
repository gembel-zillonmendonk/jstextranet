<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluasi extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();		  
	}

	function index() {
		$this->layout->view("evaluasi_list");
	}
	
	function add() {
		$this->layout->view("evaluasi_add");
	}

	function edit() {
                $data["KODE_EVALUASI"] = $this->input->get("KODE_EVALUASI");
		$this->layout->view("evaluasi_edit", $data);
	}
	
}	