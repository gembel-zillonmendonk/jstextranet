<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vendor
 *
 * @author farid
 */
class Pengadaan extends MY_Controller
{
    public $rules;
    public $where;

    public function __construct()
    {
        parent::__construct();
       // $this->session->set_userdata('kode_vendor', '512');
    }
    
    public function createOrEdit()
    {
        $this->layout->view('pengadaan/createOrEdit');
    }
    
    public function daftar()
    {
        $this->layout->view('pengadaan/daftar');
    }
    
    
    function daftar_pekerjaan(){
        
        $data["PTVS_STATUS"] = $this->input->get("PTVS_STATUS");
        
        $this->layout->view('pengadaan/daftar_pekerjaan', $data);
    }
    
    
    function view_popup(){
        $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
        $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
        
        $sql = "SELECT METODE_TENDER ";
        $sql .= " FROM EP_PGD_PERSIAPAN_TENDER ";
        $sql .= " WHERE KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND METODE_TENDER = 2 ";
        
        $query = $this->db->query($sql);
        $result = $query->result();
        
        $data["is_lelang"] = 0;
        if (count($result)) {
            $data["is_lelang"] = 1;
        }
        
        
        $this->load->view('pengadaan/pengadaan_monitor', $data);
    }
    
    
    function view(){
        $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
        $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
        
        
        
        $this->layout->view('pengadaan/pengadaan_monitor', $data);
    }
    
    function monitor() {
          $data["PTVS_STATUS"] = $this->input->get("PTVS_STATUS");
      
        $this->layout->view('pengadaan/pengadaan_monitor_list', $data);
    }
    
    function sanggahan_add() {
        echo "sangahan";
        
    }
    
    function pendaftaran_add() {
        if($this->input->post("KODE_TENDER")) {
            
            $sql = "SELECT METODE_SAMPUL, METODE_TENDER ";
            $sql .= " FROM EP_PGD_PERSIAPAN_TENDER ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
            
            $query = $this->db->query($sql);
            $result = $query->result();
            $pvts_status = 20;
            $metode_sampul = 0;
            $metode_tender = 0;
            if (count($result)) {
                $metode_sampul = $result[0]->METODE_SAMPUL; 
                $metode_tender = $result[0]->METODE_TENDER; 
            }
            
            switch($metode_sampul) {
                case 0:
                case 1:
                    $pvts_status = 20;
                    break;
                case 2:
                    $pvts_status = 2;
                    break;
            }
            if ($this->input->post("PVTS_STATUS") == -1 ) {
                $pvts_status = $this->input->post("PVTS_STATUS");
                
            } 
            
            if ($metode_tender == 2) {
                        $sql = "SELECT KODE_TENDER ";
                        $sql .= " FROM EP_PGD_TENDER_VENDOR_STATUS ";
                        $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
                        $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                        $sql .= " AND KODE_VENDOR =  " . $this->input->post("KODE_VENDOR")  ;
 
                        $query = $this->db->query($sql);
                        $result = $query->result();
                        
                        if (count($result) == 0) {
                            $sql = "INSERT INTO EP_PGD_TENDER_VENDOR (KODE_TENDER, KODE_KANTOR, KODE_VENDOR,  TGL_REKAM, PETUGAS_REKAM)";
                            $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "'";
                            $sql .= " ,'" . $this->input->post("KODE_KANTOR") . "'";
                            $sql .= " ," . $this->input->post("KODE_VENDOR")     ;
                            $sql .= ",  TO_DATE('" .  date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
                            $sql .= ",  '" . $this->session->userdata("kode_vendor") . "') ";   

                            $this->db->simple_query($sql);
                            
                        }
                        

                
            }
            
            
            
            
            $sql = "SELECT KODE_TENDER ";
            $sql .= " FROM EP_PGD_TENDER_VENDOR_STATUS ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
            $sql .= " AND KODE_VENDOR =  " . $this->input->post("KODE_VENDOR")  ;
            
             
            $query = $this->db->query($sql);
            $result = $query->result();
              
            
             if (count($result)) {
                $sql = "UPDATE EP_PGD_TENDER_VENDOR_STATUS";
                $sql .= " SET STATUS = " . $pvts_status;
                $sql .= ", TGL_UBAH = TO_DATE('" .  date("Y-m-d H:i:s"). "','YYYY-MM-DD HH24:MI:SS' )   ";
                $sql .= ", PETUGAS_UBAH = '" . $this->session->userdata("kode_vendor") . "' ";    
                $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR =  " . $this->input->post("KODE_VENDOR")  ;

            } else {
                $sql = "INSERT INTO EP_PGD_TENDER_VENDOR_STATUS (KODE_TENDER, KODE_KANTOR, KODE_VENDOR, STATUS, TGL_REKAM, PETUGAS_REKAM)";
                $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " ,'" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " ," . $this->input->post("KODE_VENDOR")     ;
                $sql .= " ," . $pvts_status    ;
                $sql .= ",  TO_DATE('" .  date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
                $sql .= ",  '" . $this->session->userdata("kode_vendor") . "') ";   

                
                
                
            }
             
            
            if ($this->db->simple_query($sql)) {
                echo 1;
            } else {
                echo "0"; // .$sql;
            }
            
            
            
            
             
            
        }
        
    }
    
    function negosiasi() {
        
        
        
        if ($this->input->post("KODE_VENDOR")) {
             
            
                          $this->load->model('Nomorurut','urut');
         
                        $urut = $this->urut->get("ALL","PESANTENDER");
                         
                        $sql = "INSERT INTO EP_PGD_PESAN_TENDER (KODE_PESAN_TENDER";
                        $sql .= " , KODE_TENDER ";
                        $sql .= " , KODE_KANTOR ";
                        $sql .= " , KODE_VENDOR ";
                        $sql .= " , NAMA_AKTIFITAS "; 
                        $sql .= " , TGL_PESAN ";
                         $sql .= " , PESAN ";
                        $sql .= " , TGL_REKAM ";
                        $sql .= " , PETUGAS_REKAM ";
                        $sql .= " ) ";
                        $sql .= " VALUES ( " . $urut;
                        $sql .= " ,'" . $this->input->post("KODE_TENDER") . "'";
                        $sql .= " ,'" . $this->input->post("KODE_KANTOR") . "'";
                        $sql .= " , " . $this->input->post("KODE_VENDOR") . "";
                        $sql .= " , 'NEGOSIASI' ";
                        $sql .= " ,  TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' ) ";
                         $sql .= " , '" . $this->input->post("komentar") . "'";
                        
                        $sql .= " ,  TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' ) ";
                        $sql .= " ,'" . $this->session->userdata("kode_user") . "')";

                   
                    
                        if($this->db->simple_query($sql)){
                             $this->urut->set_plus( "ALL","PESANTENDER") ;
                              /*  
                             $sql = "UPDATE EP_PGD_TENDER_VENDOR_STATUS ";
                             $sql .= " SET STATUS = 10 ";
                             $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
                             $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'"; 
                             $sql .= " AND KODE_VENDOR = " . $this->input->post("KODE_VENDOR");

                             
                             $this->db->simple_query($sql);
                             */
                             echo "1";
                        } else {
                            echo $sql; 
                        }


            exit();
            
            
            
        }
        
        
        $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
        $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
        $data["KODE_VENDOR"] = $this->session->userdata("kode_vendor");
        
        $sql = "SELECT NO_PENAWARAN FROM EP_PGD_PENAWARAN ";
        
         $sql .= " WHERE KODE_VENDOR =  " . $this->session->userdata('kode_vendor');   
         $sql .= " AND KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
         $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
         
         $query = $this->db->query($sql);
         $result = $query->result();
         if (count($result)) {
             $data["NO_PENAWARAN"] = $result[0]->NO_PENAWARAN; 
         }
         
         
        $this->layout->view('pengadaan/negosiasi', $data);
        
    }
    
   
    
    
    function pendaftaran() {
        
        
        $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
        $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
        $data["KODE_VENDOR"] = $this->session->userdata("kode_vendor");
          
        
        $sql = "SELECT METODE_TENDER FROM EP_PGD_PERSIAPAN_TENDER ";
        $sql .= " WHERE KODE_TENDER = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR  = '" .  $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND METODE_TENDER  = 2 ";
        $query = $this->db->query($sql);
         $result = $query->result();
         
         $data["is_lelang"] = 0;
         if(count($result)) {
             $data["is_lelang"] = 1;
         }
         
        $this->layout->view('pengadaan/pendaftaran', $data);
        
    }
    
    
    function pekerjaan() {
        $sql = "SELECT PTVS_STATUS ";
         $sql .= " FROM  ";
		 $sql .= " ( SELECT
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
		   AND (S.KODE_STATUS = 10 )) VW_PGD_PEKERJAAN_VENDOR  ";
         $sql .= " WHERE KODE_VENDOR =  " . $this->session->userdata('kode_vendor');   
         $sql .= " AND KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
         $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
              
