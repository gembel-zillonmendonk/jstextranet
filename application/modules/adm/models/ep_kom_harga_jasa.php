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
class Ep_kom_harga_jasa extends MY_Model {

    
  
    public $table = "EP_KOM_HARGA_JASA";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('KODE_HARGA_JASA','KODE_JASA',   'KODE_KANTOR', 'KODE_SUMBER' , 'TGL_SUMBER', 'MATA_UANG', 'HARGA', 'KODE_VENDOR' );
    public $columns_conf = array('KODE_HARGA_JASA','KODE_JASA', 'NAMA_JASA' ,  'KODE_KANTOR', 'NAMA_SUMBER' , 'TGL_SUMBER', 'MATA_UANG', 'HARGA', 'STATUS');
    public $sql_select = "(select   H.KODE_HARGA_JASA , H.KODE_JASA ,  J.NAMA_JASA ,
	H.KODE_KANTOR ,  H.KODE_SUMBER , S.NAMA_SUMBER ,  H.TGL_SUMBER ,  H.MATA_UANG ,  H.HARGA ,  H.KODE_VENDOR ,  H.STATUS  
	from EP_KOM_HARGA_JASA H
	LEFT JOIN 	EP_KOM_JASA J ON H.KODE_JASA = J.KODE_JASA
	LEFT JOIN 	EP_KOM_SUMBER_HARGA S ON H.KODE_SUMBER = S.KODE_SUMBER
	)";
    
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
