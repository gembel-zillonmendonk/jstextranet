<?php
class Kom_aktifitas extends CI_Model {

	function __construct() {
        parent::__construct();
        
    }

	
	function getResponse($act_id) {
		 
		
		$sql = "SELECT KODE_RESPON_KOM, NAMA  FROM EP_KOM_RESPON ";
		$sql .= " WHERE KODE_AKTIFITAS = " . $act_id;
		$query = $this->db->query($sql);
		
		$result = $query->result(); 
		
		return $result;
		
	}
	
	
}