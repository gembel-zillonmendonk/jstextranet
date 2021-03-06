<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_subkontraktor extends MY_Model
{
    public $table = "EP_VENDOR_INFORMASI_LAIN";
    public $elements_conf = array(
        'NAMA',
        'ALAMAT',
        'KOTA',
        'NEGARA' => array('type'=>'dropdown', 'options' => array('INDONESIA' => 'INDONESIA', 'LAINNYA' => 'LAINNYA')),
        'KODE_POS',
        'KUALIFIKASI',
        'HUBUNGAN',
    );
    public $validation = array(
        'NAMA' => array('required' => true),
        'ALAMAT' => array('required' => true),
        'KOTA' => array('required' => true),
        'NEGARA' => array('required' => true),
        'HUBUNGAN' => array('required' => true),
    );
    public $columns_conf = array(
        'NAMA',
        'ALAMAT',
        'KOTA',
        'NEGARA',
        'KODE_POS',
        'KUALIFIKASI',
        'HUBUNGAN',
    );
    public $sql_select = "(select * from EP_VENDOR_INFORMASI_LAIN where TIPE = 'SUBKONTRAKTOR')";

    function __construct()
    {
        parent::__construct();
        $this->init();

        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
        $this->attributes['TIPE'] = 'SUBKONTRAKTOR';
    }

    function _default_scope()
    {
        $CI = & get_instance();
        return ' KODE_VENDOR = '.$CI->session->userdata('kode_vendor');
    }
}
?>
