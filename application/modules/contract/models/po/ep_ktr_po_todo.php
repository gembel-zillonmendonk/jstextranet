<?php

class ep_ktr_po_todo extends MY_Model {

    public $table = 'EP_KTR_PO';
    
    public $sql_select = "( select b.*, x.nama_aktifitas, x.url, x.kode_proses, '' as ACT from (
                                    select a.* ,c.NAMA_AKTIFITAS, b.url, d.KODE_PO, KODE_KONTRAK, KODE_KANTOR, KODE_VENDOR
                                    from EP_WKF_PROSES a
                                    inner join (
                                        select rtrim(xmlagg(xmlelement(e, '&' || key || '=' || value )).extract('//text()').extract('//text()') ,',') url, kode_proses 
                                        from EP_WKF_PROSES_VARS
                                        group by KODE_PROSES
                                    ) b on a.kode_proses = b.kode_proses
                                    inner join EP_WKF_AKTIFITAS c on A.KODE_AKTIFITAS = C.KODE_AKTIFITAS
                                    inner join (
                                        select a.kode_proses,
                                                MAX(CASE WHEN b.key = 'KODE_PO' THEN b.value ELSE NULL END) AS KODE_PO,
                                                MAX(CASE WHEN b.key = 'KODE_KONTRAK' THEN b.value ELSE NULL END) AS KODE_KONTRAK,
                                                MAX(CASE WHEN b.key = 'KODE_KANTOR' THEN b.value ELSE NULL END) AS KODE_KANTOR,
                                                MAX(CASE WHEN b.key = 'KODE_VENDOR' THEN b.value ELSE NULL END) AS KODE_VENDOR
                                        from ep_wkf_proses a
                                        inner join ep_wkf_proses_vars b on a.kode_proses = b.kode_proses
                                        group by a.kode_proses
                                    ) d on a.kode_proses = d.kode_proses
                                    where kode_wkf = 64 and tanggal_selesai is null and kode_aplikasi = 2
                                ) x inner join EP_KTR_PO b on x.KODE_KONTRAK = b.KODE_KONTRAK and x.KODE_PO = b.KODE_PO and x.KODE_KANTOR = b.KODE_KANTOR and x.KODE_VENDOR = b.KODE_VENDOR
                                where STATUS = 'O')";
    
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