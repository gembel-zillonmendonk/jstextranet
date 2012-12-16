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
class Ep_pgd_item_penawaran extends MY_Model {

    public $table = "EP_PGD_ITEM_PENAWARAN";
 
    public $elements_conf = array('KODE_KANTOR',
									'KODE_TENDER',
									'KODE_VENDOR',
									'KODE_BARANG_JASA',
									'KODE_SUB_BARANG_JASA',
									'KETERANGAN',
									'JUMLAH',
									'HARGA' 
							 );
			 
    public $columns_conf = array('KODE_TENDER' =>array('hidden'=>true, 'width'=>10) ,
								 'KODE_KANTOR' =>array('hidden'=>true, 'width'=>10),  
								 'KODE_VENDOR'  =>array('hidden'=>false, 'width'=>10),
								 'KODE_BARANG_JASA'  =>array('hidden'=>false, 'width'=>10),
								 'KODE_SUB_BARANG_JASA'  =>array('hidden'=>false, 'width'=>10),
								 'KETERANGAN'  =>array('hidden'=>false, 'width'=>10),
								  'JUMLAH'  =>array('hidden'=>false, 'width'=>10),
								  'HARGA'  =>array('hidden'=>false, 'width'=>10) 
								 );
	
	
    public $sql_select = "(SELECT  
							KODE_KANTOR ,
									 KODE_TENDER ,
									 KODE_VENDOR ,
									 KODE_BARANG_JASA ,
									 KODE_SUB_BARANG_JASA ,
									 KETERANGAN ,
									 JUMLAH ,
									 HARGA  
						  FROM 	 EP_PGD_ITEM_PENAWARAN
							 
		)";
	
	function __construct() {
        parent::__construct();
        $this->init();	 
    }
	
}	