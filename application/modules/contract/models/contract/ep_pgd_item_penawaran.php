<?php

class ep_pgd_item_penawaran extends MY_Model {

    public $table = 'EP_PGD_ITEM_PENAWARAN';
    public $elements_conf = array(
        'KODE_TENDER',
        'KODE_KANTOR',
        'KODE_VENDOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'JUMLAH',
        'HARGA',
        'SATUAN',
    );
    
    public $columns_conf = array(
        'KODE_TENDER',
        'KODE_KANTOR',
        'KODE_VENDOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'JUMLAH',
        'HARGA',
        'SATUAN',
    );
    public $dir = 'contract';

    function __construct() {
        parent::__construct();
        $this->init();
        
        // set default value
        if (isset($_REQUEST['KODE_TENDER']) && isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_VENDOR'])) {
            $this->attributes['KODE_TENDER'] = $_REQUEST['KODE_TENDER'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];
        }
    }

}

?>