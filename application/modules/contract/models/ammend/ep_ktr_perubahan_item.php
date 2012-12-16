<?php

class ep_ktr_perubahan_item extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_ITEM';
    public $elements_conf = array(
        'KODE_PERUBAHAN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
//        'MIN_QTY',
//        'MAX_QTY',
//        'SATUAN',
//        'SUB_TOTAL',
//        'KETERANGAN_LENGKAP',
    );
    public $columns_conf = array(
        'KODE_PERUBAHAN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
//        'MIN_QTY',
//        'MAX_QTY',
//        'SATUAN',
//        'SUB_TOTAL',
//        'KETERANGAN_LENGKAP',
    );
    public $dir = 'ammend';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>