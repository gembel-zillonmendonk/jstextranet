<?php

class monitoring extends MY_Model {

    public $table = 'EP_KTR_KONTRAK';
    
    public $sql_select = "( select x.*, y.*, '' as \"ACT\" from (
                                select a.* ,c.NAMA_AKTIFITAS, b.url, d.value as KODE_KONTRAK_VALUE from EP_WKF_PROSES a
                                inner join (
                                    select rtrim(xmlagg(xmlelement(e, '&' || key || '=' || value )).extract('//text()').extract('//text()') ,',') url, kode_proses 
                                    from EP_WKF_PROSES_VARS
                                    group by KODE_PROSES
                                ) b on a.kode_proses = b.kode_proses
                                inner join EP_WKF_AKTIFITAS c on A.KODE_AKTIFITAS = C.KODE_AKTIFITAS
                                inner join EP_WKF_PROSES_VARS d on a.kode_proses = d.kode_proses and d.key = 'KODE_KONTRAK'
                                where kode_wkf = 6 and tanggal_selesai is not null
                            ) x
                            inner join EP_KTR_KONTRAK y on y.KODE_KONTRAK = x.KODE_KONTRAK_VALUE )";
    
    public $columns_conf = array(
        'KODE_KONTRAK',
        'KODE_TENDER',
        'KODE_VENDOR',
        'KODE_KANTOR',
        'NAMA_VENDOR',
        'JUDUL_PEKERJAAN',
        'LINGKUP_KERJA',
        'TIPE_KONTRAK',
        'JENIS_KONTRAK',
        'TGL_MULAI',
        'TGL_AKHIR',
        'NILAI_KONTRAK',
        'URL',
        'STATUS',
        'ACT',
    );
    public $dir = 'contract';
    
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
                    var href = $site_url + "/contract/detail?" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">LIHAT DETAIL</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

    function _default_scope()
    {
        parent::_default_scope();
        $condition = array(
            'eq' => '=',
            'gt' => '>=',
            'lt' => '<=',
            'ne' => '<>',
        );
        
        $where = ' KODE_VENDOR = ' . $this->session->userdata('kode_vendor');
        if (isset($_REQUEST['EXPIRED_CONDITION']) && isset($_REQUEST['EXPIRED_VALUE']) && strlen($_REQUEST['EXPIRED_VALUE']) > 0) {
            $where .= " AND to_char(TGL_AKHIR, 'YYYYMM') " . $condition[$_REQUEST['EXPIRED_CONDITION']] . " to_char(add_months(SYSDATE, " . $_REQUEST['EXPIRED_VALUE'] . "), 'YYYYMM') ";
        }

        return $where;
    }
}

?>