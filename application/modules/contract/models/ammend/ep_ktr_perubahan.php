<?php

class ep_ktr_perubahan extends MY_Model {

    public $table = 'EP_KTR_PERUBAHAN';
    public $elements_conf = array(
//        'KODE_PERUBAHAN',
        'KODE_KONTRAK' => array('type' => 'dropdown', 'options' => array()),
        'KODE_KANTOR' => array('readonly' => true),
        'TGL_TTD',
        'TGL_MULAI' => array('readonly' => true, 'type' => 'text'),
        'TGL_AKHIR' => array('readonly' => true, 'type' => 'text'),
//        'MATA_UANG' => array('readonly' => true),
//        'NILAI_KONTRAK' => array('readonly' => true),
//        'STATUS' => array('readonly' => true),
//        'POSISI_PERSETUJUAN' => array('readonly' => true),
//        'TGL_PERUBAHAN' => array('readonly' => true),
        'TIPE_KONTRAK' => array('readonly' => true),
        'JENIS_KONTRAK' => array('readonly' => true),
//        'NO_KONTRAK' => array('readonly' => true),
//        'PERIODE_BAYAR_SEWA' => array('readonly' => true),
//        'UNIT_BAYAR_SEWA' => array('readonly' => true),
//        'TERMIN_BAYAR_SEWA' => array('readonly' => true),
        'KET_PERUBAHAN' => array('type' => 'textarea'),
        'ALASAN_PERUBAHAN' => array('type' => 'textarea'),
        'LAMPIRAN' => array('type' => 'file'),
    );
    public $validation = array(
        'KET_PERUBAHAN' => array('required' => true),
        'ALASAN_PERUBAHAN' => array('required' => true),
        'LAMPIRAN' => array('required' => false),
    );
    public $dir = 'ammend';

    function __construct() {
        parent::__construct();
        $this->init();

        $rows = $this->db->query("select kode_kontrak, no_kontrak from EP_KTR_KONTRAK where status = 'O' and kode_vendor = " . $this->session->userdata('kode_vendor'))->result_array();
        $options = array('' => '');
        foreach ($rows as $k => $v) {
            $options[$v['KODE_KONTRAK']] = $v['NO_KONTRAK'];
        }

        $this->elements_conf['KODE_KONTRAK']['options'] = $options;

        if (isset($_REQUEST['KODE_KONTRAK'])) {

            $this->elements_conf['KODE_KONTRAK']['value'] = $_REQUEST['KODE_KONTRAK'];

            $row = $this->db->query("select a.*, b.TGL_TTD
                from EP_KTR_PERUBAHAN a
                inner join EP_KTR_KONTRAK b on a.KODE_KONTRAK = b.KODE_KONTRAK
                where a.KODE_KONTRAK = " . $_REQUEST['KODE_KONTRAK'])->row_array();

            if (!count($row)) {
                // get default selected
                $row = $this->db->query("select * from EP_KTR_KONTRAK where KODE_KONTRAK = " . $_REQUEST['KODE_KONTRAK'])->row_array();
            } else {
                $this->attributes['KODE_PERUBAHAN'] = $row['KODE_PERUBAHAN'];
                $this->elements_conf['KODE_KONTRAK'] = array('type' => 'text', 'readonly' => true);
            }

            $this->attributes['KODE_KONTRAK'] = $row['KODE_KONTRAK'];
            $this->attributes['KODE_KANTOR'] = $row['KODE_KANTOR'];
            $this->attributes['TIPE_KONTRAK'] = $row['TIPE_KONTRAK'];
            $this->attributes['TGL_MULAI'] = $row['TGL_MULAI'];
            $this->attributes['TGL_AKHIR'] = $row['TGL_AKHIR'];
            $this->attributes['JENIS_KONTRAK'] = $row['JENIS_KONTRAK'];
            $this->attributes['NO_KONTRAK'] = $row['NO_KONTRAK'];
            $this->attributes['MATA_UANG'] = $row['MATA_UANG'];
            $this->attributes['NILAI_KONTRAK'] = $row['NILAI_KONTRAK'];
            $this->attributes['TGL_TTD'] = substr(isset($row['TGL_TTD']) ? $row['TGL_TTD'] : '', 0, 10);
            
            $this->attributes['NILAI_KONTRAK_SEBELUM'] = $row['NILAI_KONTRAK'];
            $this->attributes['TGL_MULAI_SEBELUM'] = $row['TGL_MULAI'];
            $this->attributes['TGL_AKHIR_SEBELUM'] = $row['TGL_AKHIR'];
        }
    }

    function _before_insert() {
        parent::_before_insert();
        // set auto increament
        if ($this->attributes['KODE_PERUBAHAN'] == 0) {
            $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                from ep_nomorurut 
                where kode_nomorurut = 'EP_KTR_PERUBAHAN'")->row_array();
            $this->attributes['KODE_PERUBAHAN'] = $row['NEXT_ID'];
        }
    }

    public function _after_insert() {
        parent::_after_insert();

        if (isset($this->attributes['KODE_PERUBAHAN']) != "" &&
                isset($this->attributes['KODE_KANTOR']) != "" &&
                isset($this->attributes['KODE_KONTRAK']) != "") {

            $sql = "INSERT INTO EP_KTR_PERUBAHAN_ITEM  (KODE_PERUBAHAN, KODE_KONTRAK, KODE_KANTOR, KODE_BARANG_JASA, KODE_SUB_BARANG_JASA, KETERANGAN, HARGA, JUMLAH)
                    SELECT " . $this->attributes['KODE_PERUBAHAN'] . " as \"KODE_PERUBAHAN\", KODE_KONTRAK, KODE_KANTOR, KODE_BARANG_JASA, KODE_SUB_BARANG_JASA, KETERANGAN, HARGA, JUMLAH  
                    FROM EP_KTR_KONTRAK_ITEM
                    WHERE 
                        KODE_KONTRAK = '" . $this->attributes['KODE_KONTRAK'] . "'
                        AND KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'";

            $query = $this->db->query($sql);

            $sql = "INSERT INTO EP_KTR_PERUBAHAN_JANGKA (KODE_PERUBAHAN, KODE_JANGKA, KODE_KONTRAK, KODE_KANTOR, PERSENTASI, TGL_TARGET, KETERANGAN)
                    SELECT " . $this->attributes['KODE_PERUBAHAN'] . " as \"KODE_PERUBAHAN\", KODE_JANGKA, KODE_KONTRAK, KODE_KANTOR, PERSENTASI, TGL_TARGET, KETERANGAN  
                    FROM EP_KTR_JANGKA_KONTRAK
                    WHERE 
                        KODE_KONTRAK = '" . $this->attributes['KODE_KONTRAK'] . "' 
                        AND KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'";

            $query = $this->db->query($sql);


            $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 
            where kode_nomorurut = 'EP_KTR_PERUBAHAN'");
        }
    }

    public function _before_save() {
        parent::_before_save();
        
        if (isset($this->attributes['LAMPIRAN']) && strlen($this->attributes['LAMPIRAN']) == 0)
            unset($this->attributes['LAMPIRAN']);
    }
}

?>