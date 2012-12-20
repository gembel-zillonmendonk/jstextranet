<?php

class ep_ktr_po_todo extends MY_Model {

    public $table = 'EP_KTR_PO';
    
    public $sql_select = null;
    
    public $columns_conf = array(
        'KODE_KONTRAK',
        'KODE_TENDER',
        'KODE_VENDOR',
        'KODE_KANTOR',
        'NAMA_VENDOR',
        'JUDUL_PEKERJAAN',
        'LINGKUP_KERJA',
        'TIPE_KONTRAK',
        'STATUS',
        'NILAI_KONTRAK',
        'KODE_PROSES',
        'NAMA_AKTIFITAS',
        'URL',
        'ACT'        
    );
    public $dir = 'po';
    
    function __construct() {
        parent::__construct();
        $this->init();
        
        $wkf = new Workflow();
        $kode_wkf = 64; //work order
        $pivot_query = $wkf->get_pivot_query("kode_wkf = $kode_wkf and tanggal_selesai is null and kode_aplikasi = 2");
        
        $this->sql_select = "(
            select a.*, x.kode_proses, x.nama_aktifitas, x.url, '' as ACT 
            from EP_KTR_PO a
            inner join (
                $pivot_query
            ) x on x.KODE_PO = a.KODE_PO and x.KODE_KONTRAK = a.KODE_KONTRAK and x.kode_kantor = a.kode_kantor and x.kode_vendor = a.kode_vendor
            where STATUS = 'A'
        )";
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getRowData\', cl);
                    
                    //alert(data[\'KODE_PROSES\']);
                    
                    var param = "referer_url=/contract/todo&kode_proses=" + data[\'KODE_PROSES\'] + data[\'URL\'];
                    var href = $site_url + "/wkf/run?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">PROSES</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

    function _default_scope() {
        parent::_default_scope();
        
        return ' KODE_VENDOR = '.$this->session->userdata('user_id');
        
    }
}

?>