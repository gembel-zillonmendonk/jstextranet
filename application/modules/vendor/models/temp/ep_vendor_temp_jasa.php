<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ep_vendor_temp_jasa extends MY_Model
{
	public $dir = "temp";
    public $table = "EP_VENDOR_TEMP_JASA";
    public $elements_conf = array(
        'NAMA_JASA',
        'KODE_JASA'  => array('label'=>'JENIS JASA', 'type' => 'dropdown', 'options' => array()),
        'TIPE' => array('type' => 'dropdown', 'options' => array('AGENT' => 'AGENT', 'DISTRIBUTOR' => 'DISTRIBUTOR')),
    );
    public $validation = array(
        'KODE_JASA' => array('required' => true),
        'NAMA_JASA' => array('required' => true),
        'TIPE' => array('required' => true),
    );
    public $columns_conf = array(
        'KODE_JASA',
        'NAMA_JASA',
        'TIPE',
    );
    public $sql_select = "(select * from EP_VENDOR_TEMP_JASA)";

    function __construct()
    {
        parent::__construct();
        $this->init();

        $query = $this->db->query("select kode_kel_jasa, nama_kel_jasa
            from EP_KOM_KELOMPOK_JASA
            order by nama_kel_jasa");
        $rows = $query->result_array();
        $options = array();
        foreach ($rows as $value) {
            $options[$value['KODE_KEL_JASA']] = $value['NAMA_KEL_JASA'];
        }

        $this->elements_conf['KODE_JASA']['options'] = $options;
        
        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('user_id');
    }

}
?>
