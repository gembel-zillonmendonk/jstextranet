<?php

class ep_ktr_jangka_todo_approval extends MY_Model {

    public $table = 'EP_KTR_JANGKA_KONTRAK';
    
    public $sql_select = "( select a.no_kontrak, a.kode_vendor, a.nama_vendor
        , a.judul_pekerjaan, a.lingkup_kerja, x.kode_proses, x.url, x.nama_aktifitas
        , y.*, '' as \"ACT\" from (
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
                                where kode_wkf = 61 and tanggal_selesai is null and kode_aplikasi = 2
                            ) x
                            inner join EP_KTR_JANGKA_KONTRAK y on 
                                y.KODE_JANGKA = x.KODE_JANGKA
                                and y.KODE_KONTRAK = x.KODE_KONTRAK
                                and y.KODE_KANTOR = x.KODE_KANTOR
                            inner join (
                                select sum(persentasi) as persentasi, kode_jangka, kode_kontrak, kode_kantor 
                                from EP_KTR_JANGKA_PERKEMBANGAN
                                group by kode_jangka, kode_kantor , kode_kontrak
                            ) z on z.KODE_KONTRAK = y.KODE_KONTRAK and z.kode_jangka = y.kode_jangka and z.kode_kantor = y.kode_kantor
                            inner join EP_KTR_KONTRAK a on y.KODE_KONTRAK = a.KODE_KONTRAK and a.KODE_KANTOR = y.KODE_KANTOR
                          )";
    
    public $columns_conf = array(
        'KODE_PROSES',
        'NAMA_AKTIFITAS',
        'KODE_VENDOR',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'NAMA_VENDOR',
        'JUDUL_PEKERJAAN',
        'LINGKUP_KERJA',
        'URL',
        'ACT',
    );
    public $dir = 'milestone';
    
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

}

?>