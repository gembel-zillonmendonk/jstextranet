<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author farid
 */
class Ep_vendor_dokumen_pendukung extends MY_Model {

    
    public $table = "EP_VENDOR_DOKUMEN_PENDUKUNG";
    
    public $elements_conf = array(
//        'KODE_VENDOR', 
        'KETERANGAN_DOKUMEN', 
        'URL_DOKUMEN',
        'NAMA_FILE'=>array('type'=>'file')
        );
    public $columns_conf = array(
        'KETERANGAN_DOKUMEN'=>array('hidden'=>false, 'width'=>20), 
        'URL_DOKUMEN'=>array('hidden'=>false, 'width'=>10),
        'NAMA_FILE'=>array('hidden'=>false, 'width'=>10), 
        );
    

    function __construct() {
        parent::__construct();
        $this->init();
        
    }

    function _default_scope() {
        parent::_default_scope();
        if(isset($_REQUEST['KODE_VENDOR']))
            return "KODE_VENDOR='".$_REQUEST['KODE_VENDOR']."'";
    }
    public function _before_save() {
        parent::_before_save();
        if(isset($_REQUEST['KODE_VENDOR'])){
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];
        }
    }
}

?>
