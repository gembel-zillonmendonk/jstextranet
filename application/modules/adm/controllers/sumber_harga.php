<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sumber_harga extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		$this->load->model('Nomorurut','urut');
	}
	
	
	public function index()
	{
			$this->layout->view('sumber_harga_list' );
 
	}
	
	public function add()
	{
			if ($this->input->post("nama_sumber")) {
				
				$urut = $this->urut->get("ALL","SUMBERHARGA");
		 
				$sql = "INSERT INTO EP_KOM_SUMBER_HARGA (KODE_SUMBER, NAMA_SUMBER, TGL_REKAM ) ";
				$sql .= " VALUES (" . $urut. ",'" .$this->input->post("nama_sumber"). "',   TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')) "; 
				
				$this->db->simple_query($sql);
				
				$this->urut->set_plus("ALL","SUMBERHARGA");
				redirect(base_url() . "index.php/sumber_harga");
				 
			}
				
			$this->layout->view('sumber_harga_add' );
	}

	
	public function delete()
	{
		if ($this->input->get("KODE_SUMBER")) {
			$sql = "DELETE FROM EP_KOM_SUMBER_HARGA ";
			$sql .= " WHERE KODE_SUMBER = " . $this->input->get("KODE_SUMBER");
		 
			$this->db->simple_query($sql);
			redirect(base_url() . "index.php/sumber_harga");
		 
		}
	}	
	
	public function edit()
	{
		if ($this->input->post("nama_sumber")) {
			$sql = "UPDATE EP_KOM_SUMBER_HARGA ";
			$sql .= " SET NAMA_SUMBER = '" . $this->input->post("nama_sumber") . "' ";
			$sql .= " WHERE KODE_SUMBER = " . $this->input->post("kode_sumber");
			
		 
			
			$this->db->simple_query($sql);
			redirect(base_url() . "index.php/sumber_harga");
		 
		}
	
	
		$sql = "SELECT KODE_SUMBER, NAMA_SUMBER ";
		$sql .= " FROM EP_KOM_SUMBER_HARGA ";
		$sql .= " WHERE  KODE_SUMBER = " . $this->input->get("KODE_SUMBER");
		
		$query  = $this->db->query($sql);
		$result = $query->result();
		
		$data["kode_sumber"] = "";
		$data["nama_sumber"] = "";
		if (count($result) > 0) {
			$data["kode_sumber"] = $result[0]->KODE_SUMBER;
			$data["nama_sumber"] = $result[0]->NAMA_SUMBER;
			
		}
		
		$this->layout->view('sumber_harga_edit', $data );
	}
	
}	