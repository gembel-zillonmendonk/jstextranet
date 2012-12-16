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
class Ep_kom_komentar_harga_barang extends MY_Model {

    
    public $table = "EP_KOM_KOMENTAR";
    //public $table = "EP_NOMORURUT";
     
    // public $elements_conf = array('KODE_VENDOR', 'NAMA_VENDOR', 'KODE_LOGIN','ALAMAT_EMAIL');
   public $columns_conf = array( 'KODE_KOMENTAR' =>array('hidden'=>true, 'width'=>0)
        , 'KODE_BARANG'  =>array('hidden'=>false, 'width'=>10)
        , 'NAMA_BARANG'  =>array('hidden'=>false, 'width'=>30)
        ,  'KODE_KANTOR'  =>array('hidden'=>false, 'width'=>10)
        , 'NAMA_SUMBER'   =>array('hidden'=>false, 'width'=>10)
        , 'TGL_SUMBER'  =>array('hidden'=>false, 'width'=>10)
        , 'MATA_UANG'  =>array('hidden'=>false, 'width'=>10)
        , 'HARGA'   =>array('hidden'=>false, 'width'=>10)
        , 'PROSES'   =>array('hidden'=>false, 'width'=>10)
   );
   public  $sql_select=  "(select K.KODE_KOMENTAR,  H.KODE_HARGA_BARANG , H.KODE_BARANG ,  J.NAMA_BARANG ,
	H.KODE_KANTOR ,  H.KODE_SUMBER , S.NAMA_SUMBER ,  H.TGL_SUMBER ,  H.MATA_UANG ,  H.HARGA ,  H.KODE_VENDOR ,  H.STATUS  , '' as \"PROSES\"
	from EP_KOM_KOMENTAR K 
	LEFT JOIN EP_KOM_HARGA_BARANG H ON   H.KODE_HARGA_BARANG =   K.KODE_HARGA
	LEFT JOIN 	MS_BARANG J ON H.KODE_BARANG = J.KODE_BARANG AND H.KODE_SUB_BARANG = J.KODE_SUB_BARANG
	LEFT JOIN 	EP_KOM_SUMBER_HARGA S ON H.KODE_SUMBER = S.KODE_SUMBER
	WHERE K.KODE_ALURKERJA = 3 AND K.TGL_BERAKHIR IS NULL ";
 
 
   function setParam() {
		  $this->sql_select = $this->sql_select . " AND K.KODE_JABATAN = '" . $this->session->userdata("kode_jabatan") . "' )" ;
   }
 
  
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
		$this->setParam();
		$this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    be = "<button onclick=\"fnProsesHargaBarang(\'"+cl+"\');\"  >PROSES</button>"; 
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{PROSES:be});
		}
		
 
		
		';
    }

}

?>
