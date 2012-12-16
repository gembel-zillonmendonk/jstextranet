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
class Ep_pgd_penawaran extends MY_Model {

    public $table = "EP_PGD_PENAWARAN";
 
    public $elements_conf = array('KODE_TENDER',
							'KODE_KANTOR',
							'KODE_VENDOR',
							'NO_PENAWARAN',
							'TIPE',
							'BID_BOND',
							'KANDUNGAN_LOKAL',
							'WAKTU_PENGIRIMAN',
							'UNIT',
							'BERLAKU_HINGGA',
							'LAMPIRAN',
							'KETERANGAN',
							 );
			 
    public $columns_conf = array('KODE_TENDER' =>array('hidden'=>true, 'width'=>10) ,
								 'KODE_KANTOR' =>array('hidden'=>true, 'width'=>10),  
								 'KODE_VENDOR'  =>array('hidden'=>false, 'width'=>10),
								 'NO_PENAWARAN'  =>array('hidden'=>false, 'width'=>10),
								 'BERLAKU_HINGGA'  =>array('hidden'=>false, 'width'=>10)
								 );
	
	
    public $sql_select = "(SELECT  KODE_KANTOR ,
							 KODE_VENDOR ,
							 NO_PENAWARAN ,
							 TIPE ,
							 BID_BOND ,
							 KANDUNGAN_LOKAL ,
							 WAKTU_PENGIRIMAN ,
							 UNIT ,
							 BERLAKU_HINGGA ,
							 LAMPIRAN ,
							 KETERANGAN 
						  FROM 	 EP_PGD_PENAWARAN
							 
		)";
	
	function __construct() {
        parent::__construct();
        $this->init();	 
    }
	
}	