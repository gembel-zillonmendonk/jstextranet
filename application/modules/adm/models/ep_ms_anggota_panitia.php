<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_ms_anggota_panitia extends MY_Model
{
    public $table = "EP_MS_ANGGOTA_PANITIA";
	
	 public $elements_conf = array(
        'KODE_PANITIA',
		'KODE_KANTOR',
        'KODE_JABATAN',
        'STATUS_PEMIMPIN'
		
    );
    public $validation = array(
         'KODE_PANITIA',
		'KODE_KANTOR',
        'KODE_JABATAN',
        'STATUS_PEMIMPIN'
    );
    public $columns_conf = array(
         'KODE_PANITIA',
		'KODE_KANTOR',
        'KODE_JABATAN',
		'NAMA_JABATAN',
        'STATUS_PEMIMPIN'
    );
    public $sql_select = "(select P.KODE_PANITIA, P.KODE_KANTOR, P.KODE_JABATAN , J.NAMA_JABATAN
						from EP_MS_ANGGOTA_PANITIA P 
						LEFT JOIN MS_JABATAN J ON P.KODE_JABATAN = J.KODE_JABATAN
						";

	
	function setParam() {
		  $this->sql_select = $this->sql_select . " WHERE  P.KODE_PANITIA = " . $this->session->userdata("kode_panitia") . " ";
		  $this->sql_select = $this->sql_select . " AND  P.KODE_KANTOR = '" . $this->session->userdata("kode_kantor_panitia") . "' )" ;
		  
		 
    }
 
    function __construct()
    {
        parent::__construct();
        $this->init();
		$this->setParam();
		$CI = & get_instance();
        $this->attributes['KODE_PANITIA'] = $CI->session->userdata('kode_panitia');
		
    }
	
}
?>	