      //    echo $sql;
         
         $query = $this->db->query($sql);
         $result = $query->result();
         if (count($result)) {
             switch ($result[0]->PTVS_STATUS){
                 case 1:
                     $this->pendaftaran();
                     break;
                 case 2:
                 case 20:
                 case 21:
                     // SELECT SISTEM_SAMPUL
                     $sql = "SELECT METODE_SAMPUL FROM EP_PGD_PERSIAPAN_TENDER ";
                     $sql .= " WHERE KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
                     $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
              
      //    echo $sql;

                    $query = $this->db->query($sql);
                    $result = $query->result();
                    $METODE_SAMPUL = 1;
                    if(count($result)) {
                        $METODE_SAMPUL = $result[0]->METODE_SAMPUL;
                    }
                    if ($METODE_SAMPUL == 2) {
                        
                        //echo $METODE_SAMPUL . "Penawaran Teknis";    
                         $this->penawaran_teknis();
                        
                    } else {
                        $this->penawaran();
                    }
                     break;
                 case 10:
                     $this->negosiasi();
                     break;
                 
                  
                 
                 
             }
             
             
         }
        
        
        
    }
    
    function penawaran_teknis() {
        
         
        if ($this->input->post("teknis")) {
            
             
             $i = 0;
            foreach($_POST["KETERANGAN_VENDOR"] as $k=>$v) {
                
                $sql = "SELECT KODE_TENDER ";
                $sql .= "FROM EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $v . "'";

                $query = $this->db->query($sql);
                $result = $query->result();
                
                if (count($result)) {
                
                $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " SET KETERANGAN_VENDOR = '" . $_POST["KETERANGAN_VENDOR"][$i] . "'";
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $_POST["KETERANGAN"][$i] . "'";

                } else {
                    
                    $sql = "INSERT INTO  EP_PGD_PENAWARAN_TEKNIS (KODE_TENDER,KODE_KANTOR, KODE_VENDOR, KETERANGAN ";
                    $sql .= " , KETERANGAN_VENDOR, BERAT, TGL_REKAM, PETUGAS_REKAM ) ";
                    
                    $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "','" . $this->input->post("KODE_KANTOR") . "'," . $this->input->post("KODE_VENDOR") ;
                    $sql .= " ,'" . $_POST["KETERANGAN"][$i] . "'";
                    $sql .= " ,'". $_POST["KETERANGAN_VENDOR"][$i] . "'" ;
                    $sql .= " ,". str_replace(",","",$_POST["BERAT"][$i]) . "" ;
 
                    $sql .= " ,TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
                    $sql .= " ,'" . $this->session->userdata("kode_vendor") . "')" ;
             
                     
                }
                
                    if ($this->db->simple_query($sql)) {
                        echo 1;

                    } else {
                        echo $sql;
                    }
                $i++;
            }
            
            echo $sql;
            exit();
        }
        
        
        if ($this->input->post("administrasi")) {
            
            // print_r($_POST);
            $i = 0;
            foreach($_POST["KETERANGAN"] as $k=>$v) {
                
                $sql = "SELECT KODE_TENDER ";
                $sql .= "FROM EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $v . "'";

                $query = $this->db->query($sql);
                $result = $query->result();
                
                if (count($result)) {
                    $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
                    $sql .= " SET VENDOR_CEK = " . $_POST["VENDOR_CEK"][$i];
                    $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                    $sql .= " AND KETERANGAN = '" . $v . "'";
                } else {
                    $sql = "INSERT INTO  EP_PGD_PENAWARAN_TEKNIS (KODE_TENDER,KODE_KANTOR, KODE_VENDOR, KETERANGAN ";
                    $sql .= "  , VENDOR_CEK, TGL_REKAM, PETUGAS_REKAM ) ";
                    
                    $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "','" . $this->input->post("KODE_KANTOR") . "'," . $this->input->post("KODE_VENDOR") ;
                    $sql .= " ,'" . $v . "', ".$_POST["VENDOR_CEK"][$i] ;
                    $sql .= " ,TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
                    $sql .= " ,'" . $this->session->userdata("kode_vendor") . "')" ;
             
                    
                    
                    
                }
                
                    if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else {
                        echo $sql;
                    }
                $i++;
            }
            
             
            
            exit();
        }
        
        
        if ($this->input->post("NO_PENAWARAN")) {
            
            
            $sql = "SELECT KODE_TENDER  FROM EP_PGD_PENAWARAN ";
            $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
            $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
            
            $query = $this->db->query($sql);
            $result = $query->result();
           
            if (count($result) == 0) {
                    

                    $arrBerlaku = split("-",$this->input->post("BERLAKU_HINGGA"));
                     
                
                    $sql = "INSERT  INTO EP_PGD_PENAWARAN (";
                    $sql .= " KODE_TENDER";
                    $sql .= " , KODE_KANTOR";
                    $sql .= " , KODE_VENDOR";
                    $sql .= " , NO_PENAWARAN";
                    $sql .= " , KETERANGAN )";
                    $sql .= " VALUES (";
                    $sql .= "'" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= ",'" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= "," . $this->input->post("KODE_VENDOR") . "";
                    $sql .= ",'" . $this->input->post("NO_PENAWARAN") . "'";
                    $sql .= ",'" .  $this->input->post("KETERANGAN")  . "')";

 
                    if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else {
                        echo $sql;
                    }
            } else {
                $sql = "UPDATE EP_PGD_PENAWARAN  ";
                    $sql .= " SET  NO_PENAWARAN = '" . $this->input->post("NO_PENAWARAN") . "'";
                    $sql .= " , KETERANGAN = '" .  $this->input->post("KETERANGAN")  . "' "; 
                    $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";

                 
                     if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else {
                        echo $sql;
                    } 
            }
            
            
            
                    $sql = "UPDATE EP_PGD_TENDER_VENDOR_STATUS";
        $sql .= " SET STATUS = 21 ";
        $sql .= ", TGL_UBAH = TO_DATE('" .  date("Y-m-d H:i:s"). "','YYYY-MM-DD HH24:MI:SS' )   ";
        $sql .= ", PETUGAS_UBAH = '" . $this->session->userdata("kode_vendor") . "' ";    
        $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
        $sql .= " AND KODE_VENDOR =  " . $this->input->post("KODE_VENDOR")  ;
        
        $this->db->simple_query($sql);
            
            
            
            
            
            
            
            exit();
        }
        
        
        
        $sql = "SELECT    KODE_TENDER";
        $sql .= " , KODE_KANTOR";
        $sql .= " , KODE_VENDOR";
        $sql .= " , NO_PENAWARAN";
        $sql .= " , TIPE";
        $sql .= " , BID_BOND";
        $sql .= " , KANDUNGAN_LOKAL";
        $sql .= " , WAKTU_PENGIRIMAN";
        $sql .= " , UNIT";
        $sql .= " , TO_CHAR(BERLAKU_HINGGA , 'DD-MM-YYYY') AS BERLAKU_HINGGA";
        $sql .= " , LAMPIRAN";
        $sql .= " , KETERANGAN ";
        $sql .= " FROM EP_PGD_PENAWARAN ";
        
        $sql .= " WHERE KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
        
        
         $query = $this->db->query($sql);
         $result = $query->result();
        
         
        
        $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
        $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
        $data["KODE_VENDOR"] = $this->session->userdata("kode_vendor");
         
        
        $data["NO_PENAWARAN"] = "";
        $data["TIPE"] = "";
        $data["BID_BOND"] = "";
        $data["KANDUNGAN_LOKAL"] = "";
        $data["WAKTU_PENGIRIMAN"] = "";
        $data["UNIT"] = "";
        $data["BERLAKU_HINGGA"] = "";
        $data["LAMPIRAN"] = "";
        $data["KETERANGAN"] = "";
            
        if (count($result)) {
            $data["NO_PENAWARAN"] = $result[0]->NO_PENAWARAN;
            $data["TIPE"] = $result[0]->TIPE;
            $data["BID_BOND"] = $result[0]->BID_BOND;
            $data["KANDUNGAN_LOKAL"] = $result[0]->KANDUNGAN_LOKAL;
            $data["WAKTU_PENGIRIMAN"] = $result[0]->WAKTU_PENGIRIMAN;
            $data["UNIT"] = $result[0]->UNIT;
            $data["BERLAKU_HINGGA"] = $result[0]->BERLAKU_HINGGA;
            $data["LAMPIRAN"] = $result[0]->LAMPIRAN;
            $data["KETERANGAN"] = $result[0]->KETERANGAN;
        }
        
        /*
        $sql = "            SELECT 
              KODE_TENDER,
              KODE_KANTOR,
              KODE_VENDOR,
              KETERANGAN,
              BERAT ,
              STATUS_CEK,
              VENDOR_CEK,
              NILAI,
              KETERANGAN_VENDOR
            FROM EP_PGD_PENAWARAN_TEKNIS ";
        $sql .= " WHERE   COALESCE(BERAT, 0) = 0 ";
        $sql .= " AND KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
        */
        
        $sql = "SELECT P.KODE_TENDER, P.KODE_KANTOR  , TV.KODE_VENDOR, COALESCE( T.KETERANGAN , D.ITEM) AS KETERANGAN 
                , COALESCE(T.BERAT,D.BOBOT) AS BERAT  , T.STATUS_CEK, T.VENDOR_CEK, T.NILAI, T.KETERANGAN_VENDOR 
                FROM EP_PGD_PERSIAPAN_TENDER P
                INNER JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI
                INNER JOIN EP_PGD_EVALUASI_MODEL_DETAIL D ON E.KODE_EVALUASI = D.KODE_EVALUASI
                INNER JOIN EP_PGD_TENDER_VENDOR TV ON P.KODE_TENDER = TV.KODE_TENDER AND P.KODE_KANTOR = TV.KODE_KANTOR
                LEFT JOIN EP_PGD_PENAWARAN_TEKNIS T ON P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR = T.KODE_KANTOR AND TV.KODE_VENDOR = T.KODE_VENDOR AND D.ITEM = T.KETERANGAN ";
        $sql .= " WHERE   COALESCE(D.BOBOT, 0) = 0 ";
        $sql .= " AND P.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND P.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND TV.KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
        
        
       // echo $sql;
        
        $query = $this->db->query($sql);
        $data["rsadm"] = $query->result();
       
        /*
        $sql = "            SELECT 
                      KODE_TENDER,
                      KODE_KANTOR,
                      KODE_VENDOR,
                      KETERANGAN,
                      BERAT ,
                      STATUS_CEK,
                      VENDOR_CEK,
                      NILAI,
                      KETERANGAN_VENDOR
                    FROM EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " WHERE   COALESCE(BERAT, 0) != 0 ";
                $sql .= " AND KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
          */      

        
         
        $sql = "SELECT P.KODE_TENDER, P.KODE_KANTOR  , TV.KODE_VENDOR,     COALESCE( T.KETERANGAN , D.ITEM) AS KETERANGAN 
                , COALESCE(T.BERAT,D.BOBOT) AS BERAT  , T.STATUS_CEK, T.VENDOR_CEK, T.NILAI, T.KETERANGAN_VENDOR 
                FROM EP_PGD_PERSIAPAN_TENDER P
                INNER JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI
                INNER JOIN EP_PGD_EVALUASI_MODEL_DETAIL D ON E.KODE_EVALUASI = D.KODE_EVALUASI
                INNER JOIN EP_PGD_TENDER_VENDOR TV ON P.KODE_TENDER = TV.KODE_TENDER AND P.KODE_KANTOR = TV.KODE_KANTOR
                LEFT JOIN EP_PGD_PENAWARAN_TEKNIS T ON P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR = T.KODE_KANTOR AND TV.KODE_VENDOR = T.KODE_VENDOR   AND   D.ITEM = T.KETERANGAN ";
        $sql .= " WHERE   COALESCE(D.BOBOT, 0) != 0 ";
        $sql .= " AND P.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND P.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND TV.KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
       
                $query = $this->db->query($sql);
                $data["rsteknis"] = $query->result();
                
// echo $sql;
                
           //     print_r($data["rsteknis"]);
        
       // print_r( $data["rsadm"]);
          
                
              //  print_r($data["rskomersial"]);
                
        $this->layout->view('pengadaan/penawaran_teknis', $data);
        
    }
    
    
    function penawaran_negosiasi() {
     
          if ($this->input->post("komersial")) {
              
            $this->load->model('Nomorurut','urut');
            $urut = $this->urut->get("ALL","HISTORIPENAWARAN");
       
           $sql = "INSERT INTO EP_PGD_HIST_PENAWARAN (
                    KODE_HIST_PENAWARAN, KODE_TENDER, KODE_KANTOR, 
                    KODE_VENDOR, NO_PENAWARAN, TIPE, 
                    BID_BOND, KANDUNGAN_LOKAL, WAKTU_PENGIRIMAN, 
                    UNIT, BERLAKU_HINGGA, LAMPIRAN, 
                    KETERANGAN, TGL_REKAM, PETUGAS_REKAM )    ";

           $sql .= " SELECT  ";
           $sql .=  $urut;
            $sql .= ", KODE_TENDER, KODE_KANTOR, KODE_VENDOR, 
                    NO_PENAWARAN, TIPE, BID_BOND, 
                    KANDUNGAN_LOKAL, WAKTU_PENGIRIMAN, UNIT, 
                    BERLAKU_HINGGA, LAMPIRAN, KETERANGAN, 
                    TGL_REKAM, PETUGAS_REKAM 
                 FROM EP_PGD_PENAWARAN ";
           $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
           $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
           $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                 
              if ($this->db->simple_query($sql)) {
                  
                  
                    
                $sql = "INSERT INTO EP_PGD_HIST_ITEM_PENAWARAN (
                   KODE_HIST_PENAWARAN, KODE_KANTOR, KODE_TENDER, 
                   KODE_VENDOR, KODE_BARANG_JASA, KODE_SUB_BARANG_JASA, 
                   KETERANGAN, JUMLAH, HARGA, 
                   TGL_REKAM, PETUGAS_REKAM, TGL_UBAH, 
                   PETUGAS_UBAH) ";
                
                $sql .= " SELECT  ";
                $sql .=  $urut;
                $sql .= ",  KODE_KANTOR, KODE_TENDER, KODE_VENDOR, 
                   KODE_BARANG_JASA, KODE_SUB_BARANG_JASA, KETERANGAN, 
                   JUMLAH, HARGA, TGL_REKAM, 
                   PETUGAS_REKAM, TGL_UBAH, PETUGAS_UBAH
                   FROM EP_PGD_ITEM_PENAWARAN ";
                $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";

                $this->db->simple_query($sql);
                    
                $this->urut->set_plus( "ALL","HISTORIPENAWARAN") ;
              }          
              
                //print_r($_POST);
                 
              $i = 0;
              foreach($_POST["KETERANGAN_PENAWARAN"] as $k=>$v) {
             
             $sql = "SELECT KODE_TENDER ";
             $sql .= "FROM EP_PGD_ITEM_PENAWARAN  ";
             $sql .= " WHERE KODE_TENDER =  '" . $this->input->post("KODE_TENDER") . "'" ;
             $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'" ;
             $sql .= " AND KODE_VENDOR = " . $this->input->post("KODE_VENDOR") . "" ;
             $sql .= " AND KODE_BARANG_JASA = '" . $_POST["KODE_BARANG_JASA"][$i] ."'" ;
             $sql .= " AND KODE_SUB_BARANG_JASA =  '" . $_POST["KODE_SUB_BARANG_JASA"][$i] . "'" ;
             $query = $this->db->query($sql);
             $result = $query->result(); 
             if (count($result)) {
             $sql = "UPDATE EP_PGD_ITEM_PENAWARAN ";
             $sql .= " SET HARGA = " .  str_replace(",","", $_POST["HARGA_PENAWARAN"][$i]);
             $sql .= " , JUMLAH = " .  str_replace(",","", $_POST["JUMLAH_PENAWARAN"][$i]);
             $sql .= " , KETERANGAN = '" . $_POST["KETERANGAN_PENAWARAN"][$i] . "'" ;
             $sql .= " , TGL_UBAH = TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
             $sql .= " , PETUGAS_UBAH = '" . $this->session->userdata("kode_vendor") . "'" ;
             $sql .= " WHERE KODE_TENDER =  '" . $this->input->post("KODE_TENDER") . "'" ;
             $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'" ;
             $sql .= " AND KODE_VENDOR = " . $this->input->post("KODE_VENDOR") . "" ;
             $sql .= " AND KODE_BARANG_JASA = '" . $_POST["KODE_BARANG_JASA"][$i] ."'" ;
             $sql .= " AND KODE_SUB_BARANG_JASA =  '" . $_POST["KODE_SUB_BARANG_JASA"][$i] . "'" ;
                 
             } 
             
             
             
             if ($this->db->simple_query($sql)) {
                         echo 1;

                    } else {
                         echo 0;
                    }
                $i++;
             }
             exit();
          }
        
        /*****
        if ($this->input->post("komersial")) {
            
             
             $i = 0;
         //    print_r($_POST);
         foreach($_POST["KETERANGAN_PENAWARAN"] as $k=>$v) {
             
             $sql = "SELECT KODE_TENDER ";
             $sql .= "FROM EP_PGD_ITEM_PENAWARAN  ";
             $sql .= " WHERE KODE_TENDER =  '" . $this->input->post("KODE_TENDER") . "'" ;
             $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'" ;
             $sql .= " AND KODE_VENDOR = " . $this->input->post("KODE_VENDOR") . "" ;
             $sql .= " AND KODE_BARANG_JASA = '" . $_POST["KODE_BARANG_JASA"][$i] ."'" ;
             $sql .= " AND KODE_SUB_BARANG_JASA =  '" . $_POST["KODE_SUB_BARANG_JASA"][$i] . "'" ;
             $query = $this->db->query($sql);
             $result = $query->result(); 
             if (count($result)) {
             $sql = "UPDATE EP_PGD_ITEM_PENAWARAN ";
             $sql .= " SET HARGA = " .  str_replace(",","", $_POST["HARGA_PENAWARAN"][$i]);
             $sql .= " , JUMLAH = " .  str_replace(",","", $_POST["JUMLAH_PENAWARAN"][$i]);
             $sql .= " , KETERANGAN = '" . $_POST["KETERANGAN_PENAWARAN"][$i] . "'" ;
             $sql .= " , TGL_UBAH = TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
             $sql .= " , PETUGAS_UBAH = '" . $this->session->userdata("kode_vendor") . "'" ;
             $sql .= " WHERE KODE_TENDER =  '" . $this->input->post("KODE_TENDER") . "'" ;
             $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'" ;
             $sql .= " AND KODE_VENDOR = " . $this->input->post("KODE_VENDOR") . "" ;
             $sql .= " AND KODE_BARANG_JASA = '" . $_POST["KODE_BARANG_JASA"][$i] ."'" ;
             $sql .= " AND KODE_SUB_BARANG_JASA =  '" . $_POST["KODE_SUB_BARANG_JASA"][$i] . "'" ;
                 
             } else {
                 
             
             
             
             $sql = "INSERT INTO EP_PGD_ITEM_PENAWARAN (";
             $sql .= " 
                     KODE_TENDER
                    , KODE_KANTOR
                    , KODE_VENDOR
                    , KODE_BARANG_JASA
                    , KODE_SUB_BARANG_JASA
                    , KETERANGAN
                    , JUMLAH
                    , HARGA
                    , TGL_REKAM
                    , PETUGAS_REKAM  )";
             $sql .= " VALUES (";
             $sql .= " '" . $this->input->post("KODE_TENDER") . "'" ;
             $sql .= " ,'" . $this->input->post("KODE_KANTOR") . "'" ;
             $sql .= " ," . $this->input->post("KODE_VENDOR") . "" ;
             $sql .= " ,'" . $_POST["KODE_BARANG_JASA"][$i] ."'" ;
             $sql .= " ,'" . $_POST["KODE_SUB_BARANG_JASA"][$i] . "'" ;
             $sql .= " ,'" . $_POST["KETERANGAN_PENAWARAN"][$i] . "'" ;
             $sql .= " , " . str_replace(",","", $_POST["JUMLAH_PENAWARAN"][$i]) . "" ;
             $sql .= " , " . str_replace(",","", $_POST["HARGA_PENAWARAN"][$i]) . "" ;
             $sql .= " ,TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
             $sql .= " ,'" . $this->session->userdata("kode_vendor") . "')" ;
             
             }
             
             
             
             if ($this->db->simple_query($sql)) {
                       // echo 1;

                    } else {
                       // echo $sql;
                    }
                $i++;
        } 
             
        // UPDATE STATUS
        
        $sql = "UPDATE EP_PGD_TENDER_VENDOR_STATUS";
        $sql .= " SET STATUS = 21 ";
        $sql .= ", TGL_UBAH = TO_DATE('" .  date("Y-m-d H:i:s"). "','YYYY-MM-DD HH24:MI:SS' )   ";
        $sql .= ", PETUGAS_UBAH = '" . $this->session->userdata("kode_vendor") . "' ";    
        $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
        $sql .= " AND KODE_VENDOR =  " . $this->input->post("KODE_VENDOR")  ;
        
        $this->db->simple_query($sql);
         
            // Show Rangking
        
        $sql = "SELECT    KODE_VENDOR,  SUM( COALESCE(JUMLAH,0) * COALESCE(HARGA,0)) AS NILAI_HARGA ";
        $sql .= "FROM   EP_PGD_ITEM_PENAWARAN  P ";
        $sql .= " WHERE KODE_TENDER =  '" . $this->input->post("KODE_TENDER") . "'" ;
        $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'" ;
        $sql .= " GROUP BY KODE_VENDOR ";
        $sql .= " ORDER BY NILAI_HARGA ASC ";
        
        
        
        $query = $this->db->query($sql);
        $result = $query->result(); 
       // print_r($result);
        $i = 1;
        $peringkat = 1;
        foreach($result as $row) {
            if ($row->KODE_VENDOR == $this->session->userdata("kode_vendor")  ) {
                    $peringkat = $i;
            }
            $i++;
        }
        
        echo "Saat ini, penawaran anda berada di peringkat #".$peringkat;
            
            exit();
        }
        
        
        if ($this->input->post("teknis")) {
            
             
             $i = 0;
            foreach($_POST["KETERANGAN_VENDOR"] as $k=>$v) {
                
                $sql = "SELECT KODE_TENDER ";
                $sql .= "FROM EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $v . "'";

                $query = $this->db->query($sql);
                $result = $query->result();
                
                if (count($result)) {
                
                $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " SET KETERANGAN_VENDOR = '" . $_POST["KETERANGAN_VENDOR"][$i] . "'";
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $_POST["KETERANGAN"][$i] . "'";

                } else {
                    
                    $sql = "INSERT INTO  EP_PGD_PENAWARAN_TEKNIS (KODE_TENDER,KODE_KANTOR, KODE_VENDOR, KETERANGAN ";
                    $sql .= " , KETERANGAN_VENDOR, BERAT, TGL_REKAM, PETUGAS_REKAM ) ";
                    
                    $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "','" . $this->input->post("KODE_KANTOR") . "'," . $this->input->post("KODE_VENDOR") ;
                    $sql .= " ,'" . $_POST["KETERANGAN"][$i] . "'";
                    $sql .= " ,'". $_POST["KETERANGAN_VENDOR"][$i] . "'" ;
                    $sql .= " ,". str_replace(",","",$_POST["BERAT"][$i]) . "" ;
 
                    $sql .= " ,TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
                    $sql .= " ,'" . $this->session->userdata("kode_vendor") . "')" ;
             
                     
                }
                
                    if ($this->db->simple_query($sql)) {
                        echo 1;

                    } else {
                        echo $sql;
                    }
                $i++;
            }
            
            
            exit();
        }
        
        
        if ($this->input->post("administrasi")) {
            
            // print_r($_POST);
            $i = 0;
            foreach($_POST["KETERANGAN"] as $k=>$v) {
                
                $sql = "SELECT KODE_TENDER ";
                $sql .= "FROM EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $v . "'";

                $query = $this->db->query($sql);
                $result = $query->result();
                
                if (count($result)) {
                    $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
                    $sql .= " SET VENDOR_CEK = " . $_POST["VENDOR_CEK"][$i];
                    $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                    $sql .= " AND KETERANGAN = '" . $v . "'";
                } else {
                    $sql = "INSERT INTO  EP_PGD_PENAWARAN_TEKNIS (KODE_TENDER,KODE_KANTOR, KODE_VENDOR, KETERANGAN ";
                    $sql .= " , VENDOR_CEK, TGL_REKAM, PETUGAS_REKAM ) ";
                    
                    $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "','" . $this->input->post("KODE_KANTOR") . "'," . $this->input->post("KODE_VENDOR") ;
                    $sql .= " ,'" . $v . "',".$_POST["VENDOR_CEK"][$i] ;
                    $sql .= " ,TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
                    $sql .= " ,'" . $this->session->userdata("kode_vendor") . "')" ;
             
                    
                    
                    
                }
                
                    if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else {
                        echo $sql;
                    }
                $i++;
            }
            
             
            
            exit();
        }
        
        
        if ($this->input->post("NO_PENAWARAN")) {
            
            
            $sql = "SELECT KODE_TENDER  FROM EP_PGD_PENAWARAN ";
            $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
            $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
            
            $query = $this->db->query($sql);
            $result = $query->result();
           
            if (count($result) == 0) {
                    

                    $sql = "INSERT  INTO EP_PGD_PENAWARAN (";
                    $sql .= " KODE_TENDER";
                    $sql .= " , KODE_KANTOR";
                    $sql .= " , KODE_VENDOR";
                    $sql .= " , NO_PENAWARAN";
                    $sql .= " , TIPE";
                    $sql .= " , BID_BOND";
                    $sql .= " , KANDUNGAN_LOKAL";
                    $sql .= " , WAKTU_PENGIRIMAN";
                    $sql .= " , UNIT";
                    $sql .= " , BERLAKU_HINGGA";
                    $sql .= " , LAMPIRAN";
                    $sql .= " , KETERANGAN )";
                    $sql .= " VALUES (";
                    $sql .= "'" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= ",'" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= "," . $this->input->post("KODE_VENDOR") . "";
                    $sql .= ",'" . $this->input->post("NO_PENAWARAN") . "'";
                    $sql .= ",'" . $this->input->post("TIPE") . "'";
                    $sql .= "," . str_replace(",","",$this->input->post("BID_BOND")) . "";
                    $sql .= "," . str_replace(",","",$this->input->post("KANDUNGAN_LOKAL")) . "";
                    $sql .= "," . str_replace(",","",$this->input->post("WAKTU_PENGIRIMAN")) . "";
                    $sql .= ",'" . str_replace(",","",$this->input->post("UNIT")) . "'";
                    $sql .= ",TO_DATE('" . $this->input->post("BERLAKU_HINGGA") . "','YYYY-MM-DD' ) ";
                    $sql .= ",''";
                    $sql .= ",'" .  $this->input->post("KETERANGAN")  . "')";





                    if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else {
                        echo $sql;
                    }
            } else {
                $sql = "UPDATE EP_PGD_PENAWARAN  ";
                    $sql .= " SET  NO_PENAWARAN = '" . $this->input->post("NO_PENAWARAN") . "'";
                    $sql .= " , TIPE = '" . $this->input->post("TIPE") . "'";
                    $sql .= " , BID_BOND = " . str_replace(",","",$this->input->post("BID_BOND")) . ""; 
                    $sql .= " , KANDUNGAN_LOKAL  = " . str_replace(",","",$this->input->post("KANDUNGAN_LOKAL")) . "";
                    $sql .= " , WAKTU_PENGIRIMAN = " . str_replace(",","",$this->input->post("WAKTU_PENGIRIMAN")) . "";
                    $sql .= " , UNIT = '" . str_replace(",","",$this->input->post("UNIT")) . "'";
                    $sql .= " , BERLAKU_HINGGA = TO_DATE('" . $this->input->post("BERLAKU_HINGGA") . "','YYYY-MM-DD' ) ";
                    $sql .= " , LAMPIRAN = ''"; 
                    $sql .= " , KETERANGAN = '" .  $this->input->post("KETERANGAN")  . "' "; 
                    $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";

                     if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else {
                        echo $sql;
                    } 
            }
            
            
            
            
            
            
            
            
            
            
            
            exit();
        }
        
         * ******
         */
        
        $sql = "SELECT    KODE_TENDER";
        $sql .= " , KODE_KANTOR";
        $sql .= " , KODE_VENDOR";
        $sql .= " , NO_PENAWARAN";
        $sql .= " , TIPE";
        $sql .= " , BID_BOND";
        $sql .= " , KANDUNGAN_LOKAL";
        $sql .= " , WAKTU_PENGIRIMAN";
        $sql .= " , UNIT";
        $sql .= " , BERLAKU_HINGGA";
        $sql .= " , LAMPIRAN";
        $sql .= " , KETERANGAN ";
        $sql .= " FROM EP_PGD_PENAWARAN ";
        
        $sql .= " WHERE KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
        
        
         $query = $this->db->query($sql);
         $result = $query->result();
        
         
        
        $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
        $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
        $data["KODE_VENDOR"] = $this->session->userdata("kode_vendor");
         
        
        $data["NO_PENAWARAN"] = "";
        $data["TIPE"] = "";
        $data["BID_BOND"] = "";
        $data["KANDUNGAN_LOKAL"] = "";
        $data["WAKTU_PENGIRIMAN"] = "";
        $data["UNIT"] = "";
        $data["BERLAKU_HINGGA"] = "";
        $data["LAMPIRAN"] = "";
        $data["KETERANGAN"] = "";
            
        if (count($result)) {
            $data["NO_PENAWARAN"] = $result[0]->NO_PENAWARAN;
            $data["TIPE"] = $result[0]->TIPE;
            $data["BID_BOND"] = $result[0]->BID_BOND;
            $data["KANDUNGAN_LOKAL"] = $result[0]->KANDUNGAN_LOKAL;
            $data["WAKTU_PENGIRIMAN"] = $result[0]->WAKTU_PENGIRIMAN;
            $data["UNIT"] = $result[0]->UNIT;
            $data["BERLAKU_HINGGA"] = $result[0]->BERLAKU_HINGGA;
            $data["LAMPIRAN"] = $result[0]->LAMPIRAN;
            $data["KETERANGAN"] = $result[0]->KETERANGAN;
        }
        
        /*
        $sql = "            SELECT 
              KODE_TENDER,
              KODE_KANTOR,
              KODE_VENDOR,
              KETERANGAN,
              BERAT ,
              STATUS_CEK,
              VENDOR_CEK,
              NILAI,
              KETERANGAN_VENDOR
            FROM EP_PGD_PENAWARAN_TEKNIS ";
        $sql .= " WHERE   COALESCE(BERAT, 0) = 0 ";
        $sql .= " AND KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
        */
        
        $sql = "SELECT P.KODE_TENDER, P.KODE_KANTOR  , TV.KODE_VENDOR, COALESCE( T.KETERANGAN , D.ITEM) AS KETERANGAN 
                , COALESCE(T.BERAT,D.BOBOT) AS BERAT  , T.STATUS_CEK, T.VENDOR_CEK, T.NILAI, T.KETERANGAN_VENDOR 
                FROM EP_PGD_PERSIAPAN_TENDER P
                INNER JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI
                INNER JOIN EP_PGD_EVALUASI_MODEL_DETAIL D ON E.KODE_EVALUASI = D.KODE_EVALUASI
                INNER JOIN EP_PGD_TENDER_VENDOR TV ON P.KODE_TENDER = TV.KODE_TENDER AND P.KODE_KANTOR = TV.KODE_KANTOR
                LEFT JOIN EP_PGD_PENAWARAN_TEKNIS T ON P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR = T.KODE_KANTOR AND TV.KODE_VENDOR = T.KODE_VENDOR AND D.ITEM = T.KETERANGAN ";
        $sql .= " WHERE   COALESCE(D.BOBOT, 0) = 0 ";
        $sql .= " AND P.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND P.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND TV.KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
        
        
       // echo $sql;
        
        $query = $this->db->query($sql);
        $data["rsadm"] = $query->result();
       
        /*
        $sql = "            SELECT 
                      KODE_TENDER,
                      KODE_KANTOR,
                      KODE_VENDOR,
                      KETERANGAN,
                      BERAT ,
                      STATUS_CEK,
                      VENDOR_CEK,
                      NILAI,
                      KETERANGAN_VENDOR
                    FROM EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " WHERE   COALESCE(BERAT, 0) != 0 ";
                $sql .= " AND KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
          */      

        
         
        $sql = "SELECT P.KODE_TENDER, P.KODE_KANTOR  , TV.KODE_VENDOR,     COALESCE( T.KETERANGAN , D.ITEM) AS KETERANGAN 
                , COALESCE(T.BERAT,D.BOBOT) AS BERAT  , T.STATUS_CEK, T.VENDOR_CEK, T.NILAI, T.KETERANGAN_VENDOR 
                FROM EP_PGD_PERSIAPAN_TENDER P
                INNER JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI
                INNER JOIN EP_PGD_EVALUASI_MODEL_DETAIL D ON E.KODE_EVALUASI = D.KODE_EVALUASI
                INNER JOIN EP_PGD_TENDER_VENDOR TV ON P.KODE_TENDER = TV.KODE_TENDER AND P.KODE_KANTOR = TV.KODE_KANTOR
                LEFT JOIN EP_PGD_PENAWARAN_TEKNIS T ON P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR = T.KODE_KANTOR AND TV.KODE_VENDOR = T.KODE_VENDOR   AND   D.ITEM = T.KETERANGAN ";
        $sql .= " WHERE   COALESCE(D.BOBOT, 0) != 0 ";
        $sql .= " AND P.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND P.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND TV.KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
       
                $query = $this->db->query($sql);
                $data["rsteknis"] = $query->result();
                
