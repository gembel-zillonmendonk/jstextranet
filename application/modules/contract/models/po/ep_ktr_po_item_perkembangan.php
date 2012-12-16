<?php

class ep_ktr_po_item_perkembangan extends MY_Model {

    public $table = 'EP_KTR_PO_ITEM_PERKEMBANGAN';
    public $elements_conf = array(
//        'KODE_ITEM_PERKEMBANGAN',
//        'KODE_PERKEMBANGAN',
//        'KODE_PO',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
//        'KODE_PO_ITEM',
        'QTY_PERKEMBANGAN',
//        'QTY_DISETUJUI',
    );
    public $columns_conf = array(
        'KODE_ITEM_PERKEMBANGAN',
        'KODE_PERKEMBANGAN',
        'KODE_PO',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_PO_ITEM',
        'QTY_PERKEMBANGAN',
//        'QTY_DISETUJUI',
        'KETERANGAN',
        'KETERANGAN_LENGKAP',
    );
    public $sql_select = "(
            select b.*, a.keterangan, a.keterangan_lengkap
            from ep_ktr_po_item a 
            inner join ep_ktr_po_item_perkembangan b on a.kode_po_item = b.kode_po_item
        )";
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
    }

    function _default_scope() {
        parent::_default_scope();
        
        if(isset($_REQUEST['KODE_PO']) 
            && isset($_REQUEST['KODE_KANTOR']) 
            && isset($_REQUEST['KODE_KONTRAK'])
            && isset($_REQUEST['KODE_PERKEMBANGAN']))
        return " KODE_PO = '".$_REQUEST['KODE_PO']."'
                AND KODE_KANTOR = '".$_REQUEST['KODE_KANTOR']."'
                AND KODE_KONTRAK = '".$_REQUEST['KODE_KONTRAK']."'
                AND KODE_PERKEMBANGAN = '".$_REQUEST['KODE_PERKEMBANGAN']."'";
    }
}

?>