<?php

class ep_ktr_jangka_komentar extends MY_Model {

    public $table = 'EP_KTR_JANGKA_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
        'KODE_JANGKA',
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
    public $dir = 'milestone';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>