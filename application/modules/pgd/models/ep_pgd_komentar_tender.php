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
class Ep_pgd_komentar_tender extends MY_Model {

    public $table = "EP_PGD_KOMENTAR_TENDER";
	
	
    public $elements_conf = array('KODE_TENDER',
'KODE_KANTOR',
'KODE_TENDER_SEBELUM',
'KODE_TENDER_SESUDAH',
'NAMA_PEMOHON',
'KODE_JAB_PEMOHON',
'NAMA_PERENCANA',
'KODE_JAB_PERENCANA',
'NAMA_PELAKSANA',
'KODE_JAB_PELAKSANA',
'TGL_PEMBUATAN',
'JUDUL_PEKERJAAN',
'LINGKUP_PEKERJAAN',
'WAKTU_PENGIRIMAN',
'UNIT_PENGIRIMAN',
'NAMA_PEMBELI',
'KODE_JAB_PEMBELI',
'MATA_UANG',
'TIPE_KONTRAK',
'NAMA_JAB_PESERTA',
'KODE_JAB_PESERTA',
'PEMBUATAN_KONTRAK',
'STATUS',
'TGL_SELESAI',
'KODE_PERENCANAAN',
'KODE_KANTOR_PERENCANAAN' 
	
		);
			 
    public $columns_conf = array(
            'KODE_KOMENTAR' =>array('hidden'=>true, 'width'=>0) ,
	    'KODE_TENDER' =>array('hidden'=>true, 'width'=>0) ,
	    'KODE_KANTOR' =>array('hidden'=>true, 'width'=>0),  
	    'NAMA_JABATAN'  =>array('hidden'=>false, 'width'=>10),
	    'NAMA'  =>array('hidden'=>false, 'width'=>10),
	    'NAMA_AKTIFITAS'  =>array('hidden'=>false, 'width'=>10),
            'TGL_MULAI'  =>array('hidden'=>false, 'width'=>10),
            'TGL_BERAKHIR'  =>array('hidden'=>false, 'width'=>10),
            'NAMA_TRANSISI'  =>array('hidden'=>false, 'width'=>10),
            'KOMENTAR'  =>array('hidden'=>false, 'width'=>10),
            'ATTACHMENT'  =>array('hidden'=>false, 'width'=>10),
	  
        );
	
	
    public $sql_select = "(SELECT 
   KODE_KOMENTAR
   , KODE_TENDER
   , KODE_KANTOR
   , KODE_JABATAN
   , NAMA_JABATAN
   , NAMA
   , KODE_AKTIFITAS
   , NAMA_AKTIFITAS
   , KODE_TRANSISI
   , NAMA_TRANSISI
   , TGL_MULAI
   , TGL_BERAKHIR
   , KOMENTAR
   , ATTACHMENT 
FROM EP_PGD_KOMENTAR_TENDER
WHERE KODE_ALURKERJA = 5";
 
 
	
    	
    function setParam() {
                 if ($this->input->get("KODE_TENDER")){
                //echo "xxxx";
                $this->session->set_userdata("KODE_TENDER",$this->input->get("KODE_TENDER")  );
                
                
            }
            if ($this->input->get("KODE_KANTOR")){
                
                    $this->session->set_userdata("KODE_KANTOR_TENDER",$this->input->get("KODE_KANTOR")  );
            }

                $this->sql_select  = $this->sql_select . " AND KODE_TENDER = " .  $this->session->userdata("KODE_TENDER"). "  ";
                $this->sql_select  = $this->sql_select . " AND  KODE_KANTOR = '" .  $this->session->userdata("KODE_KANTOR_TENDER"). "'  ";
            
                
            $this->sql_select  = $this->sql_select . " )";  
        
    }
	
    
    function __construct() {
        parent::__construct();
        $this->init();	 
        $this->setParam();
        
    }
	
	
	

}