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

    
  
    public $table = "VW_PGD_PEKERJAAN_VENDOR";
    //public $table = "EP_NOMORURUT";
    
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
                        ,'PTVS_STATUS' =>array('hidden'=>false, 'width'=>20) 
                        ,'KODE_AKTIFITAS' =>array('hidden'=>false, 'width'=>20) 
                        ,'PROSES' =>array('hidden'=>false, 'width'=>7) 
					
        );
	
 	
    public $sql_select = "(SELECT 	 KODE_VENDOR
	, KODE_TENDER
	, JUDUL_PEKERJAAN
	, KODE_KANTOR
	, TGL_PEMBUKAAN_REG
	, TGL_PENUTUPAN_REG
	, TGL_LELANG
	, NAMA_STATUS 
	, PTVS_STATUS 
	, KODE_AKTIFITAS
         ,'' as \"PROSES\"
		FROM VW_PGD_PEKERJAAN_VENDOR  ";
    
    /*
     public $sql_select = "(SELECT
	TV.KODE_VENDOR
	,T.KODE_TENDER
	,T.JUDUL_PEKERJAAN
	,T.KODE_KANTOR
	,P.TGL_PEMBUKAAN_REG
	,P.TGL_PENUTUPAN_REG
	,
	CASE
	WHEN P.TGL_LELANG_TEKNIS IS NULL  THEN  P.TGL_LELANG_KOMODITI
	ELSE P.TGL_LELANG_TEKNIS
	END AS TGL_LELANG
	, COALESCE(S.NAMA_STATUS, 'Pendaftaran') AS  NAMA_STATUS
	, COALESCE(PTVS.STATUS,1) AS PTVS_STATUS
	, K.KODE_AKTIFITAS
FROM EP_PGD_TENDER T
INNER JOIN EP_PGD_KOMENTAR_TENDER K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
INNER JOIN EP_PGD_TENDER_VENDOR TV ON T.KODE_TENDER = TV.KODE_TENDER AND T.KODE_KANTOR = TV.KODE_KANTOR
LEFT JOIN EP_PGD_TENDER_VENDOR_STATUS PTVS ON TV.KODE_TENDER = PTVS.KODE_TENDER AND TV.KODE_KANTOR = PTVS.KODE_KANTOR AND TV.KODE_VENDOR = PTVS.KODE_VENDOR
LEFT JOIN EP_PGD_STATUS S ON PTVS.STATUS = S.KODE_STATUS
WHERE     (K.TGL_BERAKHIR IS NULL)
 
--		   AND (K.KODE_AKTIFITAS IN (1205, 1206, 1305, 1306, 1402, 1403, 1502, 1503, 1507,1508, 1605, 1606, 1702, 1703))
----		   AND (P.TGL_PEMBUKAAN_REG <= SYSDATE)
--		   AND (P.TGL_PENUTUPAN_REG >= SYSDATE)
--		   AND (S.KODE_STATUS = 1)
 
UNION ALL
SELECT
	TV.KODE_VENDOR
	,T.KODE_TENDER
	,T.JUDUL_PEKERJAAN
	,T.KODE_KANTOR
	,P.TGL_PEMBUKAAN_REG
	,P.TGL_PENUTUPAN_REG
	,
	CASE
	WHEN P.TGL_LELANG_TEKNIS IS NULL  THEN  P.TGL_LELANG_KOMODITI
	ELSE P.TGL_LELANG_TEKNIS
	END AS TGL_LELANG
	, COALESCE(S.NAMA_STATUS, 'Pendaftaran') AS  NAMA_STATUS
	, COALESCE(PTVS.STATUS,1) AS PTVS_STATUS
	, K.KODE_AKTIFITAS
FROM EP_PGD_TENDER T
INNER JOIN EP_PGD_KOMENTAR_TENDER K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
INNER JOIN EP_PGD_TENDER_VENDOR TV ON T.KODE_TENDER = TV.KODE_TENDER AND T.KODE_KANTOR = TV.KODE_KANTOR
LEFT JOIN EP_PGD_TENDER_VENDOR_STATUS PTVS ON TV.KODE_TENDER = PTVS.KODE_TENDER AND TV.KODE_KANTOR = PTVS.KODE_KANTOR AND TV.KODE_VENDOR = PTVS.KODE_VENDOR
LEFT JOIN EP_PGD_STATUS S ON PTVS.STATUS = S.KODE_STATUS
WHERE     (K.TGL_BERAKHIR IS NULL)
		   AND (K.KODE_AKTIFITAS IN (1205, 1206, 1305, 1306, 1402, 1403, 1502, 1503, 1507, 1508, 1605, 1606, 1702, 1703))
		   AND (P.TGL_LELANG_KOMODITI >=  SYSDATE)
		   AND (S.KODE_STATUS IN (2, 3, 5, 20, 21))
UNION ALL
SELECT
	TV.KODE_VENDOR
	,T.KODE_TENDER
	,T.JUDUL_PEKERJAAN
	,T.KODE_KANTOR
	,P.TGL_PEMBUKAAN_REG
	,P.TGL_PENUTUPAN_REG
	,
	CASE
	WHEN P.TGL_LELANG_TEKNIS IS NULL  THEN  P.TGL_LELANG_KOMODITI
	ELSE P.TGL_LELANG_TEKNIS
	END AS TGL_LELANG
	, COALESCE(S.NAMA_STATUS, 'Pendaftaran') AS  NAMA_STATUS
	, COALESCE(PTVS.STATUS,1) AS PTVS_STATUS
	, K.KODE_AKTIFITAS
FROM EP_PGD_TENDER T
INNER JOIN EP_PGD_KOMENTAR_TENDER K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
INNER JOIN EP_PGD_TENDER_VENDOR TV ON T.KODE_TENDER = TV.KODE_TENDER AND T.KODE_KANTOR = TV.KODE_KANTOR
LEFT JOIN EP_PGD_TENDER_VENDOR_STATUS PTVS ON TV.KODE_TENDER = PTVS.KODE_TENDER AND TV.KODE_KANTOR = PTVS.KODE_KANTOR AND TV.KODE_VENDOR = PTVS.KODE_VENDOR
LEFT JOIN EP_PGD_STATUS S ON PTVS.STATUS = S.KODE_STATUS
WHERE     (K.TGL_BERAKHIR IS NULL)
		   AND (K.KODE_AKTIFITAS IN (1205, 1206, 1305, 1306, 1402, 1403, 1502, 1503, 1507, 1508, 1605, 1606, 1702, 1703))
		   AND (P.TGL_PEMBUKAAN_LELANG >=  SYSDATE)
		   AND (S.KODE_STATUS IN (2, 3, 5, 20, 21))
UNION ALL
SELECT
	TV.KODE_VENDOR
	,T.KODE_TENDER
	,T.JUDUL_PEKERJAAN
	,T.KODE_KANTOR
	,P.TGL_PEMBUKAAN_REG
	,P.TGL_PENUTUPAN_REG
	,
	CASE
	WHEN P.TGL_LELANG_TEKNIS IS NULL  THEN  P.TGL_LELANG_KOMODITI
	ELSE P.TGL_LELANG_TEKNIS
	END AS TGL_LELANG
	, COALESCE(S.NAMA_STATUS, 'Pendaftaran') AS  NAMA_STATUS
	, COALESCE(PTVS.STATUS,1) AS PTVS_STATUS
	, K.KODE_AKTIFITAS
FROM EP_PGD_TENDER T
INNER JOIN EP_PGD_KOMENTAR_TENDER K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
INNER JOIN EP_PGD_TENDER_VENDOR TV ON T.KODE_TENDER = TV.KODE_TENDER AND T.KODE_KANTOR = TV.KODE_KANTOR
LEFT JOIN EP_PGD_TENDER_VENDOR_STATUS PTVS ON TV.KODE_TENDER = PTVS.KODE_TENDER AND TV.KODE_KANTOR = PTVS.KODE_KANTOR AND TV.KODE_VENDOR = PTVS.KODE_VENDOR
LEFT JOIN EP_PGD_STATUS S ON PTVS.STATUS = S.KODE_STATUS
WHERE     (K.TGL_BERAKHIR IS NULL)
		   AND (K.KODE_AKTIFITAS IN (1205, 1206, 1305, 1306, 1402, 1403, 1502, 1503, 1507, 1508, 1605, 1606, 1702, 1703))
		   AND (P.TGL_LELANG_TEKNIS >=  SYSDATE)
		   AND (S.KODE_STATUS IN (2, 3, 5, 20, 21))
-- NEGOSIASI
UNION ALL
SELECT
	TV.KODE_VENDOR
	,T.KODE_TENDER
	,T.JUDUL_PEKERJAAN
	,T.KODE_KANTOR
	,P.TGL_PEMBUKAAN_REG
	,P.TGL_PENUTUPAN_REG
	,
	CASE
	WHEN P.TGL_LELANG_TEKNIS IS NULL  THEN  P.TGL_LELANG_KOMODITI
	ELSE P.TGL_LELANG_TEKNIS
	END AS TGL_LELANG
	, COALESCE(S.NAMA_STATUS, 'Pendaftaran') AS  NAMA_STATUS
	, COALESCE(PTVS.STATUS,1) AS PTVS_STATUS
	, K.KODE_AKTIFITAS
FROM EP_PGD_TENDER T
INNER JOIN EP_PGD_KOMENTAR_TENDER K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
INNER JOIN EP_PGD_TENDER_VENDOR TV ON T.KODE_TENDER = TV.KODE_TENDER AND T.KODE_KANTOR = TV.KODE_KANTOR
LEFT JOIN EP_PGD_TENDER_VENDOR_STATUS PTVS ON TV.KODE_TENDER = PTVS.KODE_TENDER AND TV.KODE_KANTOR = PTVS.KODE_KANTOR AND TV.KODE_VENDOR = PTVS.KODE_VENDOR
LEFT JOIN EP_PGD_STATUS S ON PTVS.STATUS = S.KODE_STATUS
WHERE     (K.TGL_BERAKHIR IS NULL)
		   AND (K.KODE_AKTIFITAS IN (1209,1309, 1407, 1511, 1610, 1706))
		   AND (P.TGL_LELANG_TEKNIS >=  SYSDATE)
		   AND (S.KODE_STATUS = 10 ))";
    */
        function setParam() { 
            $this->sql_select  = $this->sql_select . " WHERE  KODE_VENDOR = " .  $this->session->userdata("user_id"). "  ";
            
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
                    
                    be = "<button onclick=\"fnProsesPekerjaan(\'"+cl+"\');\"  >PROSES</button>"; 
				 	
                    jQuery(\'#grid_'.strtolower(get_class($this)).'\').jqGrid(\'setRowData\',ids[i],{PROSES:be});
		}
		
 
		
		';    
    }

}

?>
