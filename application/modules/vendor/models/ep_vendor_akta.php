<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_akta extends MY_Model
{
    public $table = "EP_VENDOR_AKTA";
    public $elements_conf = array(
        'TIPE_AKTA'=>array('type'=>'dropdown', 'options' => array('PENDIRIAN' => 'PENDIRIAN', 'PERUBAHAN' => 'PERUBAHAN')),
        'NO_AKTA',
        'TGL_PEMBUATAN',
        'NAMA_NOTARIS',
        'ALAMAT_NOTARIS' => array('type' => 'textarea', 'rows' => 4),
        'PENGESAHAN_HAKIM',
        'BERITA_ACARA_NGR' => array('label' => 'BERITA ACARA NEGARA'),
    );
    public $columns_conf = array(
        'TIPE_AKTA',
        'NO_AKTA',
        'TGL_PEMBUATAN',
        'NAMA_NOTARIS',
        'ALAMAT_NOTARIS',
        'PENGESAHAN_HAKIM',
        'BERITA_ACARA_NGR',
    );
    public $sql_select = "(select * from EP_VENDOR_AKTA)";

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
