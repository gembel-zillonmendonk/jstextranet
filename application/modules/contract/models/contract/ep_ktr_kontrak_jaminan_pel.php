<?php

class ep_ktr_kontrak_jaminan_pel extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_JAMINAN_PEL';
    public $elements_conf = array(
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
    public $dir = 'contract';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>