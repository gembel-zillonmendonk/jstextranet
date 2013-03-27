<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of periode
 *
 * @author Untung Cahyono
 */
class Opsi extends CI_Model  {
    //put your code here
    
    
    function __construct() {
        parent::__construct();
        
		//echo $this->_module;
    }
    
    function getOpsiSwakelola() {
        $arr_swakelola = array();
        
        $arr_swakelola[0] = 0; 
        $arr_swakelola[1] = 1; 
        
        return $arr_swakelola;
    }
     
    function getTipeKontrak() {
        $arr_tipekontrak = array();
        
        $arr_tipekontrak["RENTAL SERVICE"] = "RENTAL SERVICE"; 
        $arr_tipekontrak["LUMPSUM"] = "LUMPSUM";
        $arr_tipekontrak["HARGA SATUAN"] = "HARGA SATUAN";
        
        
        return $arr_tipekontrak;
    }
    
    
}

?>
