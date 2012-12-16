<?php

class vw_ep_vendor_undelisting extends MY_Model {

    public $table = 'EP_VENDOR';
    public $dir = 'vendor';
    public $sql_select = "( select x.*, y.*, '' as \"ACT\" from (
                                select a.* ,c.NAMA_AKTIFITAS, b.url, d.value as KODE_VENDOR_VALUE from EP_WKF_PROSES a
                                inner join (
                                    select rtrim(xmlagg(xmlelement(e, '&' || key || '=' || value )).extract('//text()').extract('//text()') ,',') url, kode_proses 
                                    from EP_WKF_PROSES_VARS
                                    group by KODE_PROSES
                                ) b on a.kode_proses = b.kode_proses
                                inner join EP_WKF_AKTIFITAS c on A.KODE_AKTIFITAS = C.KODE_AKTIFITAS
                                inner join EP_WKF_PROSES_VARS d on a.kode_proses = d.kode_proses and d.key = 'KODE_VENDOR'
                                where kode_wkf = 57 and tanggal_selesai is null
                            ) x
                            inner join EP_VENDOR y on y.KODE_VENDOR = x.KODE_VENDOR_VALUE )";
    public $columns_conf = array(
        'KODE_PROSES',
        'NAMA_AKTIFITAS',
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'URL',
        'ACT',
    );
    function __construct() {
        parent::__construct();
        $this->init();
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getRowData\', cl);
                    
                    var param = "referer_url=/vendor/todo&kode_proses=" + data[\'KODE_PROSES\'] + data[\'URL\'];
                    var href = $site_url + "/wkf/run?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">PROSES</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}

?>