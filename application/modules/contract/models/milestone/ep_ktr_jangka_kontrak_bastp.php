<?php

class ep_ktr_jangka_kontrak_bastp extends MY_Model {

    public $table = 'EP_KTR_JANGKA_KONTRAK';
    public $elements_conf = array(
//        'KODE_JANGKA',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
//        'PERSENTASI',
//        'TGL_TARGET',
//        'PERSENTASI_PERKEMBANGAN',
//        'STATUS_PERKEMBANGAN',
        'NO_BASTP',
        'TGL_BASTP',
        'JUDUL_BASTP',
        'LAMPIRAN_BASTP'=>array('type'=>'file'),
//        'TGL_BUAT_BASTP',
//        'STATUS_BASTP',
//        'POSISI_PERSETUJUAN',
//        'DP_PERSENTASI',
//        'KETERANGAN',
        'KETERANGAN_BASTP',
//        'TGL_REKAM',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
    );
    public $columns_conf = array(
        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'PERSENTASI',
        'TGL_TARGET',
//        'PERSENTASI_PERKEMBANGAN',
//        'STATUS_PERKEMBANGAN',
//        'NO_BASTP',
//        'TGL_BASTP',
//        'JUDUL_BASTP',
//        'LAMPIRAN_BASTP',
//        'TGL_BUAT_BASTP',
//        'STATUS_BASTP',
//        'POSISI_PERSETUJUAN',
//        'DP_PERSENTASI',
        'KETERANGAN',
//        'KETERANGAN_BASTP',
//        'TGL_REKAM',
//        'PETUGAS_REKAM',
//        'TGL_UBAH',
//        'PETUGAS_UBAH',
    );
    public $dir = 'milestone';

    function __construct() {
        parent::__construct();
        $this->init();
        
        if (isset($_REQUEST['KODE_JANGKA']) && isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR'])) {
            $this->attributes['KODE_JANGKA'] = $_REQUEST['KODE_JANGKA'];
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
        }
    }
    
    function _default_scope() {
        if (isset($_REQUEST['KODE_KONTRAK'])
                && isset($_REQUEST['KODE_KANTOR'])
                && isset($_REQUEST['KODE_JANGKA']))
            return ' KODE_KONTRAK = \'' . $_REQUEST['KODE_KONTRAK'] .'\''
                    . ' AND KODE_KANTOR = \'' . $_REQUEST['KODE_KANTOR'] .'\''
                    . ' AND KODE_JANGKA = \'' . $_REQUEST['KODE_JANGKA'] .'\'';
    }

}

?>