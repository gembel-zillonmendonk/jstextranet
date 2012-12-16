<?php

class ep_ktr_invoice_dok extends MY_Model {

    public $table = 'EP_KTR_INVOICE_DOK';
    public $elements_conf = array(
        'KODE_DOKUMEN',
        'KODE_INVOICE',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_VENDOR',
        'KATEGORI',
        'KETERANGAN',
        'NAMA_FILE',
        'STATUS',
    );
    public $dir = 'invoice';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>