<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_temp_barang extends MY_Model
{
    public $dir = "temp";
    public $table = "EP_VENDOR_TEMP_BARANG";
    public $elements_conf = array(
        'NAMA_BARANG',
        //'KODE_BARANG', auto fill on insert/update
        'KODE_BARANG' => array('label'=>'JENIS BARANG', 'type' => 'dropdown', 'options' => null),//, 'onchange' => "$('#id_ep_vendor_temp_barang_keterangan').val($(this).find('option:selected').text())"),
//        'KETERANGAN'=> array('type'=>'text', 'readonly'=>true),
        'MEREK',
        'SUMBER' => array('type' => 'dropdown', 'options' => array('LOKAL' => 'LOKAL', 'NASIONAL' => 'NASIONAL')),
        'TIPE' => array('type' => 'dropdown', 'options' => array('AGENT' => 'AGENT', 'DISTRIBUTOR' => 'DISTRIBUTOR')),
    );
    public $validation = array(
        'NAMA_BARANG' => array('required' => true),
//        'KETERANGAN' => array('required' => true),
        'MEREK' => array('required' => true),
        'SUMBER' => array('required' => true),
        'TIPE' => array('required' => true),
    );
    public $columns_conf = array(
        'NAMA_BARANG',
        'KODE_BARANG',
        'KETERANGAN',
        'MEREK',
        'SUMBER',
        'TIPE',
    );
    public $sql_select = "(select * from EP_VENDOR_TEMP_BARANG)";

    function __construct()
    {
        parent::__construct();
        $this->init();

        // dropdown from table relation
        $query = $this->db->query("select kode_barang, nama_subkelompok from MS_SUBKELOMPOK_BARANG where aktif = 'Y'");
        $rows = $query->result_array();
        $options = array();
        foreach ($rows as $value) {
            $options[$value['KODE_BARANG']] = $value['NAMA_SUBKELOMPOK'];
        }
        
        $this->elements_conf['KODE_BARANG']['options'] = $options;
        
        
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
        $query = $this->db->query("select kode_barang, nama_subkelompok 
            from MS_SUBKELOMPOK_BARANG 
            where aktif = 'Y'
            and kode_barang = '".$this->attributes['KODE_BARANG']."'
            order by nama_subkelompok");
        $row = $query->row_array();
        
        if(count($row) > 0)
            $this->attributes['KETERANGAN'] = $row['NAMA_SUBKELOMPOK'];
        
//        $this->attributes['NAMA_BARANG'] = 'xxxx'; // fetch nama_barang depent on kode_barang
    }

}
?>
