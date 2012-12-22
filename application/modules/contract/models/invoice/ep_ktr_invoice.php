<?php

class ep_ktr_invoice extends MY_Model {

    public $table = 'EP_KTR_INVOICE';
    public $elements_conf = array(
        'KODE_INVOICE',
//        'KODE_KANTOR',
//        'KODE_VENDOR',
        
//        'KODE_KONTRAK'=>array('type'=>'dropdown', 'options'=>array()),
        'NO_KONTRAK',
        'NAMA_VENDOR'=>array('type'=>'label'),
        'TGL_INVOICE',
        'AKUN_BANK',
//        'TGL_BUAT',
//        'STATUS',
//        'POSISI_PERSETUJUAN',
//        'TGL_DISETUJUI',
    );
    public $dir = 'invoice';

    function __construct() {
        parent::__construct();
        $this->init();
        
        $this->attributes['KODE_VENDOR'] = $this->session->userdata('kode_vendor');
        
        // set dropdown value for KODE_KONTRAK
//        $sql = "select distinct b.kode_kontrak as KEY, b.no_kontrak as VAL
//                from ep_ktr_jangka_kontrak a
//                inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor
//                where a.status_bastp = 'O' and b.kode_vendor = '".$this->session->userdata('kode_vendor')."'
//                group by b.kode_kontrak, b.no_kontrak";
//        
//        $sql = "select b.kode_kontrak, b.no_kontrak, b.kode_vendor, a.no_bastp
//                from ep_ktr_jangka_kontrak a
//                inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor
//                where a.status_bastp = 'O' and a.no_bastp not in (select no_bastp from ep_ktr_invoice_item)
//                union all
//                select b.kode_kontrak, b.no_kontrak, b.kode_vendor, a.no_bastp
//                from ep_ktr_termin_kontrak a
//                inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor
//                where a.status_bastp = 'O' and a.no_bastp not in (select no_bastp from ep_ktr_invoice_item)
//                union all
//                select b.kode_kontrak, b.no_kontrak, b.kode_vendor, a.no_bastp
//                from ep_ktr_po a
//                inner join ep_ktr_kontrak b on a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor and a.kode_vendor = b.kode_vendor
//                where a.status_bastp = 'O' and a.no_bastp not in (select no_bastp from ep_ktr_invoice_item)
//                ";
//        
//        $query = $this->db->query($sql);
//        $rows = $query->result_array();
//        $options = array(''=>'');
//        foreach($rows as $val){
//             $options[$val['KODE_KONTRAK']] = $val['NO_KONTRAK'];//array($val['KEY'] => $val['VAL']);
//        }
//        $this->elements_conf['KODE_KONTRAK']['options'] = $options;
        
        
        if(isset($_REQUEST['KODE_KONTRAK']) && $_REQUEST['KODE_KONTRAK'] > 0){
//            $this->elements_conf['KODE_KONTRAK']['value'] = $_REQUEST['KODE_KONTRAK'];
            
            $row = $this->db->query("select * from ep_ktr_kontrak where kode_kontrak = " . $_REQUEST['KODE_KONTRAK'])->row_array();
            $this->attributes['KODE_VENDOR'] = $row['KODE_VENDOR'];
            $this->attributes['NAMA_VENDOR'] = $row['NAMA_VENDOR'];
            $this->attributes['KODE_KANTOR'] = $row['KODE_KANTOR'];
            $this->attributes['KODE_KONTRAK'] = $row['KODE_KONTRAK'];
            $this->attributes['NO_KONTRAK'] = $row['NO_KONTRAK'];
        }
        
    }

}

?>