// echo $sql;
                
           //     print_r($data["rsteknis"]);
        
       // print_r( $data["rsadm"]);
                
               $sql = "SELECT T.KODE_BARANG_JASA  
                        , T.KODE_BARANG_JASA
                        , T.KODE_SUB_BARANG_JASA
                        , T.KETERANGAN
                        , T.UNIT
                        , T.JUMLAH
                        , T.HARGA 
                        , P.HARGA_PENAWARAN 
                        , P.JUMLAH_PENAWARAN 
                        , P.KETERANGAN AS KETERANGAN_PENAWARAN
                FROM EP_PGD_ITEM_TENDER T 
                LEFT JOIN ( 
                           SELECT     KODE_KANTOR
                           , KODE_TENDER
                           , KODE_VENDOR
                           , KODE_BARANG_JASA
                           , KODE_SUB_BARANG_JASA
                           , KETERANGAN
                           , JUMLAH AS JUMLAH_PENAWARAN
                           , HARGA AS HARGA_PENAWARAN
                           FROM EP_PGD_ITEM_PENAWARAN ";
                $sql .= " WHERE  KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND  KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                $sql .= " AND  KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . "  ";
                $sql .= " ) P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR AND T.KODE_BARANG_JASA = P.KODE_BARANG_JASA  AND T.KODE_SUB_BARANG_JASA = P.KODE_SUB_BARANG_JASA ";
                $sql .= " WHERE T.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND T.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                 
                // echo $sql;
                
                $query = $this->db->query($sql);
                $data["rskomersial"] = $query->result();
                
              //  print_r($data["rskomersial"]);
                
        $this->load->view('pengadaan/penawaran_negosiasi', $data);
    }
    
    
    
    function penawaran() {
     
        if ($this->input->post("komersial")) {
            
             
             $i = 0;
         //    print_r($_POST);
         foreach($_POST["KETERANGAN_PENAWARAN"] as $k=>$v) {
             
             $sql = "SELECT KODE_TENDER ";
             $sql .= "FROM EP_PGD_ITEM_PENAWARAN  ";
             $sql .= " WHERE KODE_TENDER =  '" . $this->input->post("KODE_TENDER") . "'" ;
             $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'" ;
             $sql .= " AND KODE_VENDOR = " . $this->input->post("KODE_VENDOR") . "" ;
             $sql .= " AND KODE_BARANG_JASA = '" . $_POST["KODE_BARANG_JASA"][$i] ."'" ;
             $sql .= " AND KODE_SUB_BARANG_JASA =  '" . $_POST["KODE_SUB_BARANG_JASA"][$i] . "'" ;
             $query = $this->db->query($sql);
             $result = $query->result(); 
             if (count($result)) {
             $sql = "UPDATE EP_PGD_ITEM_PENAWARAN ";
             $sql .= " SET HARGA = " .  str_replace(",","", $_POST["HARGA_PENAWARAN"][$i]);
             $sql .= " , JUMLAH = " .  str_replace(",","", $_POST["JUMLAH_PENAWARAN"][$i]);
             $sql .= " , KETERANGAN = '" . $_POST["KETERANGAN_PENAWARAN"][$i] . "'" ;
             $sql .= " , TGL_UBAH = TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
             $sql .= " , PETUGAS_UBAH = '" . $this->session->userdata("kode_vendor") . "'" ;
             $sql .= " WHERE KODE_TENDER =  '" . $this->input->post("KODE_TENDER") . "'" ;
             $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'" ;
             $sql .= " AND KODE_VENDOR = " . $this->input->post("KODE_VENDOR") . "" ;
             $sql .= " AND KODE_BARANG_JASA = '" . $_POST["KODE_BARANG_JASA"][$i] ."'" ;
             $sql .= " AND KODE_SUB_BARANG_JASA =  '" . $_POST["KODE_SUB_BARANG_JASA"][$i] . "'" ;
                 
             } else {
                 
             
             
             
             $sql = "INSERT INTO EP_PGD_ITEM_PENAWARAN (";
             $sql .= " 
                     KODE_TENDER
                    , KODE_KANTOR
                    , KODE_VENDOR
                    , KODE_BARANG_JASA
                    , KODE_SUB_BARANG_JASA
                    , KETERANGAN
                    , JUMLAH
                    , HARGA
                    , TGL_REKAM
                    , PETUGAS_REKAM  )";
             $sql .= " VALUES (";
             $sql .= " '" . $this->input->post("KODE_TENDER") . "'" ;
             $sql .= " ,'" . $this->input->post("KODE_KANTOR") . "'" ;
             $sql .= " ," . $this->input->post("KODE_VENDOR") . "" ;
             $sql .= " ,'" . $_POST["KODE_BARANG_JASA"][$i] ."'" ;
             $sql .= " ,'" . $_POST["KODE_SUB_BARANG_JASA"][$i] . "'" ;
             $sql .= " ,'" . $_POST["KETERANGAN_PENAWARAN"][$i] . "'" ;
             $sql .= " , " . str_replace(",","", $_POST["JUMLAH_PENAWARAN"][$i]) . "" ;
             $sql .= " , " . str_replace(",","", $_POST["HARGA_PENAWARAN"][$i]) . "" ;
             $sql .= " ,TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
             $sql .= " ,'" . $this->session->userdata("kode_vendor") . "')" ;
             
             }
             
             
             
             if ($this->db->simple_query($sql)) {
                       // echo 1;

                    } else {
                       // echo $sql;
                    }
                $i++;
        } 
             
        // UPDATE STATUS
        
        $sql = "UPDATE EP_PGD_TENDER_VENDOR_STATUS";
        $sql .= " SET STATUS = 21 ";
        $sql .= ", TGL_UBAH = TO_DATE('" .  date("Y-m-d H:i:s"). "','YYYY-MM-DD HH24:MI:SS' )   ";
        $sql .= ", PETUGAS_UBAH = '" . $this->session->userdata("kode_vendor") . "' ";    
        $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
        $sql .= " AND KODE_VENDOR =  " . $this->input->post("KODE_VENDOR")  ;
        
        $this->db->simple_query($sql);
         
            // Show Rangking
        
        $sql = "SELECT    KODE_VENDOR,  SUM( COALESCE(JUMLAH,0) * COALESCE(HARGA,0)) AS NILAI_HARGA ";
        $sql .= "FROM   EP_PGD_ITEM_PENAWARAN  P ";
        $sql .= " WHERE KODE_TENDER =  '" . $this->input->post("KODE_TENDER") . "'" ;
        $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'" ;
        $sql .= " GROUP BY KODE_VENDOR ";
        $sql .= " ORDER BY NILAI_HARGA ASC ";
        
        
        
        $query = $this->db->query($sql);
        $result = $query->result(); 
       // print_r($result);
        $i = 1;
        $peringkat = 1;
        foreach($result as $row) {
            if ($row->KODE_VENDOR == $this->session->userdata("kode_vendor")  ) {
                    $peringkat = $i;
            }
            $i++;
        }
        
        echo "Saat ini, penawaran anda berada di peringkat #".$peringkat;
            
            exit();
        }
        
        
        if ($this->input->post("teknis")) {
            
             
             $i = 0;
            foreach($_POST["KETERANGAN_VENDOR"] as $k=>$v) {
                
                $sql = "SELECT KODE_TENDER ";
                $sql .= "FROM EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $v . "'";

                $query = $this->db->query($sql);
                $result = $query->result();
                
                if (count($result)) {
                
                $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " SET KETERANGAN_VENDOR = '" . $_POST["KETERANGAN_VENDOR"][$i] . "'";
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $_POST["KETERANGAN"][$i] . "'";

                } else {
                    
                    $sql = "INSERT INTO  EP_PGD_PENAWARAN_TEKNIS (KODE_TENDER,KODE_KANTOR, KODE_VENDOR, KETERANGAN ";
                    $sql .= " , KETERANGAN_VENDOR, BERAT, TGL_REKAM, PETUGAS_REKAM ) ";
                    
                    $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "','" . $this->input->post("KODE_KANTOR") . "'," . $this->input->post("KODE_VENDOR") ;
                    $sql .= " ,'" . $_POST["KETERANGAN"][$i] . "'";
                    $sql .= " ,'". $_POST["KETERANGAN_VENDOR"][$i] . "'" ;
                    $sql .= " ,". str_replace(",","",$_POST["BERAT"][$i]) . "" ;
 
                    $sql .= " ,TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
                    $sql .= " ,'" . $this->session->userdata("kode_vendor") . "')" ;
             
                     
                }
                
                    if ($this->db->simple_query($sql)) {
                        echo 1;

                    } else {
                        echo $sql;
                    }
                $i++;
            }
            
            echo $sql;
            exit();
        }
        
        
        if ($this->input->post("administrasi")) {
            
            // print_r($_POST);
            $i = 0;
            foreach($_POST["KETERANGAN"] as $k=>$v) {
                
                $sql = "SELECT KODE_TENDER ";
                $sql .= "FROM EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $v . "'";

                $query = $this->db->query($sql);
                $result = $query->result();
                
                if (count($result)) {
                    $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
                    $sql .= " SET VENDOR_CEK = " . $_POST["VENDOR_CEK"][$i];
                    $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                    $sql .= " AND KETERANGAN = '" . $v . "'";
                } else {
                    $sql = "INSERT INTO  EP_PGD_PENAWARAN_TEKNIS (KODE_TENDER,KODE_KANTOR, KODE_VENDOR, KETERANGAN ";
                    $sql .= "  , VENDOR_CEK, TGL_REKAM, PETUGAS_REKAM ) ";
                    
                    $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "','" . $this->input->post("KODE_KANTOR") . "'," . $this->input->post("KODE_VENDOR") ;
                    $sql .= " ,'" . $v . "', ".$_POST["VENDOR_CEK"][$i] ;
                    $sql .= " ,TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')" ;
                    $sql .= " ,'" . $this->session->userdata("kode_vendor") . "')" ;
             
                    
                    
                    
                }
                
                    if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else {
                        echo $sql;
                    }
                $i++;
            }
            
             
            
            exit();
        }
        
        
        if ($this->input->post("NO_PENAWARAN")) {
            
            
            $sql = "SELECT KODE_TENDER  FROM EP_PGD_PENAWARAN ";
            $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
            $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
            
            $query = $this->db->query($sql);
            $result = $query->result();
           
            if (count($result) == 0) {
                    

                    $arrBerlaku = split("-",$this->input->post("BERLAKU_HINGGA"));
                     
                
                    $sql = "INSERT  INTO EP_PGD_PENAWARAN (";
                    $sql .= " KODE_TENDER";
                    $sql .= " , KODE_KANTOR";
                    $sql .= " , KODE_VENDOR";
                    $sql .= " , NO_PENAWARAN";
                    $sql .= " , TIPE";
                    $sql .= " , BID_BOND";
                    $sql .= " , KANDUNGAN_LOKAL";
                    $sql .= " , WAKTU_PENGIRIMAN";
                    $sql .= " , UNIT";
                    $sql .= " , BERLAKU_HINGGA";
                    $sql .= " , LAMPIRAN";
                    $sql .= " , KETERANGAN )";
                    $sql .= " VALUES (";
                    $sql .= "'" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= ",'" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= "," . $this->input->post("KODE_VENDOR") . "";
                    $sql .= ",'" . $this->input->post("NO_PENAWARAN") . "'";
                    $sql .= ",'" . $this->input->post("TIPE") . "'";
                    $sql .= "," . str_replace(",","",$this->input->post("BID_BOND")) . "";
                    $sql .= "," . str_replace(",","",$this->input->post("KANDUNGAN_LOKAL")) . "";
                    $sql .= "," . str_replace(",","",$this->input->post("WAKTU_PENGIRIMAN")) . "";
                    $sql .= ",'" . str_replace(",","",$this->input->post("UNIT")) . "'";
                    $sql .= ",TO_DATE('" . $arrBerlaku[2] . "-" . $arrBerlaku[1] . "-" . $arrBerlaku[0]  . "','YYYY-MM-DD' ) ";
                    $sql .= ",''";
                    $sql .= ",'" .  $this->input->post("KETERANGAN")  . "')";





                    if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else {
                        echo $sql;
                    }
            } else {
                $sql = "UPDATE EP_PGD_PENAWARAN  ";
                    $sql .= " SET  NO_PENAWARAN = '" . $this->input->post("NO_PENAWARAN") . "'";
                    $sql .= " , TIPE = '" . $this->input->post("TIPE") . "'";
                    $sql .= " , BID_BOND = " . str_replace(",","",$this->input->post("BID_BOND")) . ""; 
                    $sql .= " , KANDUNGAN_LOKAL  = " . str_replace(",","",$this->input->post("KANDUNGAN_LOKAL")) . "";
                    $sql .= " , WAKTU_PENGIRIMAN = " . str_replace(",","",$this->input->post("WAKTU_PENGIRIMAN")) . "";
                    $sql .= " , UNIT = '" . str_replace(",","",$this->input->post("UNIT")) . "'";
                    $sql .= " , BERLAKU_HINGGA = TO_DATE('" . $this->input->post("BERLAKU_HINGGA") . "','DD-MM-YYYY' ) ";
                    $sql .= " , LAMPIRAN = ''"; 
                    $sql .= " , KETERANGAN = '" .  $this->input->post("KETERANGAN")  . "' "; 
                    $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                    $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                    $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";

                 
                     if ($this->db->simple_query($sql)) {
                        echo "1";

                    } else {
                        echo $sql;
                    } 
            }
            
            
            
            
            
            
            
            
            
            
            
            exit();
        }
        
        $sql = "SELECT    KODE_TENDER";
        $sql .= " , KODE_KANTOR";
        $sql .= " , KODE_VENDOR";
        $sql .= " , NO_PENAWARAN";
        $sql .= " , TIPE";
        $sql .= " , BID_BOND";
        $sql .= " , KANDUNGAN_LOKAL";
        $sql .= " , WAKTU_PENGIRIMAN";
        $sql .= " , UNIT";
        $sql .= " , TO_CHAR(BERLAKU_HINGGA , 'DD-MM-YYYY') AS BERLAKU_HINGGA";
        $sql .= " , LAMPIRAN";
        $sql .= " , KETERANGAN ";
        $sql .= " FROM EP_PGD_PENAWARAN ";
        
        $sql .= " WHERE KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
        
        
         $query = $this->db->query($sql);
         $result = $query->result();
        
         
        
        $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
        $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
        $data["KODE_VENDOR"] = $this->session->userdata("kode_vendor");
         
        
        $data["NO_PENAWARAN"] = "";
        $data["TIPE"] = "";
        $data["BID_BOND"] = "";
        $data["KANDUNGAN_LOKAL"] = "";
        $data["WAKTU_PENGIRIMAN"] = "";
        $data["UNIT"] = "";
        $data["BERLAKU_HINGGA"] = "";
        $data["LAMPIRAN"] = "";
        $data["KETERANGAN"] = "";
            
        if (count($result)) {
            $data["NO_PENAWARAN"] = $result[0]->NO_PENAWARAN;
            $data["TIPE"] = $result[0]->TIPE;
            $data["BID_BOND"] = $result[0]->BID_BOND;
            $data["KANDUNGAN_LOKAL"] = $result[0]->KANDUNGAN_LOKAL;
            $data["WAKTU_PENGIRIMAN"] = $result[0]->WAKTU_PENGIRIMAN;
            $data["UNIT"] = $result[0]->UNIT;
            $data["BERLAKU_HINGGA"] = $result[0]->BERLAKU_HINGGA;
            $data["LAMPIRAN"] = $result[0]->LAMPIRAN;
            $data["KETERANGAN"] = $result[0]->KETERANGAN;
        }
        
        /*
        $sql = "            SELECT 
              KODE_TENDER,
              KODE_KANTOR,
              KODE_VENDOR,
              KETERANGAN,
              BERAT ,
              STATUS_CEK,
              VENDOR_CEK,
              NILAI,
              KETERANGAN_VENDOR
            FROM EP_PGD_PENAWARAN_TEKNIS ";
        $sql .= " WHERE   COALESCE(BERAT, 0) = 0 ";
        $sql .= " AND KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
        */
        
        $sql = "SELECT P.KODE_TENDER, P.KODE_KANTOR  , TV.KODE_VENDOR, COALESCE( T.KETERANGAN , D.ITEM) AS KETERANGAN 
                , COALESCE(T.BERAT,D.BOBOT) AS BERAT  , T.STATUS_CEK, T.VENDOR_CEK, T.NILAI, T.KETERANGAN_VENDOR 
                FROM EP_PGD_PERSIAPAN_TENDER P
                INNER JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI
                INNER JOIN EP_PGD_EVALUASI_MODEL_DETAIL D ON E.KODE_EVALUASI = D.KODE_EVALUASI
                INNER JOIN EP_PGD_TENDER_VENDOR TV ON P.KODE_TENDER = TV.KODE_TENDER AND P.KODE_KANTOR = TV.KODE_KANTOR
                LEFT JOIN EP_PGD_PENAWARAN_TEKNIS T ON P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR = T.KODE_KANTOR AND TV.KODE_VENDOR = T.KODE_VENDOR AND D.ITEM = T.KETERANGAN ";
        $sql .= " WHERE   COALESCE(D.BOBOT, 0) = 0 ";
        $sql .= " AND P.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND P.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND TV.KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
        
        
       // echo $sql;
        
        $query = $this->db->query($sql);
        $data["rsadm"] = $query->result();
       
        /*
        $sql = "            SELECT 
                      KODE_TENDER,
                      KODE_KANTOR,
                      KODE_VENDOR,
                      KETERANGAN,
                      BERAT ,
                      STATUS_CEK,
                      VENDOR_CEK,
                      NILAI,
                      KETERANGAN_VENDOR
                    FROM EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " WHERE   COALESCE(BERAT, 0) != 0 ";
                $sql .= " AND KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
          */      

        
         
        $sql = "SELECT P.KODE_TENDER, P.KODE_KANTOR  , TV.KODE_VENDOR,     COALESCE( T.KETERANGAN , D.ITEM) AS KETERANGAN 
                , COALESCE(T.BERAT,D.BOBOT) AS BERAT  , T.STATUS_CEK, T.VENDOR_CEK, T.NILAI, T.KETERANGAN_VENDOR 
                FROM EP_PGD_PERSIAPAN_TENDER P
                INNER JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI
                INNER JOIN EP_PGD_EVALUASI_MODEL_DETAIL D ON E.KODE_EVALUASI = D.KODE_EVALUASI
                INNER JOIN EP_PGD_TENDER_VENDOR TV ON P.KODE_TENDER = TV.KODE_TENDER AND P.KODE_KANTOR = TV.KODE_KANTOR
                LEFT JOIN EP_PGD_PENAWARAN_TEKNIS T ON P.KODE_TENDER = T.KODE_TENDER AND P.KODE_KANTOR = T.KODE_KANTOR AND TV.KODE_VENDOR = T.KODE_VENDOR   AND   D.ITEM = T.KETERANGAN ";
        $sql .= " WHERE   COALESCE(D.BOBOT, 0) != 0 ";
        $sql .= " AND P.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
        $sql .= " AND P.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
        $sql .= " AND TV.KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . " ";
       
                $query = $this->db->query($sql);
                $data["rsteknis"] = $query->result();
                
