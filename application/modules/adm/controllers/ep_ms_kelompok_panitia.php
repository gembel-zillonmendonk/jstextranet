<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panitia extends CI_Controller {
 	
	 
	public function index()
	{
			$this->layout->view('ep_ms_kelompok_panitia_list' );
 
	}
	
	public function add() {
	
		if ($this->input->post("nama_panitia")) {
			//echo $this->input->post("nama_panitia");
			
			redirect(base_url() . "index.php/ep_ms_kelompok_panitia");
		}
	
		$sql = "SELECT  KODE_JABATAN,NAMA_JABATAN FROM MS_JABATAN ";
		$rs = $this->db->query($sql);
		
	
		$data["kode_jabatan"] = $rs->result_array();
		$this->layout->view('ep_ms_kelompok_panitia_add', $data);
	}
	 
}
