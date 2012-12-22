<?php

class monitoring extends MY_Model {

    public $table = 'EP_KTR_JANGKA_PERKEMBANGAN';
    public $sql_select = "( 
                select a.*, b.kode_vendor, b.nama_vendor, x.kode_proses, x.nama_aktifitas, x.url, '' as ACT
                from (
                    select a.* ,c.NAMA_AKTIFITAS, b.url, d.KODE_JANGKA, KODE_KONTRAK, KODE_KANTOR, KODE_VENDOR, KODE_TENDER, KODE_PERKEMBANGAN, KODE_INVOICE
                    from EP_WKF_PROSES a
                    inner join (
                        select rtrim(xmlagg(xmlelement(e, '&' || key || '=' || value )).extract('//text()').extract('//text()') ,',') url, kode_proses 
                        from EP_WKF_PROSES_VARS
                        group by KODE_PROSES
                    ) b on a.kode_proses = b.kode_proses
                    inner join EP_WKF_AKTIFITAS c on A.KODE_AKTIFITAS = C.KODE_AKTIFITAS
                    inner join (
                        select a.kode_proses,
                                MAX(CASE WHEN b.key = 'KODE_JANGKA' THEN b.value ELSE NULL END) AS KODE_JANGKA,
                                MAX(CASE WHEN b.key = 'KODE_KONTRAK' THEN b.value ELSE NULL END) AS KODE_KONTRAK,
                                MAX(CASE WHEN b.key = 'KODE_KANTOR' THEN b.value ELSE NULL END) AS KODE_KANTOR,
                                MAX(CASE WHEN b.key = 'KODE_VENDOR' THEN b.value ELSE NULL END) AS KODE_VENDOR,
                                MAX(CASE WHEN b.key = 'KODE_TENDER' THEN b.value ELSE NULL END) AS KODE_TENDER,
                                MAX(CASE WHEN b.key = 'KODE_PERKEMBANGAN' THEN b.value ELSE NULL END) AS KODE_PERKEMBANGAN,
                                MAX(CASE WHEN b.key = 'KODE_INVOICE' THEN b.value ELSE NULL END) AS KODE_INVOICE
                        from ep_wkf_proses a
                        inner join ep_wkf_proses_vars b on a.kode_proses = b.kode_proses
                        group by a.kode_proses
                    ) d on a.kode_proses = d.kode_proses
                    where kode_wkf = 61
                ) x inner join EP_KTR_JANGKA_KONTRAK a 
                    on x.KODE_JANGKA = a.KODE_JANGKA
                    and x.KODE_KONTRAK = a.KODE_KONTRAK
                    and x.KODE_KANTOR = a.KODE_KANTOR
                inner join EP_KTR_KONTRAK b on b.KODE_KONTRAK = a.KODE_KONTRAK
                    and b.KODE_KANTOR = a.KODE_KANTOR
            )";
    public $columns_conf = array(
        'KODE_KONTRAK',
        'KODE_JANGKA',
        'KODE_KANTOR',
        'KODE_VENDOR',
        'NAMA_VENDOR',
        'KETERANGAN',
        'TGL_PERKEMBANGAN',
        'PERSENTASI',
        'STATUS',
        'KODE_PROSES',
        'NAMA_AKTIFITAS',
        'URL',
        'ACT',
    );
    public $dir = 'milestone';

    function __construct() {
        parent::__construct();
        $this->init();

        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'getRowData\', cl);
                    
                    var param = "referer_url=/contract/milestone/monitoring&KODE_KONTRAK=" + data[\'KODE_KONTRAK\'] + 
                                "&KODE_JANGKA=" + data[\'KODE_JANGKA\'] + 
                                "&KODE_KANTOR=" + data[\'KODE_KANTOR\'];
                                
                    var href = $site_url + "/contract/milestone/detail?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">LIHAT DETAIL</span></button>";
                    jQuery(\'#grid_' . strtolower(get_class($this)) . '\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }
    
    function _default_scope()
    {
        parent::_default_scope();
        return ' KODE_VENDOR = ' . $this->session->userdata('kode_vendor');
    }

}

?>