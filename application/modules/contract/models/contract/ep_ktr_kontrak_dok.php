<?php

class ep_ktr_kontrak_dok extends MY_Model {

    public $table = 'EP_KTR_KONTRAK_DOK';
    public $elements_conf = array(
        'KODE_DOKUMEN',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_KATEGORI',
        'KETERANGAN',
        'NAMA_FILE',
        'STATUS',
        'STATUS_PUBLISH',
    );
    public $dir = 'contract';

    function __construct() {
        parent::__construct();
        $this->init();
        
        if (isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR']))
        {
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
        }
    }

    function _default_scope()
    {
        if (isset($_REQUEST['KODE_KONTRAK'])
                && isset($_REQUEST['KODE_KANTOR']))
            return ' KODE_KONTRAK = \'' . $_REQUEST['KODE_KONTRAK'] .'\''
                    . ' AND KODE_KANTOR = \'' . $_REQUEST['KODE_KANTOR'] .'\'';
    }
    
}

?>