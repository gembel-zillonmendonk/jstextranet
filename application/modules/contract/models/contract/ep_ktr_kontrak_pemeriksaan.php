<?php

class ep_ktr_kontrak_pemeriksaan extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_PEMERIKSAAN';
    public $elements_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_PARAM',
        'NAMA_PARAM',
        'HASIL',
    );
    public $dir = 'contract';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>