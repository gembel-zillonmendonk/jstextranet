<?php

class ep_ktr_termin_komentar extends MY_Model {

    public $table = 'EP_KTR_TERMIN_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
        'KODE_TERMIN',
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
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>