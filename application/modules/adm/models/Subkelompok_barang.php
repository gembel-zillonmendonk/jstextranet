<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author FM
 */
class Subkelompok_barang extends MY_Model {

    
    public $table = "MS_SUBKELOMPOK_BARANG";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('KODE_SUBKELOMPOK', 'NAMA_SUBKELOMPOK' );
    public $columns_conf = array('KODE_SUBKELOMPOK', 'NAMA_SUBKELOMPOK');
    public $sql_select = "(select KODE_SUBKELOMPOK, NAMA_SUBKELOMPOK from MS_SUBKELOMPOK_BARANG)";
    
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
