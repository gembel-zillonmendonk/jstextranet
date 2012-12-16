<?php

class ep_ktr_termin_perubahan extends MY_Model {

    public $table = 'EP_KTR_TERMIN_PERUBAHAN';
    public $elements_conf = array(
        'KODE_PERUBAHAN',
        'KODE_TERMIN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_PERUBAHAN',
        'KODE_TOP',
        'TERMIN',
        'KETERANGAN',
        'PERSENTASI',
        'TGL_BAYAR',
        'TGL_REKAM',
        'PETUGAS_REKAM',
        'TGL_UBAH',
        'PETUGAS_UBAH',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>