<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kel_jasa extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 
		$this->load->model('Nomorurut','urut');
	}
	
	function index() {
			$this->layout->view('kel_jasa_list' );
	}	
	
	function add() {
		if ($this->input->post("nama_kel_jasa")) {
		
			 $urut = $this->urut->get("ALL","KELOMPOKJASA");
			 
			 
			 $sql = "INSERT INTO EP_KOM_KELOMPOK_JASA (KODE_KEL_JASA, NAMA_KEL_JASA , TGL_REKAM ) ";
			 $sql .= " VALUES ('".$urut."','" . $this->input->post("nama_kel_jasa"). "',  TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')) ";
			 
			 
			 if ($this->db->simple_query($sql)) {
				$this->urut->set_plus( "ALL","KELOMPOKJASA") ;
			 }
			 redirect(base_url() . "index.php/kel_jasa");
			  
		}
	
			$this->layout->view('kel_jasa_add' );
	}
	
	
	
	
	function edit() {
	
			if ($this->input->post("kode_kel_jasa")) {
					$sql = "UPDATE EP_KOM_KELOMPOK_JASA ";
					$sql .= " SET NAMA_KEL_JASA = '" . $this->input->post("nama_kel_jasa") . "' ";
					$sql .= " WHERE KODE_KEL_JASA = '" . $this->input->post("kode_kel_jasa") . "' " ;  
		
					$this->db->simple_query($sql);
					redirect(base_url() . "index.php/kel_jasa");
			}

			$sql = "SELECT KODE_KEL_JASA, NAMA_KEL_JASA FROM EP_KOM_KELOMPOK_JASA ";
			$sql .= " WHERE KODE_KEL_JASA = '" . $this->input->get("KODE_KEL_JASA") . "' " ;  
	
	
	
	
			$query = $this->db->query($sql);
			$result = $query->result();
				
			$data["nama_kel_jasa"] = "";
			$data["kode_kel_jasa"] = "";
			if (count($result)) {
				$data["nama_kel_jasa"] = $result[0]->NAMA_KEL_JASA;
				$data["kode_kel_jasa"] = $result[0]->KODE_KEL_JASA;
			}
			
			
			$this->layout->view('kel_jasa_edit', $data );
	}
	
	function delete() {
		if ($this->input->get("KODE_KEL_JASA")) {
			$sql = "DELETE FROM EP_KOM_KELOMPOK_JASA ";
			$sql .= " WHERE KODE_KEL_JASA = '" . $this->input->get("KODE_KEL_JASA") . "' ";
		 
			$this->db->simple_query($sql);
			redirect(base_url() . "index.php/kel_jasa");
		 
		}
	}	
	 
	
	
}	
	