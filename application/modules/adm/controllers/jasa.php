<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jasa extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 
		$this->load->model('Nomorurut','urut');
	}
	
	function index() {
			$this->layout->view('jasa_list' );
	}	
	
	function add() {
	//	print_r($_POST);
		if ($this->input->post("nama_jasa")) {
		
			 $urut = $this->urut->get("ALL","JASA");
			 
			 
			 $sql = "INSERT INTO EP_KOM_JASA (KODE_JASA, KODE_KEL_JASA, NAMA_JASA , TGL_REKAM ) ";
			 $sql .= " VALUES ('".$urut."','" . $this->input->post("kode_kel_jasa"). "','" . $this->input->post("nama_jasa"). "',  TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')) ";
			 
		 //	  echo $sql;
			 
			 if ($this->db->simple_query($sql)) {
				
				$this->urut->set_plus( "ALL","JASA") ;
				echo  $urut;
			 
			 }
			 return;
			
			// redirect(base_url() . "index.php/jasa");
			  
		} else {
                    $data["kode_alurkerja"] = 1;
                    
			  $this->layout->view('jasa_add', $data );
		}
	}
	
	function edit() {
	
			if ($this->input->post("kode_kel_jasa")) {
					$sql = "UPDATE EP_KOM_KELOMPOK_JASA ";
					$sql .= " SET NAMA_KEL_JASA = '" . $this->input->post("nama_kel_jasa") . "' ";
					$sql .= " WHERE KODE_KEL_JASA = '" . $this->input->post("kode_kel_jasa") . "' " ;  
		
					$this->db->simple_query($sql);
					redirect(base_url() . "index.php/kel_jasa");
			}

			$sql = "SELECT KODE_JASA, KODE_KEL_JASA, NAMA_JASA FROM EP_KOM_JASA ";
			$sql .= " WHERE KODE_JASA = '" . $this->input->get("KODE_JASA") . "' " ;  
	
	
	
	
			$query = $this->db->query($sql);
			$result = $query->result();
				
			$data["kode_jasa"] = "";
			$data["kode_kel_jasa"] = "";
			$data["nama_jasa"] = "";
			if (count($result)) {
				$data["kode_jasa"] = $result[0]->KODE_JASA;
				$data["nama_jasa"] = $result[0]->NAMA_JASA;
				$data["kode_kel_jasa"] = $result[0]->KODE_KEL_JASA;
			}
			
			
			$this->layout->view('jasa_edit', $data );
	}
	
	function delete() {
		if ($this->input->get("KODE_KEL_JASA")) {
			$sql = "DELETE FROM EP_KOM_KELOMPOK_JASA ";
			$sql .= " WHERE KODE_KEL_JASA = '" . $this->input->get("KODE_KEL_JASA") . "' ";
		 
			$this->db->simple_query($sql);
		// 	redirect(base_url() . "index.php/kel_jasa_list");
		 
		}
	}	
	 
	
	
}	
	