<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 *  
 */
class Ms_jabatanx extends MY_Model {

    public $table = "MS_JABATAN";
    //public $table = "EP_NOMORURUT";
    
    public $elements_conf = array('KODE_JABATAN');
    public $columns_conf = array('KODE_JABATAN');
    public $sql_select = "(select  KODE_JABATAN from MS_JABATAN)";
    

    function __construct() {
        parent::__construct();
        $this->init();
    }

}

?>