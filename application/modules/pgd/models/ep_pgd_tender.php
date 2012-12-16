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
class Ep_pgd_tender extends MY_Model {

    public $table = "EP_PGD_TENDER";
	
	
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
			 
    public $columns_conf = array('KODE_TENDER' =>array('hidden'=>false, 'width'=>10) ,
								 'KODE_KANTOR' =>array('hidden'=>false, 'width'=>10),  
								 'NAMA_PEMOHON'  =>array('hidden'=>false, 'width'=>10),
								 'JUDUL_PEKERJAAN'  =>array('hidden'=>false, 'width'=>10),
								 'STATUS'  =>array('hidden'=>false, 'width'=>10),
								 'PELAKU_PROSES'  =>array('hidden'=>false, 'width'=>10)
								 );
	
	
    public $sql_select = "(SELECT T.KODE_TENDER, T.KODE_KANTOR , T.NAMA_PEMOHON, T.JUDUL_PEKERJAAN, '' AS STATUS, '' AS PELAKU_PROSES
		FROM EP_PGD_TENDER T
		)";
	
	function __construct() {
        parent::__construct();
        $this->init();	 
    }
	
	
	

}