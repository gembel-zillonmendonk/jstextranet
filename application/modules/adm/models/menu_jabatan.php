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
class Menu_jabatan extends  CI_Model {
 
	function setMenu($kode_jabatan){
		/*
		$sql = "SELECT M.KODE_MENU , M.NAMA_MENU,  M.KODE_MENU_INDUK, MJ.KODE_MENU as KODE_MENU_MJ  FROM EP_MS_MENU M    ";
		$sql .= " LEFT JOIN (SELECT KODE_MENU FROM EP_MS_MENU_JABATAN  WHERE KODE_JABATAN = ".$kode_jabatan." ) MJ ON M.KODE_MENU = MJ.KODE_MENU ";
		$sql .= " WHERE M.KODE_MENU > 0 ORDER BY KODE_MENU_INDUK ";
		 */
		 
		 
		$sql = " SELECT M.KODE_MENU , M.NAMA_MENU,  M.KODE_MENU_INDUK, MJ.KODE_MENU as KODE_MENU_MJ  FROM EP_MS_MENU M  
					LEFT JOIN (SELECT KODE_MENU FROM EP_MS_MENU_JABATAN  WHERE KODE_JABATAN = ".$kode_jabatan." ) MJ ON M.KODE_MENU = MJ.KODE_MENU	
					START WITH  M.KODE_MENU = 0 
					CONNECT BY PRIOR M.KODE_MENU = M.KODE_MENU_INDUK 
					ORDER BY M.URUT ";
 		
 		$query = $this->db->query($sql);
 		
		$arrModule = array(); 
		$xml = new DOMDocument( "1.0", "ISO-8859-15" );	 
		// $this->addLi($xml, 0,"", "T" , "Menu Management","","");
		foreach ($query->result_array() as $row)
		{
			 // $arrModule[$row['KODE_MENU']]  = $row['NAMA_MENU'];
			 
			 if ( $row['KODE_MENU_INDUK'] == 0 ) {
				$this->addLi($xml, $row['KODE_MENU'] ,$row['KODE_MENU_INDUK'], "F" , $row['NAMA_MENU'],"" . "href" , $row['KODE_MENU_MJ'] );
			 } else {
				//$this->addLi($xml, $row['KODE_MENU'] ,'00000000', "D" , $row['NAMA_MENU'],"" . "href");
				$this->addLi($xml, $row['KODE_MENU'] , $row['KODE_MENU_INDUK'] ,  "D" , $row['NAMA_MENU'], "" , $row['KODE_MENU_MJ']);
				//$this->addLi($xml, $row['mod_code'], substr($row['mod_code'],0,2) . '000000' ,  "D" , $row['mod_name'], base_url() ."index.php/" . $row['mod_url']);
			 }
		}
		$str = $xml->saveXML();
		
		return $str;	
		 
 
	}
	 
	function addLi($xml,$id, $idparent,$detail , $txt, $link, $menujab) {
		$xpath = new DOMXpath($xml); 
			$xml_li = $xml->createElement( "li" );
			 if($detail == "T") {
					$xml_li->setAttribute("class", "filetree" );
				}
				
			$txtspan = $txt;
				//$txtspan = strlen($link) == 0 ?  $txt : ""  ;
				$xml_check = $xml->createElement( "input" ,  $txtspan );
				$xml_check->setAttribute("type", "checkbox" );
				$xml_check->setAttribute("class", "chk" );
				
				$xml_check->setAttribute("id",   $id );		
				$xml_check->setAttribute("parent", $idparent );				
				if ($menujab) {
					$xml_check->setAttribute("checked",   true );			
				
				}				
				
				
				$xml_span = $xml->createElement( "span" ,"");		
/* 				
				if ($detail == "D") {
					$xml_span->setAttribute("class", "file" );
				} elseif($detail == "F") {
					$xml_span->setAttribute("class", "folder" );
				} 

				if (strlen($link) > 0) {
					$xml_a = $xml->createElement( "a" ,  $txt) ;
					$xml_a->setAttribute("href", $link );
	 
					$xml_span->appendChild($xml_a);
				}
 */	
	$xml_span->appendChild( $xml_check);
				
				$xml_li->appendChild( $xml_span );
				$xml_li->setAttribute("id", "N" + $id );				
				
			if (strlen($idparent) == 0 ) {
				$xml_ul = $xml->createElement( "ul");
				$xml_li->appendChild($xml_ul);
				$xml->appendChild( $xml_li );
					
			} else {
				$elements = $xpath->query("//li[@id='".$idparent."']/ul");
				if ($elements->length > 0) {				
					$node = $elements->item(0);
					$node->appendChild( $xml_li );
				} else {
					$elements = $xpath->query("//li[@id='".$idparent."']");
					$xml_ul = $xml->createElement( "ul");
					$xml_ul->appendChild($xml_li);
					$node = $elements->item(0);
					$node->appendChild( $xml_ul );
					 
				}
				
			}
		} 
	 
 
    function __construct() {
        parent::__construct();
 
    }

}

?>