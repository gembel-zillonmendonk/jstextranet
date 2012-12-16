<?php

class ep_ktr_kontrak_penutupan extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_PENUTUPAN';
    public $elements_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KEPUTUSAN_MASALAH',
        'KEPUTUSAN_WAN',
        'ALASAN_PENUTUPAN',
        'PERNYATAAN_MASALAH',
        'PERNYATAAN_WAN',
        'EVAL_TENDER',
        'EVAL_PENYELESAIAN',
        'EVAL_PENGIRIMAN',
        'EVAL_KINERJA',
        'EVAL_PERNYATAAN',
    );
    public $dir = 'contract';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>