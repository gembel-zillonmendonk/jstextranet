<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Harga_barang extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 
		$this->load->model('Nomorurut','urut');
	}
	
	function index() {		 
		$this->layout->view('harga_barang_list' );
	}	
	
	function add(){
	
	 
		if ($this->input->post("kode_barang")) {
		 	
			$urut = $this->urut->get("ALL","HARGABARANG");
			 
		 
			 
			 
			 
			 $sql = "INSERT INTO EP_KOM_HARGA_BARANG (KODE_HARGA_BARANG, KODE_BARANG, KODE_SUB_BARANG, KODE_KANTOR, KODE_SUMBER , MATA_UANG, HARGA,  TGL_REKAM ) ";
			 $sql .= " VALUES (".$urut.",'". $this->input->post("kode_barang")."','". $this->input->post("kode_sub_barang")."','" . $this->input->post("kode_kantor"). "'," . $this->input->post("kode_sumber"). " , '" . $this->input->post("mata_uang"). "' ";
			 $sql .= " ," .str_replace(",","",$this->input->post("harga")). " ";
			 $sql .= " ,   TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')) ";
			 
			  
			  
			 if ($this->db->simple_query($sql)) {
				$this->urut->set_plus( "ALL","HARGABARANG") ;
				echo $urut;
			 }	else {
				echo "0";
			 }
			
			return;
		
		}
	
		$sql = "SELECT KODE_KANTOR , NAMA_KANTOR FROM MS_KANTOR ";
		$query = $this->db->query($sql);
		$data["arr_kantor"] = $query->result_array();
		
		$sql = "SELECT KODE_SUMBER , NAMA_SUMBER FROM EP_KOM_SUMBER_HARGA ";
		$query = $this->db->query($sql);
		$data["arr_sumber"] = $query->result_array();
		
		$sql = "SELECT MATA_UANG FROM GL_MATA_UANG ";
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		$data["mata_uang"] = $result;
		
		$data["kode_alurkerja"] = 3;
                
		$this->layout->view('harga_barang_add', $data );
	}

}	