<?php

class ep_ktr_kontrak_komentar extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_KOMENTAR';
    public $elements_conf = array(
        'KODE_KOMENTAR',
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
    public $dir = 'contract';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>