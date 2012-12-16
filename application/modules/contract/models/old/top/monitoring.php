<?php

class monitoring extends MY_Model {

    public $table = 'EP_KTR_TERMIN_KONTRAK';
    
    public $sql_select = "( select * from EP_KTR_TERMIN_KONTRAK )";
    
    public $columns_conf = array(
        'KODE_TERMIN',
        'KODE_KONTRAK',
        'KODE_VENDOR',
        'KODE_KANTOR',
        'NAMA_VENDOR',
        'KETERANGAN',
        'PERSENTASI_PERKEMBANGAN',
        'STATUS_PERKEMBANGAN',
    );
    public $dir = 'top';
    
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