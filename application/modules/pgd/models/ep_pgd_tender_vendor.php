<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author  
 */
class Ep_pgd_tender_vendor extends MY_Model {

    public $table = "EP_PGD_TENDER_VENDOR";
 
    public $elements_conf = array('KODE_TENDER',
                            'KODE_KANTOR',
                            'KODE_VENDOR',
                            );
			 
    public $columns_conf = array( 
                            'NAMA_VENDOR' =>array('hidden'=>false, 'width'=>100)    
                            );

	
    public $sql_select = "(SELECT T.KODE_TENDER , T.KODE_KANTOR, T.KODE_VENDOR, V.NAMA_VENDOR
                           FROM EP_PGD_TENDER_VENDOR T  
                           LEFT JOIN EP_VENDOR V ON T.KODE_VENDOR = V.KODE_VENDOR
                           )";
	
	function __construct() {
        parent::__construct();
        $this->init();	 
    }
	
}	