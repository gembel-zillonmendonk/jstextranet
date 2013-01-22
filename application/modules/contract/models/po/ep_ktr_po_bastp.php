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
//        'NO_BASTP',
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
    
    function _before_update() {
        parent::_before_update();
        
        // set sequence number NO_BASTP
        $no_urut = 1;
        try {
            $sql = "select max(to_number(substr(NO_BASTP, -7, 10))) + 1 as next_id from EP_KTR_PO";
            $row = $this->db->query($sql)->row_array();
        } catch( Exception $e) { }

        $this->attributes['NO_BASTP'] = sprintf('%1$s/%2$s/%3$07d', 'BASTP', 'WO', count($row) > 0 ? $row['NEXT_ID'] : $no_urut);
        
    }

}

?>