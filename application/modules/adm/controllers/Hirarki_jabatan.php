<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hirarki_jabatan extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
 
	}
	
	
	public function index()
	{
	
			 $this->load->model('Hirarki_posisi','pos');
			 $data["menu"] = $this->pos->setMenu();
 
  
			$this->layout->view('hirarki_jabatan', $data );
 
	}
	
	function delete ($str){
	
		$sql = "SELECT KODE_OTORISASI ";
		$sql .= " FROM EP_MS_OTORISASI ";
		$sql .= " WHERE KODE_OTORISASI_INDUK = " . $str ;
	
		$query = $this->db->query($sql);
		$result = $query->result(); 
	
		if (count($result) == 0) {
			$sql = "DELETE FROM EP_MS_OTORISASI " ;
			$sql .= " WHERE KODE_OTORISASI = " . $str ; 
			$this->db->simple_query($sql);
		}
		echo $sql;
		return;	
	}
	
	function add($str){
	 	
		if ($this->input->post("kode_jabatan")) {
			$sql = "INSERT INTO EP_MS_OTORISASI (KODE_OTORISASI , KODE_JABATAN, KODE_OTORISASI_INDUK, MATA_UANG, NILAI_MAKS_OTORISASI )";
			$sql .= " VALUES (" . $this->input->post("kode_jabatan") . ",'" . $this->input->post("kode_jabatan") . "','" . $this->input->post("kode_jabatan_induk")."' ";
			$sql .= " , '" . $this->input->post("mata_uang") ."', ". str_replace(",","",$this->input->post("nilai_maks_otorisasi")) ." ) ";
		
			$this->db->simple_query($sql);
			echo $sql;
			return;
		}

		$sql = "SELECT J.KODE_JABATAN, NAMA_JABATAN FROM MS_JABATAN J ";		
		$sql .= " WHERE J.KODE_JABATAN = '" . $str . "' ";
		$query = $this->db->query($sql);
		$result = $query->result(); 
		
		$data["kode_otorisasi"] =  "";
		$data["kode_jabatan"] = "";
		$data["nilai_maks_otorisasi"] = "0";
		$data["nama_jabatan_induk"]= "";
		$data["kode_jabatan_induk"]= $str;
			
		if (count($result)) {
			$data["nama_jabatan_induk"]= $result[0]->NAMA_JABATAN;
			  
		}
		
		
		
		$sql = "SELECT J.KODE_JABATAN, NAMA_JABATAN FROM MS_JABATAN J ";
		$sql .= " LEFT JOIN EP_MS_OTORISASI O ON J.KODE_JABATAN = O.KODE_JABATAN ";
		$sql .= " WHERE O.KODE_JABATAN IS NULL ";
		
		$query = $this->db->query($sql);
		$data["arr_jabatan"] = $query->result_array();
		 
		$sql = "SELECT MATA_UANG FROM GL_MATA_UANG ";
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		$data["mata_uang"] = $result;
		 
		$this->load->view('hirarki_jabatan_add', $data );
	
	
	}
	
	function edit($str){
		 
		if ($this->input->post("kode_jabatan")) {
			// lanjut
			// print_r($_POST);
			
			$sql = "UPDATE EP_MS_OTORISASI ";
			$sql .= " SET KODE_JABATAN = '" . $this->input->post("kode_jabatan") . "'";
			$sql .= " , NILAI_MAKS_OTORISASI = " . str_replace(",","",$this->input->post("nilai_maks_otorisasi"));
			$sql .= " , MATA_UANG = '". $this->input->post("mata_uang") . "'";
			$sql .= " WHERE KODE_OTORISASI = " . $this->input->post("kode_otorisasi") ; 
			
			$this->db->simple_query($sql);
			echo $sql;
			
			return;
			
		}		
		
		$sql = "SELECT O.KODE_OTORISASI, O.KODE_JABATAN, O.NILAI_MAKS_OTORISASI, O.KODE_OTORISASI_INDUK, JI.NAMA_JABATAN as NAMA_JABATAN_INDUK , O.MATA_UANG  ";		 
		$sql .= " FROM EP_MS_OTORISASI O";
		$sql .= " LEFT JOIN MS_JABATAN J ON O.KODE_JABATAN = J.KODE_JABATAN ";
		$sql .= " LEFT JOIN MS_JABATAN JI ON O.KODE_OTORISASI_INDUK = JI.KODE_JABATAN ";
		  
		$sql .= " WHERE O.KODE_OTORISASI = " . $str ;
		 
		
		$query = $this->db->query($sql);
		$result = $query->result();
		
		$data["kode_otorisasi"] =  "";
		$data["kode_jabatan"] = "";
		$data["nilai_maks_otorisasi"] = 0;
		$data["nama_jabatan_induk"]= "";
		$data["mata_uang"] = "";
		
		if (count($result)) {
			$data["kode_otorisasi"] =  $result[0]->KODE_OTORISASI;
			$data["kode_jabatan"] = $result[0]->KODE_JABATAN;
			$data["mata_uang"] = $result[0]->MATA_UANG;
			
			$data["nama_jabatan_induk"] = $result[0]->NAMA_JABATAN_INDUK;
			$data["nilai_maks_otorisasi"] = $result[0]->NILAI_MAKS_OTORISASI;
		}
			
		$sql = "SELECT KODE_JABATAN, NAMA_JABATAN FROM MS_JABATAN ";
		$query = $this->db->query($sql);
		$data["arr_jabatan"] = $query->result_array();
		
		
		$sql = "SELECT MATA_UANG FROM GL_MATA_UANG ";
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		$data["arr_matauang"] = $query->result_array();
		
		 
		$this->load->view('hirarki_jabatan_edit', $data );
	}	
	
	

}	