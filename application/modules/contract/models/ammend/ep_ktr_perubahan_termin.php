<?php

class ep_ktr_perubahan_termin extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_TERMIN';
    public $elements_conf = array(
        'KODE_PERUBAHAN',
        'KODE_TERMIN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'TERMIN',
        'KETERANGAN',
        'PERSENTASI',
        'TGL_BAYAR',
    );
    public $dir = 'ammend';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>