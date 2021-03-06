<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_temp_afiliasi extends MY_Model {

    public $dir = "temp";
    public $table = "EP_VENDOR_TEMP_INFORMASI_LAIN";
    public $elements_conf = array(
        'NAMA',
        'ALAMAT',
        'KOTA',
        'NEGARA' => array('type' => 'dropdown', 'options' => array('INDONESIA' => 'INDONESIA', 'LAINNYA' => 'LAINNYA')),
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
    public $sql_select = "(select * from EP_VENDOR_TEMP_INFORMASI_LAIN where TIPE = 'AFILIASI')";

    function __construct() {
        parent::__construct();
        $this->init();

        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
        $this->attributes['TIPE'] = 'AFILIASI';
    }

    function _default_scope() {
        $CI = & get_instance();
        return ' KODE_VENDOR = ' . $CI->session->userdata('kode_vendor');
    }

}

?>
