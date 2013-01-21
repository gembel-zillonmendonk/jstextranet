<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_modal extends MY_Model
{
    public $table = "EP_VENDOR";
    public $elements_conf = array(
        'MATA_UANG_MODAL_DASAR' => array('type' => 'dropdown', 'options' => array('IDR' => 'IDR', 'USD' => 'USD')),
        'MODAL_DASAR' => array('type' => 'money'),
        'MATA_UANG_MODAL_SETOR' => array('type' => 'dropdown', 'options' => array('IDR' => 'IDR', 'USD' => 'USD')),
        'MODAL_SETOR' => array('type' => 'money'),
    );
    public $validation = array(
        'MATA_UANG_MODAL_DASAR' => array('required' => true),
        'MODAL_DASAR' => array('required' => true),
//        'MATA_UANG_MODAL_SETOR' => array('required' => true),
//        'MODAL_SETOR' => array('required' => true),
    );
    public $columns_conf = array(
        'MATA_UANG_MODAL_DASAR',
        'MODAL_DASAR' => array('formatter' => 'currency'),
        'MATA_UANG_MODAL_SETOR',
        'MODAL_SETOR' => array('formatter' => 'currency'),
    );

    //public $sql_select = "(select * from EP_VENDOR)";


    function __construct()
    {
        parent::__construct();
        $this->init();

        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
    }
}
?>
