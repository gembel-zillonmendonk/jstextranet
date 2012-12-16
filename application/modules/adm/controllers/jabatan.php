<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		  
	}
	
	function index() {
			$this->layout->view('jabatan_list' );
	}	
	
	function edit() {
			
		$sql = "SELECT KODE_JABATAN, NAMA_JABATAN FROM MS_JABATAN ";
		$sql .= " WHERE KODE_JABATAN = " . $this->input->get("KODE_JABATAN");
		
		
		$query = $this->db->query($sql);
		$result = $query->result(); 
		
		$data["kode_jabatan"] = "";
		$data["nama_jabatan"] = "";
		if (count($result))  {
			$data["kode_jabatan"] = $result[0]->KODE_JABATAN;
			$data["nama_jabatan"] = $result[0]->NAMA_JABATAN;
		
		}
	$this->load->model('Menu_jabatan','menu');
			$data["menu"] = $this->menu->setMenu($this->input->get("KODE_JABATAN"));
		 
		
		$this->layout->view('jabatan_edit' , $data);
	}	
		
	function update() {
		
		$sql = "DELETE FROM  EP_MS_MENU_JABATAN    ";
		$sql .= " WHERE KODE_JABATAN = ".$this->input->post("kode_jabatan") ;
		

			$this->db->simple_query($sql);
			 
			 
		$arr = explode(",",$this->input->post("menu"));
		foreach($arr as $k =>$v) {
			$sql = "INSERT INTO EP_MS_MENU_JABATAN (KODE_MENU, KODE_JABATAN) ";
			$sql .= " VALUES (".$v.",".$this->input->post("kode_jabatan").")";
			
			$this->db->simple_query($sql);
			 
			
			echo $sql;
			
			
		}	
		echo "Simpan Akses Menu Berhasil";	
	}
	
}	
	