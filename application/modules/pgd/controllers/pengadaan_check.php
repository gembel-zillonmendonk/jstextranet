<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengadaan_check extends MY_Controller {
 	
	function __construct()
        {
            parent::__construct();		  
	}

            function check_tender_item() {
             
            $rtn = 0;
            
            $sql = "SELECT KODE_TENDER , KODE_KANTOR FROM EP_PGD_ITEM_TENDER ";
            $sql .= " WHERE KODE_TENDER = " . $this->input->post("KODE_TENDER");
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "' ";
            
            $query = $this->db->query($sql); 
            $result = $query->result();
            if (count($result)) {
                $rtn = count($result);
            
            }
             
            echo $rtn;
            return; 
		
	}
	 
	
}	