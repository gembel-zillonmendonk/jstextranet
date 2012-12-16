<?php

class ep_ktr_termin_perkembangan extends MY_Model {

    public $table = 'EP_KTR_TERMIN_PERKEMBANGAN';
    public $elements_conf = array(
        'KODE_PERKEMBANGAN',
        'KODE_TERMIN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'TGL_PERKEMBANGAN',
        'PERSENTASI',
        'STATUS',
        'KETERANGAN',
    );
    public $dir = 'top';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>