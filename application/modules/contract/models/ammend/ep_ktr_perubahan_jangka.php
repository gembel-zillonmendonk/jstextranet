<?php

class ep_ktr_perubahan_jangka extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN_JANGKA';
    public $elements_conf = array(
        'KODE_PERUBAHAN',
        'KODE_JANGKA',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'PERSENTASI',
        'TGL_TARGET',
        'KETERANGAN',
    );
    
    public $columns_conf = array(
        'KODE_PERUBAHAN',
        'KODE_JANGKA',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'PERSENTASI',
        'TGL_TARGET',
        'KETERANGAN',
    );
    public $dir = 'ammend';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>