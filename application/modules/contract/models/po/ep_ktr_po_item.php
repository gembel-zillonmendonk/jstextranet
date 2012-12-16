<?php

class ep_ktr_po_item extends MY_Model {

    public $table = 'EP_KTR_PO_ITEM';
    public $elements_conf = array(
//        'KODE_PO_ITEM',
//        'KODE_PO',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
//        'KODE_BARANG_JASA',
//        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'QTY',
        'SATUAN',
        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
    );
    
    public $columns_conf = array(
//        'KODE_PO_ITEM',
//        'KODE_PO',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
//        'KODE_BARANG_JASA',
//        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'QTY',
        'SATUAN',
        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
    );
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
    }
    
    function _default_scope() {
        parent::_default_scope();
        
        if(isset($_REQUEST['KODE_PO']) 
            && isset($_REQUEST['KODE_KANTOR']) 
            && isset($_REQUEST['KODE_KONTRAK']))
        return " KODE_PO = '".$_REQUEST['KODE_PO']."'
                AND KODE_KANTOR = '".$_REQUEST['KODE_KANTOR']."'
                AND KODE_KONTRAK = '".$_REQUEST['KODE_KONTRAK']."'";
    }

}

?>