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
class Gl_mata_uang extends MY_Model {

    
    public $table = "GL_MATA_UANG";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('MATA_UANG', 'NOTASI','KETERANGAN');
    public $columns_conf = array('MATA_UANG', 'NOTASI','KETERANGAN');
    public $sql_select = "(select  MATA_UANG ,  NOTASI , KETERANGAN from GL_MATA_UANG)";
    
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