// echo $sql;
                
           //     print_r($data["rsteknis"]);
        
       // print_r( $data["rsadm"]);
                
               $sql = "SELECT T.KODE_BARANG_JASA  
                        , T.KODE_BARANG_JASA
                        , T.KODE_SUB_BARANG_JASA
                        , T.KETERANGAN
                        , T.UNIT
                        , T.JUMLAH
                        , T.HARGA 
                        , P.HARGA_PENAWARAN 
                        , P.JUMLAH_PENAWARAN 
                        , P.KETERANGAN AS KETERANGAN_PENAWARAN
                FROM EP_PGD_ITEM_TENDER T 
                LEFT JOIN ( 
                           SELECT     KODE_KANTOR
                           , KODE_TENDER
                           , KODE_VENDOR
                           , KODE_BARANG_JASA
                           , KODE_SUB_BARANG_JASA
                           , KETERANGAN
                           , JUMLAH AS JUMLAH_PENAWARAN
                           , HARGA AS HARGA_PENAWARAN
                           FROM EP_PGD_ITEM_PENAWARAN ";
                $sql .= " WHERE  KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND  KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                $sql .= " AND  KODE_VENDOR =  " . $this->session->userdata("kode_vendor") . "  ";
                $sql .= " ) P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR AND T.KODE_BARANG_JASA = P.KODE_BARANG_JASA  AND T.KODE_SUB_BARANG_JASA = P.KODE_SUB_BARANG_JASA ";
                $sql .= " WHERE T.KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
                $sql .= " AND T.KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
                 
                // echo $sql;
                
                $query = $this->db->query($sql);
                $data["rskomersial"] = $query->result();
                
              //  print_r($data["rskomersial"]);
                
        $this->layout->view('pengadaan/penawaran', $data);
    }
    

    public function grid()
    {
        // check and load model
        $model = $this->_load_model('ep_pgd_monitor');
        $query = $this->_grid_data($model);
        if ($this->_is_ajax_request())
        {
            if (isset($_REQUEST['oper']))
            {
                echo json_encode($query);

                exit();
            }
            else
            {

                $this->load->view($model->grid_view, array(
                    'grid' => new MY_Grid($model),
                ));
            }
        }
        else
        {
            $this->layout->view($model->grid_view, array(
                'grid' => new MY_Grid($model),
            ));
        }
    }
}
?>
