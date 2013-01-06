<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_temp_npwp extends MY_Model {

    public $dir = "temp";
    public $table = "EP_VENDOR_TEMP";
    public $elements_conf = array(
        'NO_NPWP',
        'ALAMAT_NPWP' => array('type' => 'textarea', 'rows' => 4),
        'KOTA_NPWP',
        'PROPINSI_NPWP',
        'KODE_POS_NPWP',
        'PKP_NPWP' => array('type' => 'dropdown', 'allow_null' => false, 'options' => array('YA' => 'YA', 'Tidak' => 'Tidak')),
        'NO_PKP_NPWP',
    );
    public $validation = array(
        'NO_NPWP' => array('required' => true),
        'ALAMAT_NPWP' => array('required' => true),
        'KOTA_NPWP' => array('required' => true),
        'PROPINSI_NPWP' => array('required' => true),
        'KODE_POS_NPWP' => array('required' => true),
        'PKP_NPWP' => array('required' => false),
        'NO_PKP_NPWP' => array('required' => false),
    );
    public $columns_conf = array(
        'NO_NPWP',
        'ALAMAT_NPWP',
        'KOTA_NPWP',
        'PROPINSI_NPWP',
        'KODE_POS_NPWP',
        'PKP_NPWP',
        'NO_PKP_NPWP',
    );
    public $sql_select = "(select * from EP_VENDOR_TEMP)";

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
