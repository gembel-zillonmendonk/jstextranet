<?php

class ep_ktr_po_perkembangan extends MY_Model {

    public $table = 'EP_KTR_PO_PERKEMBANGAN';
    public $elements_conf = array(
        'NAMA_VENDOR',
        'TGL_MULAI',
        'TGL_AKHIR',
        'CATATAN_PO',
        
//        'KODE_PERKEMBANGAN',
//        'KODE_PO',
//        'KODE_KONTRAK',
//        'KODE_KANTOR',
//        'TGL_PERKEMBANGAN',
//        'TGL_BUAT',
//        'PEMBUAT',
        'NAMA_PEMBUAT',
//        'STATUS',
        'PERSENTASI_PERKEMBANGAN',
//        'POSISI_PERSETUJUAN',
        'KETERANGAN',
    );
    
    public $dir = 'po';

    function __construct() {
        parent::__construct();
        $this->init();
        
        $this->attributes['KODE_PERKEMBANGAN'] = 0;
        
        if (isset($_REQUEST['KODE_PO']) && isset($_REQUEST['KODE_KONTRAK']) && isset($_REQUEST['KODE_KANTOR']) && isset($_REQUEST['KODE_VENDOR'])) {
            $this->attributes['KODE_PO'] = $_REQUEST['KODE_PO'];
            $this->attributes['KODE_KONTRAK'] = $_REQUEST['KODE_KONTRAK'];
            $this->attributes['KODE_KANTOR'] = $_REQUEST['KODE_KANTOR'];
            $this->attributes['KODE_VENDOR'] = $this->session->userdata('kode_vendor');

            // copy default value from ep_ktr_kontrak
            $sql = "select coalesce(b.kode_perkembangan, 0) as kode_perkembangan, a.nama_vendor, a.nama_pembuat, a.tgl_mulai, a.tgl_akhir, a.catatan_po, a.kode_kontrak, a.kode_kantor, a.kode_po
                    from ep_ktr_po a 
                    left join ep_ktr_po_perkembangan b on a.kode_po = b.kode_po and a.kode_kontrak = b.kode_kontrak and a.kode_kantor = b.kode_kantor "
                    . " where a.kode_kontrak = '" . $this->attributes['KODE_KONTRAK'] . "'"
                    . " and a.kode_po = '" . $this->attributes['KODE_PO'] . "'"
                    . " and a.kode_kantor = '" . $this->attributes['KODE_KANTOR'] . "'"
                    . " and a.kode_vendor = '" . $this->attributes['KODE_VENDOR'] . "'";

            $row = $this->db->query($sql)->row_array();

            if (count($row) > 0) {
                $this->attributes['KODE_PERKEMBANGAN'] = $row['KODE_PERKEMBANGAN'];
                $this->attributes['KODE_PO'] = $row['KODE_PO'];
                $this->attributes['NAMA_PEMBUAT'] = $row['NAMA_PEMBUAT'];
                $this->attributes['NAMA_VENDOR'] = $row['NAMA_VENDOR'];
                $this->attributes['TGL_MULAI'] = $row['TGL_MULAI'];
                $this->attributes['TGL_AKHIR'] = $row['TGL_AKHIR'];
                $this->attributes['CATATAN_PO'] = $row['CATATAN_PO'];
            }
        }
    }
    
     public function _before_insert() {
        parent::_before_insert();
        
        // set auto increament
        if ($this->attributes['KODE_PERKEMBANGAN'] == 0) {
            $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                from ep_nomorurut 
                where kode_nomorurut = 'EP_KTR_PO_PERKEMBANGAN'")->row_array();
            $this->attributes['KODE_PERKEMBANGAN'] = $row['NEXT_ID'];
        }
//        die($this->attributes['KODE_PERKEMBANGAN']);
    }
    
    public function _after_insert() {
        parent::_after_insert();

        $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 where kode_nomorurut = 'EP_KTR_PO_PERKEMBANGAN'");
    }

    function _after_save() {
        parent::_after_save();
        
        if (isset($this->attributes['KODE_PO']) != "" &&
                isset($this->attributes['KODE_KANTOR']) != "" &&
                isset($this->attributes['KODE_KONTRAK']) != "") {

            $sel_items = $_REQUEST['selected_items'];
            $sel_qty = $_REQUEST['selected_qty'];
            
            foreach ($sel_items as $k => $v) {

                parse_str($v, $output); // $v is querystring format

                $data['KODE_PO'] = $output['KODE_PO'];
                $data['KODE_PO_ITEM'] = $output['KODE_PO_ITEM'];
                $data['KODE_KONTRAK'] = $output['KODE_KONTRAK'];
                $data['KODE_KANTOR'] = $output['KODE_KANTOR'];
                $data['KODE_ITEM_PERKEMBANGAN'] = $output['KODE_ITEM_PERKEMBANGAN'];
                $data['KODE_PERKEMBANGAN'] = $this->attributes['KODE_PERKEMBANGAN'];
                $data['QTY_PERKEMBANGAN'] = $sel_qty[$k];
                
                if ($data['KODE_ITEM_PERKEMBANGAN'] > 0)  {
                    $this->db->update("ep_ktr_po_item_perkembangan", $data, array(
                        'KODE_ITEM_PERKEMBANGAN' => $data['KODE_ITEM_PERKEMBANGAN']
                    ));
                }
                else {
                    $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                                from ep_nomorurut 
                                where kode_nomorurut = 'EP_KTR_PO_ITEM_PERKEMBANGAN'")->row_array();

                    $data['KODE_ITEM_PERKEMBANGAN'] = $row['NEXT_ID'];
                    

                    $this->db->insert("ep_ktr_po_item_perkembangan", $data);
                    $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 where kode_nomorurut = 'EP_KTR_PO_ITEM_PERKEMBANGAN'");
                }
            }
            
//            $sql = "SELECT KODE_PO_ITEM, KODE_PO, KODE_KONTRAK, KODE_KANTOR
//                    FROM EP_KTR_PO_ITEM
//                    WHERE KODE_KANTOR = '" . $this->attributes['KODE_KANTOR'] . "'"
//                    . " AND KODE_PO= '" . $this->attributes['KODE_PO'] . "'"
//                    . " AND KODE_KONTRAK = '" . $this->attributes['KODE_KONTRAK'] . "'";
//
//            $rows = $this->db->query($sql)->result_array();
//
//            
//            if (count($rows) > 0) {
//                foreach ($rows as $v) {
//                    $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
//                                from ep_nomorurut 
//                                where kode_nomorurut = 'EP_KTR_PO_ITEM_PERKEMBANGAN'")->row_array();
//
//                    $data = array();
//                    $v['KODE_ITEM_PERKEMBANGAN'] = $row['NEXT_ID'];
//                    $v['KODE_PERKEMBANGAN'] = $this->attributes['KODE_PERKEMBANGAN'];
//            
//                    $this->db->insert("ep_ktr_po_item_perkembangan", $v);
//                    
//                    $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 
//                        where kode_nomorurut = 'EP_KTR_PO_ITEM_PERKEMBANGAN'");
//                }
//            }
        }
    }
}

?>