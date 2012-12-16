<?php
class App_security extends CI_Model {
  
   
    function __construct() {
        parent::__construct();
        
		//echo $this->_module;
    }

	function login() {
		
		$kode_user = 'USER01';
		$kode_jabatan = 	81;
		$kode_kantor = 	'44A';
		
		 
		$sql = "SELECT KODE_KANTOR, NAMA_KANTOR FROM MS_KANTOR ";
		$sql .= " WHERE KODE_KANTOR = '" . $kode_kantor . "' ";
		
		$query = $this->db->query($sql);
		$result = $query->result(); 
		
		if(count($result)) {
			$this->session->set_userdata("kode_user", $kode_user );
			$this->session->set_userdata("user_id", $kode_user );
			$this->session->set_userdata("kode_kantor", $kode_kantor );
			$this->session->set_userdata("nama_kantor", $result[0]->NAMA_KANTOR);
			
		} 
		$sql = "SELECT KODE_JABATAN, NAMA_JABATAN FROM MS_JABATAN ";
		$sql .= " WHERE KODE_JABATAN = '" . $kode_jabatan . "' ";
		
		$query = $this->db->query($sql);
		$result = $query->result(); 
		
		if(count($result)) {  
			$this->session->set_userdata("kode_jabatan", $kode_jabatan );
			$this->session->set_userdata("nama_jabatan", $result[0]->NAMA_JABATAN);
		}
		
		 
		
		
		
		return TRUE;		
	}
	
	function logout() {
 		 redirect( base_url() . "index.php/app");
	}
	
	function getMenuAkses() {

		$sql = "SELECT KODE_MENU as [P!1!L1] KODE_MENU, NULL as [P!2!L2] KODE_MENU, NAMA_MENU FROM EP_MS_MENU WHERE TINGKAT = 1 ";
		$sql .= " UNION ALL ";
		$sql .= " SELECT KODE_MENU as [P!1!L1] KODE_MENU, KODE_MENU as [P!2!L2] KODE_MENU, NAMA_MENU FROM EP_MS_MENU WHERE TINGKAT = 2 ";
		$sql .= " ORDER BY [P!1!L1] , [P!2!L2]  ";
		
		$sql = "SELECT M.KODE_MENU, M.NAMA_MENU , M.KODE_MENU_INDUK, M.CONTROLLER
			FROM   EP_MS_MENU M
			START WITH  M.KODE_MENU = 0 
			CONNECT BY PRIOR M.KODE_MENU = M.KODE_MENU_INDUK 
			ORDER BY M.KODE_MENU ";
		
		// echo $sql;
		
		$query = $this->db->query($sql);
		$result = $query->result(); 
		
 

		$xml = new DOMDocument( "1.0", "ISO-8859-15" );	 
	 	$this->addUl($xml, "0" ,"", "F" , "CRV-0","");
		
		foreach ($query->result_array() as $row)
		{
			if ($row["KODE_MENU"] > 0) { 
				if ($row["KODE_MENU_INDUK"] == 0) {
					$this->addLi($xml, $row["KODE_MENU"] , $row["KODE_MENU_INDUK"] , "" , $row["NAMA_MENU"] , "" , 1);
				} else {
					$this->addLi($xml, $row["KODE_MENU"] , $row["KODE_MENU_INDUK"] , "" , $row["NAMA_MENU"] ,$row["CONTROLLER"], 2);
				}
			}	
		}			
		
		
		  
		
		 
		
		  return $xml->saveXML() ;
		 
	}
	
	
	function addUl($xml,$id, $idparent,$detail , $txt, $link) {
		$xpath = new DOMXpath($xml); 
			 
			if (strlen($idparent) == 0 ) {
				$xml_ul = $xml->createElement( "ul");
				$xml_ul->setAttribute("class", "sf-menu" );
				$xml->appendChild( $xml_ul );
			}  
		}	

	function addLi($xml,$id, $idparent,$detail , $txt, $link, $level) {
		$link = strlen($link) == 0 ? " " : base_url() . "index.php/" . $link ;
		$xpath = new DOMXpath($xml); 
			$xml_li = $xml->createElement( "li" );
				$txtspan = strlen($link) == 0 ?  $txt : ""  ;
				 $txtspan = $txt;
 				if ($link !=  (base_url() . "index.php/")) {
					if (strlen($link) > 0) {
						
					
						$xml_a = $xml->createElement( "a" ,  $txt) ;
						$xml_a->setAttribute("href", $link );
		 
						$xml_li->appendChild($xml_a);
					}
				}
				
 				$xml_li->setAttribute("id", $id );	
				 
			if ( $level  == 1 ) {
				$elements = $xpath->query("//ul[@class='sf-menu']");
				$node = $elements->item(0);
				$node->appendChild( $xml_li );
					
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
	
 
}
 