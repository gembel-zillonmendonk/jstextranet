<?php

class ep_ktr_perubahan_jaminan_pel extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_JAMINAN_PEL';
    public $elements_conf = array(
        'KODE_PERUBAHAN',
        'KODE_JAMINAN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'NOMOR',
        'DIBUAT_OLEH',
        'TGL_BUAT',
        'TGL_KADALUARSA',
        'MATA_UANG',
        'NILAI',
        'LAMPIRAN',
    );
    public $dir = 'ammend';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>