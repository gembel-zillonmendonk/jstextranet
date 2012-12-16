<?php

class ep_ktr_jangka_kontrak extends MY_Model
{
    public $table = 'EP_KTR_JANGKA_KONTRAK';
    public $elements_conf = array(
//        'KODE_JANGKA',
//        'KODE_KONTRAK',
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
    );
    public $columns_conf = array(
        'KODE_KONTRAK',
        'KODE_KANTOR',
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

    function __construct()
    {
        parent::__construct();
        $this->init();

        // set default value
        if (isset($_REQUEST['KODE_KANTOR']))
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];

        if (isset($_REQUEST['KODE_KONTRAK']))
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
        
        if (isset($_REQUEST['KODE_JANGKA']))
            $this->attributes['KODE_JANGKA'] = $_REQUEST['KODE_JANGKA'];

//        if (isset($_REQUEST['KODE_JANGKA']) && isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR']))
//        {
//            $this->attributes['KODE_JANGKA'] = $_REQUEST['KODE_JANGKA'];
//            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
//            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
//        }
        
    }

    function _default_scope()
    {
        if (isset($_REQUEST['KODE_KONTRAK'])
                && isset($_REQUEST['KODE_KANTOR']))
            return ' KODE_KONTRAK = \'' . $_REQUEST['KODE_KONTRAK'] .'\''
                    . ' AND KODE_KANTOR = \'' . $_REQUEST['KODE_KANTOR'] .'\'';
    }

    public function _before_insert() {
        parent::_before_insert();
        
        $sql = "SELECT sum(PERSENTASI) as PERSEN FROM " .$this->table. 
                " WHERE KODE_KONTRAK = '" . $this->attributes['KODE_KONTRAK'] .'\''
                    . ' AND KODE_KANTOR = \'' . $this->attributes['KODE_KANTOR'] .'\'';
        
        $query = $this->db->query($sql);
        $row = $query->row_array();
        if($row['PERSEN'] + $this->attributes['PERSENTASI'] > 100)
            show_error("PERSENTASI tidak boleh lebih dari 100");
        
    }
}
?>