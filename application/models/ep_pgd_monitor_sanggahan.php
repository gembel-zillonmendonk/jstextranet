<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author farid
 */
class Ep_pgd_monitor_sanggahan extends MY_Model {
    
    public $table = "EP_PGD_TENDER_SANGGAHAN";
    public $columns_conf = array(
        'KODE_TENDER'  =>array('hidden'=>true, 'width'=>10),   
        'KODE_KANTOR'  =>array('hidden'=>true, 'width'=>10),   
        'KODE_VENDOR'  =>array('hidden'=>true, 'width'=>10),  
        'JUDUL_PEKERJAAN'  =>array('hidden'=>false, 'width'=>30),  
        'JUDUL' =>array('hidden'=>false, 'width'=>30),  
        'SUBSTANSI'    =>array('hidden'=>false, 'width'=>30)   
        );
    public $sql_select = "(
        SELECT T.JUDUL_PEKERJAAN, S.JUDUL, S.SUBSTANSI from EP_PGD_TENDER_SANGGAHAN S 
        INNER JOIN EP_PGD_TENDER T ON S.KODE_TENDER = T.KODE_TENDER AND S.KODE_KANTOR = T.KODE_KANTOR
         WHERE 1 = 1 ";
    
    
    	
    function setParam() {
                  
            if ($this->input->get("KODE_VENDOR")){
                
                $this->session->set_userdata('kode_vendor', $this->input->get("KODE_VENDOR") );
                     
            }

            $this->sql_select  = $this->sql_select . " AND S.KODE_VENDOR = '" .  $this->session->userdata("kode_vendor"). "'  ";
            $this->sql_select  = $this->sql_select . " )";  
          
        
    }
	
 
    
    
    function __construct() {
        parent::__construct();
        $this->init();
        $this->setParam();
    }

}

?>