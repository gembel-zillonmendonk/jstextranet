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
class Ep_pgd_pekerjaan_monitor extends MY_Model {

    
  
  //  public $table = "VW_PGD_VENDOR_MONITOR";
     public $table = "EP_NOMORURUT";
    
	public $kode_kantor = 'ALL';
	public $kode_nomerurut = 'PERENCANAAN';
		
	
   
		
    public $columns_conf = array('KODE_VENDOR' =>array('hidden'=>true, 'width'=>0) 
                        ,'KODE_TENDER' =>array('hidden'=>false, 'width'=>10)  
                        ,'KODE_KANTOR' =>array('hidden'=>false, 'width'=>10) 
                        , 'JUDUL_PEKERJAAN' =>array('hidden'=>false, 'width'=>20) 
                        ,'TGL_PEMBUKAAN_REG' =>array('hidden'=>false, 'width'=>10) 
                        ,'TGL_PENUTUPAN_REG' =>array('hidden'=>false, 'width'=>10) 
                        ,'TGL_LELANG' =>array('hidden'=>false, 'width'=>10) 
                        ,'NAMA_STATUS' =>array('hidden'=>false, 'width'=>20) 
                        ,'LIHAT' =>array('hidden'=>false, 'width'=>5) 
					
        );
	
 	
    public $sql_select = "(SELECT KODE_VENDOR
	   ,KODE_TENDER
	   ,KODE_KANTOR
	   ,JUDUL_PEKERJAAN
	   ,TGL_PEMBUKAAN_REG
	   ,TGL_PENUTUPAN_REG
	   ,TGL_LELANG 
           ,PTVS_STATUS
           ,NAMA_STATUS 
          ,'' as \"LIHAT\"
		FROM (SELECT E.KODE_VENDOR
	   ,T.KODE_TENDER
	   ,T.KODE_KANTOR
	   ,T.JUDUL_PEKERJAAN
	   ,P.TGL_PEMBUKAAN_KUA AS TGL_PEMBUKAAN_REG
	   ,P.TGL_PENUTUPAN_KUA AS TGL_PENUTUPAN_REG
	   ,CASE
	    WHEN  P.TGL_LELANG_TEKNIS  IS NULL THEN P.TGL_LELANG_KOMODITI
		ELSE P.TGL_LELANG_TEKNIS
		END  AS TGL_LELANG
		,999 AS PTVS_STATUS
		,'PQ Proposal Submit' AS NAMA_STATUS
FROM EP_PGD_TENDER T
INNER JOIN EP_PGD_KOMENTAR_TENDER K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
INNER JOIN EP_PGD_TENDER_EVALUASI E ON T.KODE_TENDER = E.KODE_TENDER AND T.KODE_KANTOR = E.KODE_KANTOR
WHERE K.TGL_BERAKHIR IS NULL
AND K.KODE_AKTIFITAS = 302
AND P.TGL_PENUTUPAN_KUA > SYSDATE
UNION ALL
SELECT PTVS.KODE_VENDOR
	   ,T.KODE_TENDER
	   ,T.KODE_KANTOR
	   ,T.JUDUL_PEKERJAAN
	   ,P.TGL_PEMBUKAAN_REG
	   ,P.TGL_PENUTUPAN_REG
	   ,CASE
	    WHEN  P.TGL_LELANG_TEKNIS  IS NULL THEN P.TGL_LELANG_KOMODITI
		ELSE P.TGL_LELANG_TEKNIS
		END  AS TGL_LELANG
		,S.KODE_STATUS AS PTVS_STATUS
		,CASE PTVS.STATUS
			 WHEN 24 THEN
			 	  	 CASE WHEN PTVS.PEMENANG = '1' THEN 'Tender Completed (You are The Winner)'
					 	  ELSE 'Tender Completed (You Loose)'
                     END
			 ELSE S.NAMA_STATUS
		END AS NAMA_STATUS
FROM EP_PGD_TENDER T
INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
INNER JOIN EP_PGD_TENDER_VENDOR_STATUS PTVS ON T.KODE_TENDER = PTVS.KODE_TENDER AND T.KODE_KANTOR = PTVS.KODE_KANTOR
INNER JOIN EP_PGD_STATUS S ON PTVS.STATUS = S.KODE_STATUS
) VW_PGD_VENDOR_MONITOR  ";
     
        function setParam() { 
            $this->sql_select  = $this->sql_select . " WHERE  KODE_VENDOR = " .  $this->session->userdata("kode_vendor"). "  ";
            
             
            if($this->input->get("PTVS_STATUS")) {
                $this->session->set_userdata("PTVS_STATUS", $this->input->get("PTVS_STATUS") );
            }
            if ($this->session->userdata("PTVS_STATUS")) {
                $this->sql_select  = $this->sql_select . " AND  PTVS_STATUS in (" .  $this->session->userdata("PTVS_STATUS") . ") ";
            }
            
            $this->sql_select  = $this->sql_select . " )";  
    
          // echo $this->sql_select ;
    }
     
    function __construct() {
        parent::__construct();
        $this->setParam();
        $this->init();
		$this->js_grid_completed = 'var ids = jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'getDataIDs\');
		for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
                    be = "<button onclick=\"fnProsesPekerjaan(\'"+cl+"\');\"  >LIHAT</button>"; 
				 	
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{LIHAT:be});
		}
		
 
		
		';    
    }

}

?>
