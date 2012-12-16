<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author  
 */
class Ep_pgd_persiapan_tender extends MY_Model {

    public $table = "EP_PGD_PERSIAPAN_TENDER";
 
    public $elements_conf = array('KODE_TENDER',
                            'KODE_KANTOR',
                            'METODE_TENDER',
                            'METODE_SUBMISSION',
                            'TGL_PEMBUKAAN_REG',
                            'TGL_PENUTUPAN_REG',
                            'TGL_PRE_LELANG',
                            'LOKASI_PRE_LELANG',
                            'TGL_PENUTUPAN_PEN',
                            'TGL_LELANG_TEKNIS',
                            'TGL_LELANG_KOMODITI',
                            'PTP_DELIVERY_POINT_ID',
                            'PTP_DELIVERY_POINT',
                            'PTP_INQUIRY_NOTES',
                            'URUTAN',
                            'TGL_PEMBUKAAN_KUA',
                            'TGL_PENUTUPAN_KUA',
                            'KODE_EVALUASI',
                            'KETERANGAN_EVALUASI',
                            'KODE_PENITIA',
                            'NAMA_PANITIA',
                            'TGL_PEMBUKAAN_LELANG',
                            'TGL_AANWIJZING2',
                            'LOKASI_AANWIJZING2',
                            'JUSTIFIKASI',
                            );
			 
    public $columns_conf = array('KODE_KANTOR',
                            'METODE_TENDER',
                            'METODE_SUBMISSION',
                            'TGL_PEMBUKAAN_REG',
                            'TGL_PENUTUPAN_REG',
                            'TGL_PRE_LELANG',
                            'LOKASI_PRE_LELANG',
                            'TGL_PENUTUPAN_PEN',
                            'TGL_LELANG_TEKNIS',
                            'TGL_LELANG_KOMODITI',
                            'PTP_DELIVERY_POINT_ID',
                            'PTP_DELIVERY_POINT',
                            'PTP_INQUIRY_NOTES',
                            'URUTAN',
                            'TGL_PEMBUKAAN_KUA',
                            'TGL_PENUTUPAN_KUA',
                            'KODE_EVALUASI',
                            'KETERANGAN_EVALUASI',
                            'KODE_PENITIA',
                            'NAMA_PANITIA',
                            'TGL_PEMBUKAAN_LELANG',
                            'TGL_AANWIJZING2',
                            'LOKASI_AANWIJZING2',
                            'JUSTIFIKASI',);
	
	
    public $sql_select = "(SELECT * FROM EP_PGD_PERSIAPAN_TENDER)";
	
    function __construct() {
        parent::__construct();
        $this->init();	 
        
        $CI = & get_instance();
         if ($CI->input->get('KODE_TENDER')) {
            $this->attributes['KODE_TENDER'] = $CI->input->get('KODE_TENDER');
            $this->attributes['KODE_KANTOR'] = $CI->input->get('KODE_KANTOR');
            
        }
    }
	
}	