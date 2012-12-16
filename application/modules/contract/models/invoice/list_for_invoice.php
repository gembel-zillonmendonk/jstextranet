<?php

class list_for_invoice extends MY_Model {

    public $table = 'EP_KTR_INVOICE';
    public $columns_conf = array(
        'KODE_KANTOR',
        'KODE_VENDOR',
        'KODE_KONTRAK',
        'NO_KONTRAK',
        'NAMA_VENDOR',
        'JUM_BASTP',
        'ACT',
    );
    public $sql_select = null;
    public $dir = 'invoice';

    function __construct() {
        parent::__construct();
        $this->init();
        
        $kode_wkf = 62;
        
        $this->sql_select = "(
            select a.kode_kontrak, a.no_kontrak, a.kode_vendor, a.kode_kantor, b.nama_vendor, count(a.no_bastp) as jum_bastp, '' as act
            from (
                select b.kode_kontrak, b.no_kontrak, b.kode_vendor, b.kode_kantor, a.no_bastp
                from ep_ktr_jangka_kontrak a
                inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor
                where a.status_bastp = 'A' and a.no_bastp not in (select no_bastp from ep_ktr_invoice_item)
                union all
                select b.kode_kontrak, b.no_kontrak, b.kode_vendor, b.kode_kantor, a.no_bastp
                from ep_ktr_termin_kontrak a
                inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor
                where a.status_bastp = 'A' and a.no_bastp not in (select no_bastp from ep_ktr_invoice_item)
                union all
                select b.kode_kontrak, b.no_kontrak, b.kode_vendor, b.kode_kantor, a.no_bastp
                from ep_ktr_po a
                inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor and a.kode_vendor = b.kode_vendor
                where a.status_bastp = 'A' and a.no_bastp not in (select no_bastp from ep_ktr_invoice_item)
            ) a inner join ep_vendor b on a.kode_vendor = b.kode_vendor
            where b.kode_vendor = '".$this->session->userdata('user_id')."'
            group by a.kode_kontrak, a.no_kontrak, a.kode_vendor, a.kode_kantor, b.nama_vendor
        )";
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    
                    var param = "kode_wkf='.$kode_wkf.'&referer_url=/contract/invoice/monitoring&KODE_VENDOR=" + data[\'KODE_VENDOR\'] + "&KODE_KONTRAK=" + data[\'KODE_KONTRAK\'] + "&KODE_KANTOR=" + data[\'KODE_KANTOR\'];
                    var href = $site_url + "/wkf/start?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">PROSES</span></button>";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
        
    }

}

?>