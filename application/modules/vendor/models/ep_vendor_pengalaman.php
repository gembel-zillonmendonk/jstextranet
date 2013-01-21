<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_pengalaman extends MY_Model {

    public $table = "EP_VENDOR_PENGALAMAN";
    public $elements_conf = array(
        'NAMA'=>array('label' => 'NAMA KLIEN / PERUSAHAAN'),
        'NAMA_PROYEK',
        'MATA_UANG'=> array('type' => 'dropdown', 'options' => array('IDR'=>'IDR','USD'=>'USD')),
        'NILAI'=>array('type' => 'money', 'label' => 'NILAI PROYEK'),
        'TGL_MULAI',
        'TGL_BERAKHIR',
        'KONTAK'=>array('label' => 'NAMA KONTAK'),
        'NO_KONTAK'=>array('label' => 'NO TELPON'),
        'NO_KONTRAK',
        'KETERANGAN' => array('type' => 'textarea'),
    );
    public $validation = array(
        'NAMA' => array('required' => true),
        'NAMA_PROYEK' => array('required' => true),
        //'MATA_UANG' => array('required' => true),
        // 'NILAI' => array('required' => true),
        'TGL_MULAI' => array('required' => true),
        'TGL_BERAKHIR' => array('required' => true),
        'KONTAK' => array('required' => true),
        //'NO_KONTAK' => array('required' => true),
        //'KETERANGAN' => array('required' => true),
    );
    public $columns_conf = array(
        'NAMA',
        'NAMA_PROYEK',
        'MATA_UANG',
        'NILAI' => array('formatter' => 'currency'),
        'TGL_MULAI' => array('formatter' => 'date', 'formatoptions' => array('srcformat'=>'d-m-Y H:i:s', 'newformat'=>'d-m-Y')),
        'TGL_BERAKHIR' => array('formatter' => 'date', 'formatoptions' => array('srcformat'=>'d-m-Y H:i:s', 'newformat'=>'d-m-Y')),
        'KONTAK',
        'NO_KONTAK',
        'NO_KONTRAK',
        'KETERANGAN',
    );
    public $sql_select = "(select * from EP_VENDOR_PENGALAMAN)";

    function __construct() {
        parent::__construct();
        $this->init();

        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
    }

    function _default_scope()
    {
        $CI = & get_instance();
        return ' KODE_VENDOR = '.$CI->session->userdata('kode_vendor');
    }
}

?>
