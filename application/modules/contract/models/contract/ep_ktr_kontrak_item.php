<?php

class ep_ktr_kontrak_item extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_ITEM';
    public $elements_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
        'MIN_QTY',
        'MAX_QTY',
        'SATUAN',
        'SUB_TOTAL',
        'KETERANGAN_LENGKAP',
    );
    public $columns_conf = array(
        'KODE_ITEM_KONTRAK',
        'TIT_ID',
        'KODE_KONTRAK',
        'KODE_ITEM',
        'KETERANGAN',
        'HARGA',
        'JUMLAH',
//        'MIN_QTY',
//        'MAX_QTY',
        'SATUAN',
//        'SUB_TOTAL',
//        'KETERANGAN_LENGKAP',
//        'TGL_REKAM',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
    );
    public $dir = 'contract';

    function __construct() {
        parent::__construct();
        $this->init();

        // set default value
        if (isset($_REQUEST['KODE_KANTOR']))
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];

        if (isset($_REQUEST['KODE_KONTRAK']))
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
//        if (isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_KONTRAK'])) {
//            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
//            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
//
//        }
    }

}

?>