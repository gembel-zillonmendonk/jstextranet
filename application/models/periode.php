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
class Periode extends CI_Model  {
    //put your code here
    var $arr_bulan =  array(
                    "01" => "Januari",
                    "02" => "Pebruari",
                    "03" => "Maret",
                    "04" => "April",
                    "05" => "Mei",
                    "06" => "Juni",
                    "07" => "Juli",
                    "08" => "Agustus",
                    "09" => "September",
                    "10" => "Oktober",
                    "11" => "November",
                    "12" => "Desember" 
                    ); 
            
    var $arr_tahun = array();
        
    
    function __construct() {
        parent::__construct();
        
		//echo $this->_module;
    }
    
    function getBulan() {
        return $this->arr_bulan;
        
    }
    
    function getTahun() {
        
         
        for($i=date("Y");$i>date("Y") -5; $i--){
            $this->arr_tahun[$i] = $i;
        }
        return $this->arr_tahun;   
     }
        
        
         
    
}

?>
