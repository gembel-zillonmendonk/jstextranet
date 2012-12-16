<?php

class ep_ktr_po_komentar extends MY_Model {

    public $table = 'EP_KTR_PO_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_JABATAN',
        'NAMA_JABATAN',
        'NAMA_KOMENTAR',
        'TGL_KOMENTAR',
        'STATUS_KOMENTAR',
        'TANGGAPAN_KOMENTAR',
        'LAMPIRAN',
        'KOMENTAR',
    );
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>