<?php

class ep_ktr_po_bastp extends MY_Model {

    public $table = 'EP_KTR_PO';
    public $elements_conf = array(
//        'KODE_PO',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
        'KODE_VENDOR' => array('type'=>'hidden'),
//        'NAMA_PEMBUAT',
//        'NAMA_LENGKAP_PEMBUAT',
//        'POSISI_PEMBUAT',        
//        'NAMA_VENDOR',
//        'MATA_UANG',
//        'TGL_MULAI',
//        'TGL_AKHIR',
//        'TGL_BUAT',
//        'CATATAN_PO',
//        'TGL_PERSETUJUAN',
//        'STATUS',
//        'POSISI_PERSETUJUAN',
//        'PERSENTASI_PERKEMBANGAN',
//        'STATUS_PERKEMBANGAN',
        'NO_BASTP',
        'TGL_BASTP',
        'JUDUL_BASTP',
//        'TGL_BUAT_BASTP',
//        'STATUS_BASTP',
//        'TGL_PERSETUJUAN_BASTP',
        'KETERANGAN_BASTP',
        'LAMPIRAN_BASTP'=>array('type'=>'file'),
    );
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>