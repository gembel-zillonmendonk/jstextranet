<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author farid
 */
class Ep_vendor_dokumen extends MY_Model {

    public $table = "EP_VENDOR_DOKUMEN";
    public $elements_conf = array('KODE_VENDOR', 'KODE_DOKUMEN_REF', 'STATUS', 'NOTE', 'KETERANGAN');
    public $columns_conf = array(
        'NAMA_VENDOR' => array('hidden' => false, 'width' => 20),
        'KODE_LOGIN' => array('hidden' => false, 'width' => 10),
        'ACT' => array('hidden' => false, 'width' => 10),
        'xxx' => array('hidden' => false, 'width' => 10),
        'NAMA_STATUS_REG' => array('hidden' => false, 'width' => 20)
    );
    public $form_view = 'vendor/form_dokumen';
    public $checklist_doc = array();

    function __construct() {
        parent::__construct();
        $this->init();

        $sql = 'select a.*, B.KODE_VENDOR, B.KETERANGAN, B.NOTE, coalesce(B.STATUS, \'0\') as "STATUS"
                from EP_VENDOR_DOKUMEN_REF a
                left join EP_VENDOR_DOKUMEN b on A.KODE_DOKUMEN_REF = B.KODE_DOKUMEN_REF 
                and kode_vendor = \''.$_REQUEST['KODE_VENDOR'].'\'';
        $query = $this->db->query($sql);
        $this->checklist_doc = $query->result_array();
    }

    public function save() {
        // cek if record new
        if (count($this->primary_keys) == 0)
            show_error("Table doesn't have a primary key");

        if (count($_REQUEST['EP_VENDOR_DOKUMEN']) > 0) {

            $this->attributes['KODE_VENDOR'] = $_REQUEST['KODE_VENDOR'];
            $this->db->delete($this->table, array('KODE_VENDOR' => $this->attributes['KODE_VENDOR']));
            
            foreach ($_REQUEST['EP_VENDOR_DOKUMEN'] as $k => $v) {
                
                $this->attributes = isset($this->attributes) ? array_merge($this->attributes, $v) : $v;
                
                // run before save
                $this->_before_save();

                if (isset($_FILES)) {
                    $files = $_FILES;
                    foreach ($files as $k => $v) {
                        $key = is_array($v['name']) ? array_keys($v['name']) : $k;
                        $key = is_array($key) ? $key[0] : $key;
                        $this->attributes[$key] = is_array($v['name']) ? $v['name'][$key] : $v['name'];
                    }
                }

                $ret = null;
                $ret = $this->_insert();
                
                $this->_after_save();
            }
        }
        return $ret;
    }

}

?>
