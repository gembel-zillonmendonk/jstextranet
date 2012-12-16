<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vendor
 *
 * @author farid
 */
class Eksekusi_procedure extends MY_Controller
{
 
    public function __construct()
    {
        parent::__construct();
     
    }
    
    function index() {
	//	$sql = "set serveroutput on size 100000; ";
		 
		//$this->db->call_function('exec  pkg_sample.display_users');
		/*
		     $params = array(
                        array('name'=>':p_num', 'value'=>$dat, 'type'=>SQLT_NUM, 'length'=>-1),
                        array('name'=>':p_out', 'value'=>&$res2, 'type'=>OCI_B_INT, 'length'=>-1)
                        );
			*/
		//	$params = array();
			
                               
       // $rs = $this->db->stored_procedure('pkg_sample','display_users', $params   );
		//print_r($this->db->stored_procedure('pkg_sample','display_users', $params   ));
		/*
		$params = array(
                array('name' => ':params1', 'value' => $params1_val, 'type' => SQLT_CHR, 'length' => 32),
		array('name' => ':params2', 'value' => $params2_val, 'type' => SQLT_CHR, 'length' => 32),
		array('name' => ':params3', 'value' => $params3_val, 'type' => SQLT_CHR, 'length' => 32)
		);
		*/
		/*
		$params = array();
		$stmt = oci_parse($this->db->conn_id, "begin pkg_sample.display_users ; end;");

		
		$entr =  oci_new_cursor($this->db->conn_id); 
		
		
		ociexecute($stmt);
ociexecute($entr); 
		
		while($row = oci_fetch_assoc($entr)) {
			print_r($row);
		}
			*/
			$result = oci_new_cursor( $this->db->conn_id );
			$sqlString = 'BEGIN pkg_sample.get_users(:o_users) ;  END;';
			$stmt = oci_parse (  $this->db->conn_id, $sqlString );
			oci_bind_by_name ( $stmt, ':o_users', $result, -1, OCI_B_CURSOR);
			
			 

			//Execute query
			if (oci_execute ( $stmt )) {
				//Execute cursor
				oci_execute($result);  //Or you can return the cursor.
			}

			oci_fetch_all($result, $res);
			  var_dump($res);
			//foreach($res as $row ) {
			//	print_r($row[0]->USERNAME);
			//}
			
		echo "TEST";
	
	}
}
?>
