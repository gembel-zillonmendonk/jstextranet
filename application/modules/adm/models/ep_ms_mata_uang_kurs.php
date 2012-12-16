<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 *  
 */
class Ep_ms_mata_uang_kurs extends MY_Model {

		
	public $table = "EP_MS_MATA_UANG_KURS";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('MATA_UANG_DARI', 'MATA_UANG_KE','NILAI','TGL_KURS');
    public $columns_conf = array('MATA_UANG_DARI', 'MATA_UANG_KE','NILAI' ,'TGL_KURS');
    public $sql_select = "(select   MATA_UANG_DARI ,  MATA_UANG_KE ,  NILAI, TGL_KURS  from EP_MS_MATA_UANG_KURS)";
    
    /*
      public $columns = array(
      'KODE_VENDOR'=>array('name'=>'KODE VENDOR', 'raw_name'=>'KODE_VENDOR', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      'NAMA_VENDOR'=>array('name'=>'NAMA VENDOR', 'raw_name'=>'NAMA_VENDOR', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      'KODE_LOGIN'=>array('name'=>'KODE LOGIN', 'raw_name'=>'KODE_LOGIN', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      );
     */

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>