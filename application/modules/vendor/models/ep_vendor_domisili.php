<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_domisili extends MY_Model
{
    public $table = "EP_VENDOR";
    public $elements_conf = array(
        'NO_DOMISILI',
        'TGL_DOMISILI',
        'KADALUARSA_DOMISILI',
        'ALAMAT' => array('type' => 'textarea', 'rows' => 4),
        'KOTA',
        'PROPINSI',
        'KODE_POS',
        'NEGARA' => array('type'=>'dropdown', 'options' => array('INDONESIA' => 'INDONESIA', 'LAINNYA' => 'LAINNYA')),
    );
    public $validation = array(
        'NO_DOMISILI' => array('required' => true),
        'TGL_DOMISILI' => array('required' => true),
        'KADALUARSA_DOMISILI' => array('required' => true),
        'ALAMAT' => array('required' => true),
        'KOTA' => array('required' => true),
        'PROPINSI' => array('required' => true),
        'KODE_POS' => array('required' => true),
        'NEGARA' => array('required' => true),
    );
    public $columns_conf = array(
        'NO_DOMISILI',
        'TGL_DOMISILI',
        'KADALUARSA_DOMISILI',
        'ALAMAT',
        'KOTA',
        'PROPINSI',
        'KODE_POS',
        'NEGARA',);
    
    public $sql_select = "(select * from EP_VENDOR)";

    function __construct()
    {
        parent::__construct();
        $this->init();
        
        // set default value here
        $CI =& get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
    }

    function _default_scope()
    {
        $CI = & get_instance();
        return ' KODE_VENDOR = '.$CI->session->userdata('kode_vendor');
    }
}
?>
