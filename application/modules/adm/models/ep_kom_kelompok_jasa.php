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
class Ep_kom_kelompok_jasa extends MY_Model {

    
  
    public $table = "EP_KOM_KELOMPOK_JASA";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('KODE_KEL_JASA', 'NAMA_KEL_JASA' ,    'TGL_REKAM'  );
    public $columns_conf = array('KODE_KEL_JASA', 'NAMA_KEL_JASA', 'TGL_REKAM');
    public $sql_select = "(select KODE_KEL_JASA ,  NAMA_KEL_JASA  , TGL_REKAM  from EP_KOM_KELOMPOK_JASA)";
    
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
