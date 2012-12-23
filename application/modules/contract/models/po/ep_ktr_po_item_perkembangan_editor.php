<?php

class ep_ktr_po_item_perkembangan_editor extends MY_Model {

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
        'KODE_BARANG_JASA',
        'KODE_SUB_BARANG_JASA',
        'KETERANGAN',
        'SATUAN',
        'QTY',
                'KODE_ITEM_PERKEMBANGAN',
        //        'KODE_PERKEMBANGAN',
        //        'KODE_PO',
        //        'KODE_KONTRAK',
        //        'KODE_KANTOR',
                'KODE_PO_ITEM',
        'QTY_TERKIRIM',
        'QTY_PERKEMBANGAN',
        //        'QTY_DISETUJUI',
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

        $this->sql_select = "(
            select a.kode_po,a.kode_po_item,a.kode_kontrak,a.kode_kantor,a.kode_barang_jasa, a.kode_sub_barang_jasa, a.keterangan, a.keterangan_lengkap, a.qty, a.satuan
                , b.kode_item_perkembangan
                , b.qty_perkembangan as qty_terkirim
                , 0 as qty_perkembangan
            from ep_ktr_po_item a 
            left join ep_ktr_po_item_perkembangan b on a.kode_po_item = b.kode_po_item
            where a.KODE_PO = '" . $_REQUEST['KODE_PO'] . "'
        )";
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    var param = "KODE_ITEM_PERKEMBANGAN=" +data[\'KODE_ITEM_PERKEMBANGAN\']+ "&KODE_PO_ITEM="+data[\'KODE_PO_ITEM\']+"&KODE_PO=" + data[\'KODE_PO\'] + "&KODE_KONTRAK=" + data[\'KODE_KONTRAK\'] + "&KODE_KANTOR=" + data[\'KODE_KANTOR\'];
                    qty = "<input type=\"hidden\" value=\"" +param+ "\" name=\"selected_items[]\" />";
                    qty += "<input type=\"number\" value=\"" +data[\'QTY_PERKEMBANGAN\']+ "\" name=\"selected_qty[]\" />";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{QTY_PERKEMBANGAN:qty});
		}
        ';
    }

//    function _default_scope() {
//        parent::_default_scope();
//        
//        if(isset($_REQUEST['KODE_PO']) 
//            && isset($_REQUEST['KODE_KANTOR']) 
//            && isset($_REQUEST['KODE_KONTRAK'])
//            && isset($_REQUEST['KODE_PERKEMBANGAN']))
//        return " KODE_PO = '".$_REQUEST['KODE_PO']."'
//                AND KODE_KANTOR = '".$_REQUEST['KODE_KANTOR']."'
//                AND KODE_KONTRAK = '".$_REQUEST['KODE_KONTRAK']."'
//                AND KODE_PERKEMBANGAN = '".$_REQUEST['KODE_PERKEMBANGAN']."'";
//    }
}

?>