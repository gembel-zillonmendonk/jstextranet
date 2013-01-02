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
class Ep_pgd_pesan_tender extends MY_Model {

    public $table = "EP_PGD_PESAN_TENDER";
 
    public $elements_conf = array('KODE_PESAN_TENDER',
                                   'KODE_TENDER',
                                   'KODE_KANTOR',
				   'KODE_AKTIFITAS',
			           'KODE_VENDOR',
				   'TGL_PESAN',
                                   'PESAN');
			 
    public $columns_conf = array(
                                'KODE_PESAN_TENDER' =>array('hidden'=>true, 'width'=>0),
                                'KODE_TENDER' =>array('hidden'=>true, 'width'=>10) ,
                                'KODE_KANTOR' =>array('hidden'=>true, 'width'=>10),
                                'KODE_VENDOR' =>array('hidden'=>true, 'width'=>10),
                                'NAMA_AKTIFITAS'  =>array('hidden'=>false, 'width'=>20),
                                'TGL_PESAN'  =>array('hidden'=>false, 'width'=>10),
                                'DARI'  =>array('hidden'=>false, 'width'=>10),
                                'UNTUK'  =>array('hidden'=>false, 'width'=>10),
                                'PESAN'  =>array('hidden'=>false, 'width'=>50) 
                                );
    
    
    public $sql_select = "(SELECT  KODE_PESAN_TENDER  ,
                                   KODE_TENDER ,
                                   KODE_KANTOR ,
                                   KODE_VENDOR ,
				   NAMA_AKTIFITAS ,
				   TGL_PESAN,
                                   DARI,
                                   UNTUK,
                                   PESAN 
                            FROM VW_PESAN_NEGOSIASI
                            WHERE 1 = 1
		 ";
	
    function setParam() {
            if ($this->input->get("KODE_TENDER")){
                //echo "xxxx";
                $this->session->set_userdata("KODE_TENDER",$this->input->get("KODE_TENDER")  );
                
                
            }
            if ($this->input->get("KODE_KANTOR")){
                
                    $this->session->set_userdata("KODE_KANTOR_TENDER",$this->input->get("KODE_KANTOR")  );
            }

                $this->sql_select  = $this->sql_select . " AND KODE_TENDER = '" .  $this->session->userdata("KODE_TENDER"). "'  ";
                $this->sql_select  = $this->sql_select . " AND KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'  ";
            
                
            $this->sql_select  = $this->sql_select . "   )";  
        
    }
	
	
    function __construct() {
        parent::__construct();
        $this->init();	 
        $this->setParam();
    
        
    }
	
}	