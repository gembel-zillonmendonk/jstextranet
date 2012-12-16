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
class Hirarki_jabatan extends  CI_Model {
 
	function setMenu(){
		$sql = "SELECT OTO.KODE_OTORISASI , OTO.KODE_JABATAN , J.NAMA_JABATAN,  OTO.KODE_OTORISASI_INDUK FROM EP_MS_OTORISASI AS OTO "; 
		$sql .= " LEFT JOIN MS_JABATAN J ON J.KODE_JABATAN = OTO.KODE_JABATAN ";
		$sql .= " ORDER BY  OTO.KODE_OTORISASI_INDUK ";
		
		$xml = new DOMDocument( "1.0", "ISO-8859-15" );	 
		$this->addLi($xml, 0,"", "T" , "Menu Management","");
		foreach ($query->result_array() as $row)
		{
			 // $arrModule[$row['KODE_MENU']]  = $row['NAMA_MENU'];
			 
			 if ( $row['KODE_MENU_INDUK'] == 0 ) {
				$this->addLi($xml, $row['KODE_OTORISASI'] ,$row['KODE_OTORISASI_INDUK'], "F" , $row['NAMA_JABATAN'],"" . "href");
			 } else {
				//$this->addLi($xml, $row['KODE_MENU'] ,'00000000', "D" , $row['NAMA_MENU'],"" . "href");
				$this->addLi($xml, $row['KODE_OTORISASI'] , $row['KODE_OTORISASI_INDUK'] ,  "D" , $row['NAMA_JABATAN'], "" );
				//$this->addLi($xml, $row['mod_code'], substr($row['mod_code'],0,2) . '000000' ,  "D" , $row['mod_name'], base_url() ."index.php/" . $row['mod_url']);
			 }
		}
		$str = $xml->saveXML();
		
		return $str;	
		 
 
	}
	 
	function addLi($xml,$id, $idparent,$detail , $txt, $link) {
		$xpath = new DOMXpath($xml); 
			$xml_li = $xml->createElement( "li" );
			 if($detail == "T") {
					$xml_li->setAttribute("class", "filetree" );
				}
				
			
				$txtspan = strlen($link) == 0 ?  $txt : ""  ;
				 
				$xml_span = $xml->createElement( "span" , $txtspan);				
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
				
				$xml_li->appendChild( $xml_span );
				$xml_li->setAttribute("id", $id );				
				
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