<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_alamat extends MY_Model {

    public $table = "EP_VENDOR_ALAMAT";
    public $elements_conf = array(
        'ALAMAT',
        'KOTA',
        'NEGARA' => array('type' => 'dropdown', 'options' => array('INDONESIA' => 'INDONESIA', 'LAINNYA' => 'LAINNYA')),
        'KODE_POS',
        'TIPE' => array('type' => 'dropdown', 'options' => array('PUSAT' => 'PUSAT', 'CABANG' => 'CABANG')),
        'NO_TELP1' => array('help' => '+62 21 9999999', 'class' => 'telp-mask'),
//        'MASK_NO_TELP1' => array('type' => 'label', 'value' => '', 'default_value' => '+62-21-9999999'),
        'NO_TELP2' => array('help' => '+62 21 9999999', 'class' => 'telp-mask'),
        'FAX' => array('help' => '+62 21 9999999', 'class' => 'telp-mask'),
        'WEBSITE',
    );
    public $validation = array(
        'ALAMAT' => array('required' => true),
        'KOTA' => array('required' => true),
        'NEGARA' => array('required' => true),
        'KODE_POS' => array('required' => true),
        'TIPE' => array('required' => true),
        'NO_TELP1' => array('required' => true),
    );
    public $columns_conf = array(
        'ALAMAT',
        'KOTA',
        'NEGARA',
        'KODE_POS',
        'TIPE',
        'NO_TELP1',
        'FAX',
    );
    public $sql_select = "(select * from EP_VENDOR_ALAMAT)";

    function __construct() {
        parent::__construct();
        $this->init();

        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
        
//        $this->attributes['MASK_NO_TELP1'] = '123123';
    }

    function _default_scope() {
        $CI = & get_instance();
        return ' KODE_VENDOR = ' . $CI->session->userdata('kode_vendor');
    }

}

?>
