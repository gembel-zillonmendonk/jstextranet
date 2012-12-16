<?php

class ep_ktr_invoice_item extends MY_Model {

    public $table = 'EP_KTR_INVOICE_ITEM';
    public $elements_conf = array(
//        'KODE_ITEM',
//        'KODE_INVOICE',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
//        'KODE_VENDOR',
        'NO_BASTP' => array('type'=>'dropdown', 'options'=>array()),
//        'NILAI_BASTP',
//        'MATA_UANG_BASTP',
//        'PENALTI_BASTP',
//        'PPH23_BASTP',
//        'PPN_BASTP',
//        'DP_BASTP',
//        'SUBTOTAL_BASTP',
//        'KETERANGAN_BASTP',
//        'KOMENTAR_BASTP',
    );
    public $columns_conf = array(
        'KODE_ITEM',
        'KODE_INVOICE',
        'KODE_KONTRAK',
        'KODE_KANTOR',
        'KODE_VENDOR',
        'NO_BASTP',
        'NILAI_BASTP',
//        'MATA_UANG_BASTP',
//        'PENALTI_BASTP',
//        'PPH23_BASTP',
//        'PPN_BASTP',
//        'DP_BASTP',
//        'SUBTOTAL_BASTP',
//        'KETERANGAN_BASTP',
//        'KOMENTAR_BASTP',
    );
    public $dir = 'invoice';

    function __construct() {
        parent::__construct();
        $this->init();

        if (isset($_REQUEST['KODE_INVOICE']) && isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_VENDOR'])) {
            $this->attributes['KODE_INVOICE'] = $_REQUEST['KODE_INVOICE'];
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];
            
            $sql = "select distinct b.no_bastp
                    from ep_ktr_kontrak a
                    inner join ep_ktr_jangka_kontrak b on a.kode_kontrak = b.kode_kontrak
                    left outer join ep_ktr_invoice_item c on b.no_bastp = c.no_bastp
                    where a.KODE_KONTRAK = '" . $this->attributes['KODE_KONTRAK'] . "'" .
                    " and a.KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'" .
                    " and a.KODE_VENDOR = " . $this->attributes['KODE_VENDOR'] .
                    " and b.status_bastp = 'A' and c.no_bastp is null" .
                    " group by b.no_bastp ";
            
        }
        
            $sql = "
                select * from (
                    select b.kode_kontrak, b.no_kontrak, b.kode_vendor, a.no_bastp
                    from ep_ktr_jangka_kontrak a
                    inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor
                    where a.status_bastp = 'A' and a.no_bastp not in (select no_bastp from ep_ktr_invoice_item)
                    union all
                    select b.kode_kontrak, b.no_kontrak, b.kode_vendor, a.no_bastp
                    from ep_ktr_termin_kontrak a
                    inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor
                    where a.status_bastp = 'A' and a.no_bastp not in (select no_bastp from ep_ktr_invoice_item)
                    union all
                    select b.kode_kontrak, b.no_kontrak, b.kode_vendor, a.no_bastp
                    from ep_ktr_po a
                    inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor and a.kode_vendor = b.kode_vendor
                    where a.status_bastp = 'A' and a.no_bastp not in (select no_bastp from ep_ktr_invoice_item)
                ) where kode_kontrak = '".(isset($_REQUEST['KODE_KONTRAK']) ? $_REQUEST['KODE_KONTRAK'] : 0)."'
                ";
            
            $query = $this->db->query($sql);
            $rows = $query->result_array();
            
            $options = array();
            foreach ($rows as $value) {
                $options[$value['NO_BASTP']] = $value['NO_BASTP'];
            }
            
            $this->elements_conf['NO_BASTP']['options'] = $options;
    }
    
    function _before_save() {
        parent::_before_save();

        $row = $this->db->query("select mata_uang, persentasi, nilai_kontrak, (persentasi / 100) * nilai_kontrak as total
                    from ep_ktr_jangka_kontrak a 
                    inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor
                    where a.no_bastp = '" . $this->attributes['NO_BASTP'] ."'")->row_array();
        
        $this->attributes['NILAI_BASTP'] = $row['TOTAL'];
        $this->attributes['MATA_UANG_BASTP'] = $row['MATA_UANG'];
        
    }
    
    function _before_insert() {
        parent::_before_insert();
        
        $row = $this->db->query("select count(*) as CNT from ep_ktr_invoice_item where no_bastp = '" . $this->attributes['NO_BASTP'] . "'")->row_array();
        
        if($row['CNT'] > 0){
            show_error("NOMOR BASTP Sudah ada di database");
        }
        
        // set auto increament
        if ($this->attributes['KODE_ITEM'] == 0) {
            $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                from ep_nomorurut 
                where kode_nomorurut = 'EP_KTR_INVOICE_ITEM'")->row_array();
            $this->attributes['KODE_ITEM'] = $row['NEXT_ID'];
        }
    }

    
    public function _after_insert() {
        parent::_after_insert();

        $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 
            where kode_nomorurut = 'EP_KTR_INVOICE_ITEM'");
    }
    
}

?>