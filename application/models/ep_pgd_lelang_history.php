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
class Ep_pgd_lelang_history extends MY_Model {

    public $table = "EP_PGD_TENDER";
 
    public $elements_conf = array('KODE_DOKUMEN',
                                   'KODE_TENDER',
                                            'KODE_KANTOR',
						'KATEGORI',
						'KETERANGAN',
						'NAMA_FILE'  );
			 
    public $columns_conf = array(
                               
                                'KODE_TENDER' =>array('hidden'=>true, 'width'=>10) ,
                                'KODE_KANTOR' =>array('hidden'=>true, 'width'=>10),  
                                'JUDUL_PEKERJAAN'  =>array('hidden'=>false, 'width'=>60),
                                'TGL_PEMBUKAAN_REG'  =>array('hidden'=>false, 'width'=>20), 
                                'TGL_PENUTUPAN_REG'  =>array('hidden'=>false, 'width'=>20) 
                                );
    
    
    public $sql_select = "(SELECT T.KODE_TENDER, T.KODE_KANTOR, T.JUDUL_PEKERJAAN, P.TGL_PEMBUKAAN_REG, TGL_PENUTUPAN_REG
                FROM   EP_PGD_TENDER T
                INNER JOIN EP_PGD_KOMENTAR_TENDER K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
                INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
                WHERE P.METODE_TENDER = 2
                ";
		   
	
	function __construct() {
        parent::__construct();
        $this->init();	 
        

            
    }
	
}	