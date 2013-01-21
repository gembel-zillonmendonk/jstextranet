<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_jasa extends MY_Model
{
    public $table = "EP_VENDOR_JASA";
    public $elements_conf = array(
        //'KODE_JASA', auto fill on insert
//        'NAMA_JASA',
        'KODE_JASA'  => array('label'=>'JENIS JASA', 'type' => 'dropdown', 'options' => array()),
        'TIPE' => array('type' => 'dropdown', 'options' => array('AGENT' => 'AGENT', 'DISTRIBUTOR' => 'DISTRIBUTOR', 'MANUFACTURE' => 'MANUFACTURE', 'NON AGENT' => 'NON AGENT', 'SOLE AGENT' => 'SOLE AGENT')),
    );
    public $validation = array(
        'KODE_JASA' => array('required' => true),
//        'NAMA_JASA' => array('required' => true),
        'TIPE' => array('required' => true),
    );
    public $columns_conf = array(
        'KODE_JASA',
        'NAMA_JASA',
        'TIPE',
    );
    public $sql_select = "(select * from EP_VENDOR_JASA)";

    function __construct()
    {
        parent::__construct();
        $this->init();

        $query = $this->db->query("select kode_kel_jasa, nama_kel_jasa
            from EP_KOM_KELOMPOK_JASA
            order by nama_kel_jasa");
        $rows = $query->result_array();
        $options = array('' => '');
        foreach ($rows as $value) {
            $options[$value['KODE_KEL_JASA']] = $value['NAMA_KEL_JASA'];
        }

        $this->elements_conf['KODE_JASA']['options'] = $options;
        
        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
    }

    function _default_scope()
    {
        $CI = & get_instance();
        return ' KODE_VENDOR = '.$CI->session->userdata('kode_vendor');
    }
    
    function _before_save() {
        parent::_before_save();
        // dropdown from table relation
        $query = $this->db->query("select kode_kel_jasa, nama_kel_jasa 
            from EP_KOM_KELOMPOK_JASA 
            where KODE_KEL_JASA = '".$this->attributes['KODE_JASA']."'");
        $row = $query->row_array();
        
        if(count($row) > 0)
            $this->attributes['NAMA_JASA'] = $row['NAMA_KEL_JASA'];
//        $this->attributes['NAMA_JASA'] = 'nama jasa'; // nama_jasa depent by kode_jasa
    }
}
?>
