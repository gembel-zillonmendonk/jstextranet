<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kurs extends CI_Controller {
 	
	 
	public function index()
	{
			$this->layout->view('kurs_list' );
 
	}
	
	public function add() {
	 
		if ($this->input->post("mata_uang_dari") && $this->input->post("mata_uang_ke")) {
			//echo $this->input->post("nama_panitia");
			
			$sql = "INSERT INTO EP_MS_MATA_UANG_KURS (MATA_UANG_DARI, MATA_UANG_KE, NILAI, TGL_KURS , TGL_REKAM) ";
			$sql .= " VALUES ('" .$this->input->post("mata_uang_dari"). "','".$this->input->post("mata_uang_ke")."'," . $this->input->post("nilai")   .", TO_DATE('" . $this->input->post("tgl_kurs") . "','YYYY-MM-DD'), TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD'))" ;
			
			$query = $this->db->simple_query($sql);
			
			redirect(base_url() . "index.php/kurs");
		}
		
		$sql = "SELECT MATA_UANG FROM GL_MATA_UANG ";
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		$data["mata_uang"] = $result;
		$this->layout->view('kurs_add', $data);
	}
	 
	public function edit() {
		
		if ($this->input->post("mata_uang_dari") && $this->input->post("mata_uang_ke")) {
			//echo $this->input->post("nama_panitia");
			
			$sql = "UPDATE EP_MS_MATA_UANG_KURS ";
			$sql .= " SET  NILAI= '" .$this->input->post("nilai") . "' ";
			$sql .= "   WHERE MATA_UANG_DARI = '" .$this->input->post("mata_uang_dari") . "' ";
			$sql .= " AND MATA_UANG_KE = '" .$this->input->post("mata_uang_ke") . "' ";
			$sql .= " AND TO_CHAR( TGL_KURS ,'YYYY-MM-DD')  =    '" . substr($this->input->post("tgl_kurs"),0,10) . "' ";
			
			 
			
			$query = $this->db->simple_query($sql);
			redirect(base_url() . "index.php/kurs");
		}	
		
		$sql = "SELECT MATA_UANG_DARI, MATA_UANG_KE, NILAI, TO_CHAR(TGL_KURS,'YYYY-MM-DD') as TGL_KURS ";
		$sql .= " FROM EP_MS_MATA_UANG_KURS ";
		$sql .= " WHERE MATA_UANG_DARI = '" . $this->input->get("MATA_UANG_DARI"). "' ";
		$sql .= " AND MATA_UANG_KE = '" . $this->input->get("MATA_UANG_KE"). "' ";
		$sql .= " AND TO_CHAR(TGL_KURS,'YYYY-MM-DD') = '" . substr($this->input->get("TGL_KURS"),0,10) . "' ";
		
		 
		$query = $this->db->query($sql);
		$result = $query->result();
			
			$mata_uang_dari = "";
			$mata_uang_ke = "";
			$nilai = 0;
			$tgl_kurs = "";
			
		if (count($result)) {
			$mata_uang_dari = $result[0]->MATA_UANG_DARI;
			$mata_uang_ke = $result[0]->MATA_UANG_KE;
			$nilai = $result[0]->NILAI;
			$tgl_kurs = $result[0]->TGL_KURS;
			
			
		
		}
		
		$data["mata_uang_dari"] = $mata_uang_dari;
		$data["mata_uang_ke"] = $mata_uang_ke;
		$data["nilai"] = $nilai;
		$data["tgl_kurs"] = $tgl_kurs;
		
		
		$sql = "SELECT MATA_UANG FROM GL_MATA_UANG ";
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		$data["mata_uang"] = $result;
		$this->layout->view('kurs_edit', $data);
		
	}	
}
