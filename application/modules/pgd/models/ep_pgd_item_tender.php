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
class Ep_pgd_item_tender extends MY_Model {

    public $table = "EP_PGD_ITEM_TENDER";
 
    public $elements_conf = array('KODE_TENDER',
						'KODE_KANTOR',
						'KODE_BARANG_JASA',
						'KODE_SUB_BARANG_JASA',
						'KETERANGAN',
						'JUMLAH',
						'UNIT',
						'HARGA' );
			 
    public $columns_conf = array('KODE_TENDER' =>array('hidden'=>true, 'width'=>10) ,
								 'KODE_KANTOR' =>array('hidden'=>true, 'width'=>10),  
								 'KODE_BARANG_JASA'  =>array('hidden'=>false, 'width'=>10),
								 'NAMA_BARANG_JASA'  =>array('hidden'=>false, 'width'=>60),
								 'JUMLAH'  =>array('hidden'=>false, 'width'=>10),
								 'HARGA'  =>array('hidden'=>false, 'width'=>10),
								 'SUBTOTAL'   =>array('hidden'=>false, 'width'=>10)
								 );
	
    function setParam() {
                 if ($this->input->get("KODE_TENDER")){
                //echo "xxxx";
                $this->session->set_userdata("KODE_TENDER",$this->input->get("KODE_TENDER")  );
                
                
            }
            if ($this->input->get("KODE_KANTOR")){
                
                    $this->session->set_userdata("KODE_KANTOR_TENDER",$this->input->get("KODE_KANTOR")  );
            }

                $this->sql_select  = $this->sql_select . " AND T.KODE_TENDER = " .  $this->session->userdata("KODE_TENDER"). "  ";
                $this->sql_select  = $this->sql_select . " AND T.KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'  ";
            
                
            $this->sql_select  = $this->sql_select . " )";  
        
    }
	
    public $sql_select = "(SELECT T.KODE_BARANG_JASA , J.NAMA_BARANG_JASA,  T.JUMLAH, T.UNIT, T.HARGA,  T.JUMLAH *  T.HARGA AS SUBTOTAL
		FROM EP_PGD_ITEM_TENDER T
		LEFT JOIN (
			SELECT KODE_JASA, KODE_KEL_JASA, NAMA_JASA AS NAMA_BARANG_JASA 
			FROM
			EP_KOM_JASA
			UNION ALL
			SELECT KODE_BARANG, KODE_SUB_BARANG, NAMA_BARANG
			FROM
			MS_BARANG
		) J ON T.KODE_BARANG_JASA = J.KODE_JASA  AND T.KODE_SUB_BARANG_JASA = J.KODE_KEL_JASA
                WHERE 1 = 1
		 ";
	
	function __construct() {
        parent::__construct();
        $this->init();	 
        $this->setParam();
        

            
    }
	
}	