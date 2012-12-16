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
class Ep_kom_sumber_harga extends MY_Model {

    
    public $table = "EP_KOM_SUMBER_HARGA";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('KODE_SUMBER', 'NAMA_SUMBER');
    public $columns_conf = array('KODE_SUMBER', 'NAMA_SUMBER');
    public $sql_select = "(select   KODE_SUMBER ,  NAMA_SUMBER    from EP_KOM_SUMBER_HARGA )";
    
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