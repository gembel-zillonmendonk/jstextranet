<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_laporan_keuangan extends MY_Model {

    public $table = "EP_VENDOR_LAP_KEUANGAN";
    public $elements_conf = array(
        'TAHUN',
        'TIPE' => array('type' => 'dropdown', 'options' => array('AUDIT' => 'AUDIT', 'NON AUDIT' => 'NON AUDIT')),
        'MATA_UANG' => array('type' => 'dropdown', 'options' => array('IDR' => 'IDR', 'USD' => 'USD')),
        'NILAI_ASSET' => array('type' => 'money'),
        'HUTANG' => array('type' => 'money'),
        'PENDAPATAN' => array('type' => 'money'),
        'LABA_BERSIH' => array('type' => 'money'),
//        'KELAS',
    );
    public $validation = array(
        'MATA_UANG' => array('required' => true),
        'TAHUN' => array('required' => true),
        'TIPE' => array('required' => true),
        'NILAI_ASSET' => array('required' => true),
        'HUTANG' => array('required' => true),
        'PENDAPATAN' => array('required' => true),
        'LABA_BERSIH' => array('required' => true),
//        'KELAS' => array('required' => true),
    );
    public $columns_conf = array(
        'MATA_UANG',
        'TAHUN',
        'TIPE',
        'NILAI_ASSET' => array('formatter' => 'currency'),
        'HUTANG' => array('formatter' => 'currency'),
        'PENDAPATAN' => array('formatter' => 'currency'),
        'LABA_BERSIH' => array('formatter' => 'currency'),
//        'KELAS',
    );
    public $sql_select = "(select * from EP_VENDOR_LAP_KEUANGAN)";

    function __construct() {
        parent::__construct();
        $this->init();

        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
    }

    function _default_scope() {
        $CI = & get_instance();
        return ' KODE_VENDOR = ' . $CI->session->userdata('kode_vendor');
    }

}

?>
