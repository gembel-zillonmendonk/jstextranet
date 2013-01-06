<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_temp_wilayah extends MY_Model {

    public $dir = "temp";
    public $table = "EP_VENDOR_TEMP_WILAYAH";
    public $elements_conf = array(
        'KODE2_WILAYAH' => array('label' => 'WILAYAH', 'type' => 'dropdown', 'options' => null),
//        'NO_SMK',
//        'TGL_SMK',
//        'BERLAKU_SMK',
    );
    public $validation = array(
        //'NAMA_BARANG' => array('required' => true),
        'KODE2_WILAYAH' => array('required' => true),
    );
    public $columns_conf = array(
        'KODE_WILAYAH',
        'KODE2_WILAYAH',
        'WILAYAH',
    );
    public $sql_select = "(select KODE_WILAYAH, KODE2_WILAYAH, KODE_VENDOR, WILAYAH from EP_VENDOR_WILAYAH)";

    function __construct() {
        parent::__construct();
        $this->init();

        // dropdown from table relation
        $sql = "select kode_kantor, nama_kantor from ms_kantor where aktif = 'Y' order by nama_kantor";
        $rows = $this->db->query($sql)->result_array();
        $options = array();
        foreach ($rows as $value) {
            $options[$value['KODE_KANTOR']] = $value['NAMA_KANTOR'];
        }
        
        $this->elements_conf['KODE2_WILAYAH']['options'] = $options;
        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
    }

    function _default_scope() {
        $CI = & get_instance();
        return ' KODE_VENDOR = ' . $CI->session->userdata('kode_vendor');
    }

    function _before_save() {
        parent::_before_save();
        // dropdown from table relation
        $query = $this->db->query("select kode_kantor, nama_kantor 
            from ms_kantor 
            where aktif = 'Y'
            and kode_kantor = '".$this->attributes['KODE2_WILAYAH']."'");
        $row = $query->row_array();
        
        if(count($row) > 0)
            $this->attributes['WILAYAH'] = $row['NAMA_KANTOR'];
        
//        $this->attributes['NAMA_BARANG'] = 'xxxx'; // fetch nama_barang depent on kode_barang
    }
    
    function _before_insert() {
        parent::_before_insert();
        
        // set auto increament
        if ($this->attributes['KODE_WILAYAH'] == 0) {
            $row = $this->db->query("select nomorurut + 1 as NEXT_ID 
                from ep_nomorurut 
                where kode_nomorurut = 'EP_VENDOR_TEMP_WILAYAH'")->row_array();
            $this->attributes['KODE_WILAYAH'] = $row['NEXT_ID'];
        }
    }
   
    public function _after_insert() {
        parent::_after_insert();

        $this->db->query("update ep_nomorurut set nomorurut = nomorurut + 1 
            where kode_nomorurut = 'EP_VENDOR_TEMP_WILAYAH'");
    }
}

?>
