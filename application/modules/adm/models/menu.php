<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 *  
 */
class Menu extends  CI_Model {
 
	function setMenu(){
		$sql = "SELECT KODE_MENU , NAMA_MENU KODE_MENU_INDUK FROM EP_MS_MENU WHERE KODE_MENU > 0";
		//echo $sql;
		$query = $this->db->query($sql);
		 
		$arrModule = array(); 
		$xml = new DOMDocument( "1.0", "ISO-8859-15" );	 
		$this->addLi($xml, "00000000" ,"", "F" , "CRV-0","");
		foreach ($query->result_array() as $row)
		{
			 $arrModule[$row['mod_code']]  = $row['mod_name'];
			 if (substr($row['mod_code'],2,6) == '000000') {
				$this->addLi($xml, $row['mod_code'] ,'00000000', "F" , $row['mod_name'],"" . $row['mod_url']);
			 } else {
				$this->addLi($xml, $row['mod_code'], substr($row['mod_code'],0,2) . '000000' ,  "D" , $row['mod_name'], base_url() ."index.php/" . $row['mod_url']);
			 }
		}
		$str = $xml->saveXML();
		
		echo $str;	
		//$this->session->set_userdata("menu", $str );
		//$this->session->set_userdata("module", $arrModule);
		 
 
	}
	 
 
    function __construct() {
        parent::__construct();
 
    }

}

?>