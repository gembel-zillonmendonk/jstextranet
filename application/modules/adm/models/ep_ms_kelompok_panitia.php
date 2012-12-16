<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_ms_kelompok_panitia extends MY_Model
{
    public $table = "EP_MS_KELOMPOK_PANITIA";
	
	 public $elements_conf = array(
        'KODE_PANITIA',
		'KODE_KANTOR',
		
        'NAMA_PANITIA' 
    );
    public $validation = array(
        'KODE_PANITIA',
		'KODE_KANTOR',
        'NAMA_PANITIA'
    );
    public $columns_conf = array(
        'KODE_PANITIA',
		'KODE_KANTOR',
        'NAMA_PANITIA'
    );
    public $sql_select = "(select * from EP_MS_KELOMPOK_PANITIA)";

    function __construct()
    {
        parent::__construct();
        $this->init();
		
    }
	
}
?>	