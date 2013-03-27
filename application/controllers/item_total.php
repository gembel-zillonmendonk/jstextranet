<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_total extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();		  
	}

	function total() {
           
            
            $sql = "SELECT KODE_TENDER ";
            $sql .= " , KODE_KANTOR ";
            $sql .= " , KODE_VENDOR ";
            $sql .= " , TOTAL ";
            $sql .= " , TOTAL * 1.1 AS TOTAL_PPN ";
            $sql .= " , (TOTAL * 1.1) * 0.01  AS MIN_BIDBOND ";
            $sql .= " FROM (SELECT P.KODE_TENDER
		, P.KODE_KANTOR
		, P.KODE_VENDOR
		, COALESCE(P.JUMLAH,0) * COALESCE(P.HARGA,0)   AS TOTAL
                FROM EP_PGD_ITEM_PENAWARAN P
		)  VW_TOTAL_PENAWARAN ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->get("KODE_TENDER"). "' ";
            $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR"). "' ";
            $sql .= " AND KODE_VENDOR = '" . $this->input->get("KODE_VENDOR"). "' ";
            
            $query = $this->db->query($sql);
            $result = $query->result();
            $data["TOTAL"] = 0;
             $data["TOTAL_PPN"] = 0;
            $data["MIN_BIDBOND"] = 0;
            
            if (count($result)) {
                $data["TOTAL"] = $result[0]->TOTAL;
                $data["TOTAL_PPN"] = $result[0]->TOTAL_PPN;
                $data["MIN_BIDBOND"] = $result[0]->MIN_BIDBOND;
            }
            
            
            
		$this->load->view("pengadaan/item_total", $data);
	}
	 
	
}	