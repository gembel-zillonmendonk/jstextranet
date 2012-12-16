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
class Bg_ms_anggaran extends MY_Model {

    
  
    public $table = "BG_MS_ANGGARAN";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('TAHUN','KODE_KANTOR', 'AKUN', 'NAMA_AKUN', 'NILAI_AKHIR' );
    public $columns_conf = array('TAHUN'  =>array('hidden'=>false, 'width'=>10)
        ,'KODE_KANTOR'  =>array('hidden'=>false, 'width'=>10)
        , 'KELOMPOK_MA'  =>array('hidden'=>true, 'width'=>0)
        , 'KODE_MA'  =>array('hidden'=>true, 'width'=>0)
        , 'AKUN'  =>array('hidden'=>false, 'width'=>20)
        , 'NAMA_AKUN'  =>array('hidden'=>false, 'width'=>40)
        , 'NILAI_AKHIR'  =>array('hidden'=>false, 'width'=>20)
        , 'NILAI_AWAL'  =>array('hidden'=>true, 'width'=>0)
        );
    public $sql_select = "(select    TAHUN ,          	  
                              KODE_KANTOR ,
                              KELOMPOK_MA ,
                              KODE_MA       ,
                              AKUN ,
                              NAMA_AKUN , 
                              NILAI_AKHIR,
                              NILAI_AWAL,
                              TIPE_AKUN
            from BG_MS_ANGGARAN  
            WHERE  TIPE_AKUN = 'D'
             ";
    
    /*
      public $columns = array(
      'KODE_VENDOR'=>array('name'=>'KODE VENDOR', 'raw_name'=>'KODE_VENDOR', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      'NAMA_VENDOR'=>array('name'=>'NAMA VENDOR', 'raw_name'=>'NAMA_VENDOR', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      'KODE_LOGIN'=>array('name'=>'KODE LOGIN', 'raw_name'=>'KODE_LOGIN', 'type' => 'text', 'size' => 255, 'allow_null' => false),
      );
     */

    
    
    function setParam() {
		  $this->sql_select = $this->sql_select . " AND  KODE_KANTOR = '" . $this->session->userdata('kode_kantor') . "' )" ;
   }
    
    function __construct() {
        parent::__construct();
        $this->init();
        $this->setParam();
        
    }

    /*
        function _default_scope()
    {
        $CI = & get_instance();
        $rtn = " KODE_KANTOR = '" . $CI->session->userdata('kode_kantor') . "' ";
        $rtn .= " AND TIPE_AKUN = 'D' ";
        return $rtn;
    }
     * 
     */
}

?>
