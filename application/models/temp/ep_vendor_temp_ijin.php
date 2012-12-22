<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_temp_ijin extends MY_Model
{
    public $dir = "temp";
    public $table = "EP_VENDOR_TEMP_IJIN";
    public $elements_conf = array(
        'TIPE',
        'PENERBIT',
        'NO',
        'TGL_MULAI',
        'TGL_BERAKHIR',
    );
    public $validation = array(
        'TIPE' => array('required' => true),
        'PENERBIT' => array('required' => true),
        'NO' => array('required' => true),
        'TGL_MULAI' => array('required' => true),
        'TGL_BERAKHIR' => array('required' => true),
    );
    public $columns_conf = array(
        'TIPE',
        'PENERBIT',
        'NO',
        'TGL_MULAI',
        'TGL_BERAKHIR',
    );
    public $sql_select = "(select * from EP_VENDOR_TEMP_IJIN)";

    function __construct()
    {
        parent::__construct();
        $this->init();
        
         // set default value here
        $CI =& get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
    }

}
?>
