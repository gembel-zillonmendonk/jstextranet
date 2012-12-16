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
class Ms_kantor extends MY_Model {

    
    public $table = "MS_KANTOR";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('KODE_KANTOR', 'NAMA_KANTOR','ALAMAT');
    public $columns_conf = array('KODE_KANTOR' =>array('hidden'=>false, 'width'=>10) 
								, 'NAMA_KANTOR' =>array('hidden'=>false, 'width'=>30)
								,'ALAMAT' =>array('hidden'=>false, 'width'=>60));
    public $sql_select = "(select   KODE_KANTOR ,  NAMA_KANTOR , ALAMAT , (1) as \"ad\" from MS_KANTOR )";
    
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
