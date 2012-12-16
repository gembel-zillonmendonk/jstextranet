<?php

class ep_ktr_invoice_komentar extends MY_Model {

    public $table = 'EP_KTR_INVOICE_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
        'KODE_INVOICE',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_VENDOR',
        'KODE_JABATAN',
        'NAMA_JABATAN',
        'NAMA_KOMENTAR',
        'TGL_KOMENTAR',
        'STATUS_KOMENTAR',
        'TANGGAPAN_KOMENTAR',
        'LAMPIRAN',
        'KOMENTAR',
    );
    public $dir = 'invoice';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>