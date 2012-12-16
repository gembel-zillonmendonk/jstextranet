<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jasa_approve extends MY_Controller {

	function approve() {
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
			
                         $this->load->model('alurkerja','alur');
                        
                        $this->alur->mulai(1);
                        $data["rs_response"] = $this->alur->getTransisi(10002);
             
			print_r($data["rs_response"]);
			$this->layout->view('jasa_edit', $data );
	
	}

}	