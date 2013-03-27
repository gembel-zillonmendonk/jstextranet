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
class Ep_pgd_pekerjaan extends MY_Model {

    
  
    //public $table = "VW_PGD_PEKERJAAN_VENDOR";
     public $table = "EP_NOMORURUT";
    
	public $kode_kantor = 'ALL';
	public $kode_nomerurut = 'PERENCANAAN';
		
	
   
		
    public $columns_conf = array('KODE_VENDOR' =>array('hidden'=>true, 'width'=>0) 
                        ,'KODE_TENDER' =>array('hidden'=>false, 'width'=>10)  
                        ,'KODE_KANTOR' =>array('hidden'=>false, 'width'=>10) 
                        , 'JUDUL_PEKERJAAN' =>array('hidden'=>false, 'width'=>20) 
                        ,'TGL_PEMBUKAAN_REG' =>array('hidden'=>false, 'width'=>20) 
                        ,'TGL_PENUTUPAN_REG' =>array('hidden'=>false, 'width'=>20) 
                        ,'TGL_LELANG' =>array('hidden'=>false, 'width'=>20) 
                        ,'NAMA_STATUS' =>array('hidden'=>false, 'width'=>20)  
                        ,'PROSES' =>array('hidden'=>false, 'width'=>7) 
					
        );
	
 
    /*
    public $sql_select = "(SELECT 	 KODE_VENDOR
	, KODE_TENDER
	, JUDUL_PEKERJAAN
	, KODE_KANTOR
	, TGL_PEMBUKAAN_REG
	, TGL_PENUTUPAN_REG
	, TGL_LELANG 
	, KODE_AKTIFITAS
         ,'' as \"PROSES\"
		FROM VW_PGD_PEKERJAAN_VENDOR  ";
    
     */
    
     
     public $sql_select = "(SELECT T.KODE_TENDER, T.KODE_KANTOR, T.JUDUL_PEKERJAAN, P.TGL_PEMBUKAAN_REG, P.TGL_PENUTUPAN_REG, P.TGL_LELANG
                            FROM   EP_PGD_TENDER T
                            INNER JOIN EP_PGD_KOMENTAR_TENDER K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
                            INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
                            WHERE (K.TGL_BERAKHIR IS NULL) AND (K.KODE_AKTIFITAS in (1402, 1502, 1702))
                            AND P.TGL_PENUTUPAN_REG >= SYSDATE) VW_PGD_VENDOR_LELANG
                            WHERE 1=1 ) ";
     
     
           
     
    function __construct() {
        parent::__construct();
            $this->setParam();
        
        
        $this->init();
	
      
        $this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    be = "<button onclick=\"fnProsesPekerjaan(\'"+cl+"\');\"  >PROSES</button>"; 
				 	
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{PROSES:be});
		}
		
 
		
		';    
    }

}

?>
