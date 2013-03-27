<?php

class Nomorurut extends CI_Model {
 
    function __construct()
     {
         parent::__construct();
     }
	 
	 function get($kode_kantor, $kode_nomerurut){
	 
		$rtn = 1;
	 
		$sql = "SELECT NOMORURUT FROM EP_NOMORURUT WHERE KODE_KANTOR='" .$kode_kantor . "' AND KODE_NOMORURUT = '" . $kode_nomerurut . "' ";
		$query = $this->db->query($sql);
		
		$result = $query->result();
 
	
		if (count($result)== 0)	{
		 
			$rtn = 1;
		} else {
			$rtn = $result[0]->NOMORURUT;
		}	
		if ($kode_nomerurut == "KELOMPOKJASA") {
			$rtn = "J" . $rtn;
		}
	 
		return $rtn;
	 
	 }
	 
	 function set_plus($kode_kantor, $kode_nomerurut){
	 	 
		$sql = "SELECT NOMORURUT FROM EP_NOMORURUT WHERE KODE_KANTOR='" .$kode_kantor . "' AND KODE_NOMORURUT = '" . $kode_nomerurut . "' ";
		$query = $this->db->query($sql);
		
		$result = $query->result();
 
	
		if (count($result)== 0)	{
		
			$sql = "INSERT INTO EP_NOMORURUT (KODE_KANTOR,KODE_NOMORURUT,NOMORURUT, TGL_REKAM, PETUGAS_REKAM ) ";
			$sql .= " VALUES ('" .$kode_kantor . "', '" . $kode_nomerurut . "',2, TO_DATE('" .date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS'  ) ,'" .  $this->session->userdata("kode_user")."') ";
			$this->db->simple_query($sql);
			  
		} else {
			$urut = $result[0]->NOMORURUT + 1;
			$sql = "UPDATE EP_NOMORURUT ";
                        $sql .= " SET  NOMORURUT = ".$urut ;
			$sql .= " , TGL_UBAH = TO_DATE('" .date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' ) ";
                        $sql .= " , PETUGAS_UBAH = '". $this->session->userdata("kode_user")."' ";
                        
                        $sql .= " WHERE  KODE_KANTOR = '" .$kode_kantor . "' AND KODE_NOMORURUT =  '" . $kode_nomerurut . "' ";
			 
			$this->db->simple_query($sql);
			
			
		}	
	 
 
	 
	 }
	 
	 
 }