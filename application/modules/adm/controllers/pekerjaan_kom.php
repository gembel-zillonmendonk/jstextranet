<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerjaan_kom extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
	 }
	
	function index() {		 
		$this->layout->view('pekerjaan_kom_list' );
	}

        
        function harga_barang_approve() {
               $this->load->model('kom_aktifitas','akt');
                $data["rs_respon"] = $this->akt->getResponse(30001);
       
			
 
	
			$sql = "SELECT K.KODE_KOMENTAR , J.KODE_JASA, J.KODE_KEL_JASA, J.NAMA_JASA ";
			$sql .= " FROM EP_KOM_KOMENTAR K ";
			$sql .= " LEFT JOIN EP_KOM_JASA J ON K.KODE_JASA_BARANG = J.KODE_JASA ";
			$sql .= " WHERE K.KODE_KOMENTAR = '" . $this->input->get("KODE_KOMENTAR") . "' " ;  
	
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
			$data["kode_komentar"] = $this->input->get("KODE_KOMENTAR"); 
                        
                        $this->load->model('alurkerja','alur');
                        
                        $this->alur->mulai(2);
                        $data["kode_alurkerja"] = 2;
                        $data["rs_transisi"] = $this->alur->getTransisi(30002);
             
                      
			
			$this->layout->view('harga_barang_approve', $data );
        }
	
        function harga_jasa_approve() {
                        $this->load->model('kom_aktifitas','akt');
			$data["rs_respon"] = $this->akt->getResponse(20001);
			
 
	
			$sql = "SELECT K.KODE_KOMENTAR , J.KODE_JASA, J.KODE_KEL_JASA, J.NAMA_JASA ";
			$sql .= " FROM EP_KOM_KOMENTAR K ";
			$sql .= " LEFT JOIN EP_KOM_JASA J ON K.KODE_JASA_BARANG = J.KODE_JASA ";
			$sql .= " WHERE K.KODE_KOMENTAR = '" . $this->input->get("KODE_KOMENTAR") . "' " ;  
	
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
			$data["kode_komentar"] = $this->input->get("KODE_KOMENTAR"); 
                        
                         $this->load->model('alurkerja','alur');
                        
                        $this->alur->mulai(2);
                        $data["kode_alurkerja"] = 2;
                        $data["rs_transisi"] = $this->alur->getTransisi(20002);
             
                      
			
			$this->layout->view('harga_jasa_approve', $data );
            
        }
        
	function jasa_approve() {
	
			$this->load->model('kom_aktifitas','akt');
			
			$data["rs_respon"] = $this->akt->getResponse(10001);
			
 
	
			$sql = "SELECT K.KODE_KOMENTAR , J.KODE_JASA, J.KODE_KEL_JASA, J.NAMA_JASA ";
			$sql .= " FROM EP_KOM_KOMENTAR K ";
			$sql .= " LEFT JOIN EP_KOM_JASA J ON K.KODE_JASA_BARANG = J.KODE_JASA ";
			$sql .= " WHERE K.KODE_KOMENTAR = '" . $this->input->get("KODE_KOMENTAR") . "' " ;  
	
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
			$data["kode_komentar"] = $this->input->get("KODE_KOMENTAR"); 
                        
                            $this->load->model('alurkerja','alur');
                        
                        $this->alur->mulai(1);
                        $data["kode_alurkerja"] = 1;
                        $data["rs_transisi"] = $this->alur->getTransisi(10002);
             
                      
			
			$this->layout->view('jasa_approve', $data );
	 }
	
}	
	