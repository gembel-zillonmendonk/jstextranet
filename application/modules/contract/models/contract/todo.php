<?php

class todo extends MY_Model
{
    public $table = 'EP_KTR_KONTRAK';
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
        'STATUS',
        'NILAI_KONTRAK',
        'ACT',
    );
    public $sql_select = "( 
        SELECT a.KODE_TENDER,
           a.KODE_KANTOR,
           a.NAMA_PEMOHON,
           a.KODE_JAB_PEMOHON,
           a.JUDUL_PEKERJAAN,
           a.LINGKUP_PEKERJAAN,
           a.TIPE_KONTRAK,
           c.KODE_VENDOR,
           c.NAMA_VENDOR,
           '' as ACT
       FROM EP_PGD_TENDER a
           INNER JOIN EP_PGD_TENDER_VENDOR_STATUS b
              ON a.KODE_TENDER = b.KODE_TENDER
           INNER JOIN EP_VENDOR c
              ON b.KODE_VENDOR = c.KODE_VENDOR
           INNER JOIN (  SELECT KODE_VENDOR,
                                KODE_TENDER,
                                SUM (HARGA * JUMLAH) AS TOTAL_HARGA
                           FROM EP_PGD_ITEM_PENAWARAN
                       GROUP BY KODE_VENDOR, KODE_TENDER) x
              ON b.KODE_VENDOR = x.KODE_VENDOR AND x.KODE_TENDER = b.KODE_TENDER
           LEFT OUTER JOIN EP_KTR_KONTRAK d
              ON a.KODE_TENDER = d.KODE_TENDER
       WHERE     COALESCE (b.pemenang, '0') = '1'
           AND COALESCE (a.pembuatan_kontrak, '0') = '0'
           AND d.KODE_TENDER IS NULL
    )";
    public $dir = 'contract';

    function __construct()
    {
        parent::__construct();
        $this->init();
        
        $this->js_grid_completed = '
                var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    var data = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getRowData\', cl);
                    
                    //alert(data[\'KODE_KANTOR\']);
                    
                    var param = "referer_url=/contract/todo&KODE_TENDER=" + data[\'KODE_TENDER\'] 
                    + "&KODE_KANTOR=" + data[\'KODE_KANTOR\']
                    + "&KODE_VENDOR=" + data[\'KODE_VENDOR\'];

                    var href = $site_url + "/contract/create_draft?" + param;
                    var href = $site_url + "/wkf/start?kode_wkf=6&" + param;
                    
                    be = "<button onclick=\"javascript:window.location=\'" +href+ "\'\" type=\"button\" id=\"btnProses\" class=\"ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only\" role=\"button\" aria-disabled=\"false\"><span class=\"ui-button-text\">PROSES</span></button>";
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{ACT:be});
		}';
    }

}
?>