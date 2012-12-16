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
class Ep_pgd_perencanaan_anggaran extends MY_Model {

    public $table = "EP_PGD_PERENCANAAN_ANGGARAN";
	
	
    public $elements_conf = array('KODE_PERENCANAAN',
                            'KODE_KANTOR',
                            'TAHUN'          	 ,
                            'KODE_KANTOR_ANGGARAN',
                            'KELOMPOK_MA',
                            'KODE_MA'      ,
                            'AKUN',
                            'NAMA_AKUN',
                            'PAGU_ANGGARAN',
                            'SISA_ANGGARAN',
                              );
			 
    public $columns_conf = array('KODE_PERENCANAAN' =>array('hidden'=>true, 'width'=>0) ,
                                'KODE_KANTOR' =>array('hidden'=>true, 'width'=>0) ,
                                'TAHUN' =>array('hidden'=>true, 'width'=>0) ,          	 
                             'KODE_KANTOR_ANGGARAN' =>array('hidden'=>true, 'width'=>0) ,
                             'KELOMPOK_MA' =>array('hidden'=>true, 'width'=>0),
                             'KODE_MA' =>array('hidden'=>true, 'width'=>0)     ,
                             'AKUN' =>array('hidden'=>false, 'width'=>10),
                             'NAMA_AKUN' =>array('hidden'=>false, 'width'=>70),
                             'PAGU_ANGGARAN' =>array('hidden'=>false, 'width'=>10),
                             'SISA_ANGGARAN' =>array('hidden'=>false, 'width'=>10)
                                );
	
	
    public $sql_select = "(SELECT 
                             P.KODE_PERENCANAAN ,
                             P.KODE_KANTOR ,
                             P.TAHUN,           
                             P.KODE_KANTOR_ANGGARAN ,
                             P.KELOMPOK_MA ,
                             P.KODE_MA       ,
                             P.AKUN, 
                             P.NAMA_AKUN ,
                             P.PAGU_ANGGARAN ,
                             P.SISA_ANGGARAN 
                FROM EP_PGD_PERENCANAAN_ANGGARAN P
		WHERE 1 = 1 
		 ";
     
    
	function __construct() {
            parent::__construct();
            $this->init();	 
             
        
           // print_r($_GET);
            
            if ($this->input->get("KODE_PERENCANAAN")){
                //echo "xxxx";
                $this->session->set_userdata("KODE_PERENCANAAN",$this->input->get("KODE_PERENCANAAN")  );
                
                
            }
            if ($this->input->get("KODE_KANTOR_PERENCANAAN")){
                
                    $this->session->set_userdata("KODE_KANTOR_PERENCANAAN",$this->input->get("KODE_KANTOR_PERENCANAAN")  );
            }

                $this->sql_select  = $this->sql_select . " AND KODE_PERENCANAAN = " .  $this->session->userdata("KODE_PERENCANAAN"). "  ";
                $this->sql_select  = $this->sql_select . " AND KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_PERENCANAAN"). "'  ";
            
                
            $this->sql_select  = $this->sql_select . " )";
             
           // echo $this->sql_select; 
        }
	
	

}