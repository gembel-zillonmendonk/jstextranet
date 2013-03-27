<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of alurkerja
 *
 * @author Untung Cahyono
 */
class alurkerja extends CI_Model  {
    
    var $kode_alurkerja;
    var $tipe = "";
    var $proses = array();
    var $arr_sql = array();
    
    var $debug = 0;
    var $kode_komentar_prev ;
    function __construct() {
        parent::__construct();
        
		//echo $this->_module;
    }
    
    function mulai($var_kode_alurkerja) {
        $this->kode_alurkerja = $var_kode_alurkerja;
        $this->proses["KODE_ALURKERJA"] = $var_kode_alurkerja; 
  
    }
    
    function setKodeKomentar($val) {
        $this->kode_komentar_prev = $val;
        
        if ($val) {
            $this->setParam();
        }
    }
    
    
    function setParamInitial($arr = array()) {
         foreach($arr as $k=>$v) {
                    $this->proses[$k] = $v;
         }
           
        
    }
    
    function setParam() {
        switch($this->kode_alurkerja) {
            case 1:
            case 2:
            case 3:    
                $sql = "SELECT KODE_JASA_BARANG, KODE_SUB_BARANG, KODE_HARGA FROM EP_KOM_KOMENTAR WHERE KODE_KOMENTAR = " . $this->kode_komentar_prev;
                $query = $this->db->query($sql);
                $result = $query->result(); 

                if (count($result)) {
                    $this->proses["KODE_JASA_BARANG"] = $result[0]->KODE_JASA_BARANG;
                    $this->proses["KODE_SUB_BARANG"] = $result[0]->KODE_SUB_BARANG;
                    $this->proses["KODE_HARGA"] = $result[0]->KODE_HARGA;
                    
                }
                break;
            
        }
        
    }
    
     function setAttachment($str) {
         $this->proses["ATTACHMENT"] = $str;
   
     } 
    function setDebug($bol) {
        $this->debug = $bol;
        
    }
    
    
    function setKomentar($komentar) {
        
          $this->proses["KOMENTAR"] = $komentar;
    }
    
    
    function getAntarMuka($kode_aktifitas) {
        $sql = "SELECT KODE_AKTIFITAS, LARIK_ANTARMUKA ";
        $sql .= " FROM EP_ALURKERJA_ANTARMUKA ";
        $sql .= " WHERE KODE_AKTIFITAS = " .$kode_aktifitas;
        $query = $this->db->query($sql);
        $result = $query->result(); 
        
        $arr = array();
        if (count($result))  {
            $str = $result[0]->LARIK_ANTARMUKA;
            
            $arr = explode(",", $str);
             
        } 
        
        return $arr;
        
    }
    
    function getTransisi ($kode_aktifitas_dari) {
        $sql = "SELECT T.KODE_TRANSISI, T.KODE_AKTIFITAS_DARI, T.KODE_AKTIFITAS_KE, T.NAMA_TRANSISI ";
        $sql .= " FROM EP_ALURKERJA_TRANSISI T  ";
        $sql .= " LEFT JOIN EP_ALURKERJA_AKTIFITAS A ON T.KODE_AKTIFITAS_DARI = A.KODE_AKTIFITAS   ";
        $sql .= " WHERE T.KODE_AKTIFITAS_DARI = " . $kode_aktifitas_dari; 
        $query = $this->db->query($sql);
        $result = $query->result(); 
        
        return $result; 
         
    }
    
    function getAktifitasKe($kode_transisi) {
        $sql = "SELECT  T.NAMA_TRANSISI, T.KODE_AKTIFITAS_KE, T.KODE_AKTIFITAS_DARI  ";
        $sql .= " FROM EP_ALURKERJA_TRANSISI T ";
        
        $sql .= " WHERE T.KODE_TRANSISI = " . $kode_transisi;
        
        $query = $this->db->query($sql);
        $result = $query->result(); 
        
        if (count($result)) {
            $this->proses["DEBUG"] = $this->debug;
            $this->proses["KODE_KOMENTAR_PREV"] = $this->kode_komentar_prev;
            $this->proses["KODE_AKTIFITAS"] = $result[0]->KODE_AKTIFITAS_KE ;
            $this->proses["KODE_AKTIFITAS_DARI"] = $result[0]->KODE_AKTIFITAS_DARI ;
            
            $this->proses["NAMA_TRANSISI"] = $result[0]->NAMA_TRANSISI;
            $this->proses["TGL_MULAI"] = date("Y-m-d H:i:s");
            $this->proses["KODE_TRANSISI"] = $kode_transisi;
            $this->proses["KODE_KANTOR"] = $this->session->userdata("kode_kantor");
            $this->proses["PETUGAS_REKAM"] = $this->session->userdata("kode_user");
            $this->proses["PETUGAS_UBAH"] = $this->session->userdata("kode_user");
            $this->proses["TGL_REKAM"] = date("Y-m-d H:i:s");
            $this->proses["TGL_UBAH"] = date("Y-m-d H:i:s");
            
            
             $sql = "SELECT  TIPE, NAMA_AKTIFITAS ";
             $sql .= " FROM EP_ALURKERJA_AKTIFITAS WHERE KODE_AKTIFITAS = " . $this->proses["KODE_AKTIFITAS_DARI"];
             $query = $this->db->query($sql);
             $result = $query->result(); 
             if (count($result)) {
                if ($result[0]->TIPE == 'AWAL') {
                    $this->tipe = $result[0]->TIPE; 
                    $this->proses["TIPE"] = $this->tipe ;    
                     $this->proses["NAMA_AKTIFITAS_DARI"] = $result[0]->NAMA_AKTIFITAS;
                    $sql = "SELECT  TIPE, NAMA_AKTIFITAS ";
                    $sql .= " FROM EP_ALURKERJA_AKTIFITAS WHERE KODE_AKTIFITAS = " . $this->proses["KODE_AKTIFITAS"];
                    $query = $this->db->query($sql);
                    $result = $query->result(); 
                    if (count($result)) {
                             $this->proses["NAMA_AKTIFITAS"] = $result[0]->NAMA_AKTIFITAS;
                    }
                    $sql = "SELECT  TIPE, NAMA_AKTIFITAS ";
                    $sql .= " FROM EP_ALURKERJA_AKTIFITAS WHERE KODE_AKTIFITAS = " . $this->proses["KODE_AKTIFITAS"];
                    $query = $this->db->query($sql);
                    $result = $query->result(); 

                    $this->proses["TGL_BERAKHIR"] = date("Y-m-d H:i:s");    
                   if (count($result)) {
                       if($result[0]->TIPE == 'AKHIR') {
                        $this->tipe =   'AWAL_DAN_AKHIR'; 
                        $this->proses["TIPE"] = $this->tipe ;
                        $this->proses["NAMA_AKTIFITAS"] = $result[0]->NAMA_AKTIFITAS;
                       
                        $this->proses["TGL_BERAKHIR"] = date("Y-m-d H:i:s");
                       } 
                   }
                     
                    
                } else {

                    $sql = "SELECT  TIPE, NAMA_AKTIFITAS ";
                    $sql .= " FROM EP_ALURKERJA_AKTIFITAS WHERE KODE_AKTIFITAS = " . $this->proses["KODE_AKTIFITAS"];
                    $query = $this->db->query($sql);
                    $result = $query->result(); 

                   if (count($result)) {
                       $this->tipe = $result[0]->TIPE; 
                        $this->proses["TIPE"] = $this->tipe ;
                        $this->proses["NAMA_AKTIFITAS"] = $result[0]->NAMA_AKTIFITAS;
                       
                        $this->proses["TGL_BERAKHIR"] = date("Y-m-d H:i:s");
                        
                   }
                    
                }
                 
             }
            
             
             
            $this->getKodeAktifitasEksepsi( $kode_transisi) ;
             
            $this->getKodeJabatan($this->proses["KODE_AKTIFITAS"]);
        }
        
       if  ($this->proses["KODE_ALURKERJA"] == 5) {
            $this->execQueryTender(); 
       } else {
           
           $this->execQuery();
       }
    } 
    
    function getKodeAktifitasEksepsi( $kode_transisi){
         $this->proses["KODE_AKTIFITAS"] = $this->proses["KODE_AKTIFITAS"];
        
         if ( $this->proses["KODE_ALURKERJA"]== 5) {
         
              $sql = "SELECT  QUERY_EKSEPSI, KODE_AKTIFITAS_KE ";
              $sql .= " FROM EP_ALURKERJA_TRANSISI_EKSEPSI WHERE KODE_TRANSISI = " . $kode_transisi;

              $query = $this->db->query($sql);
              $result = $query->result(); 
              foreach($result as $row) {
                  $strqry = $row->QUERY_EKSEPSI;
                  
                  $strqry = str_replace('@KODE_TENDER', $this->proses["KODE_TENDER"], $strqry );
                  $strqry = str_replace('@KODE_KANTOR' , $this->proses["KODE_KANTOR"], $strqry );
                  
                 // echo $strqry;
                  
                  
                      $query = $this->db->query($strqry);
                      $rs = $query->result();
                      if (count($rs)) {

                          $this->proses["KODE_AKTIFITAS"] = $row->KODE_AKTIFITAS_KE;
                           $sql = "SELECT  TIPE, NAMA_AKTIFITAS ";
                            $sql .= " FROM EP_ALURKERJA_AKTIFITAS WHERE KODE_AKTIFITAS = " . $this->proses["KODE_AKTIFITAS"];
                            $query = $this->db->query( $sql);
                             $result = $query->result(); 
                            foreach($result as $rowx) {
                                  $this->proses["NAMA_AKTIFITAS"] =  $rowx->NAMA_AKTIFITAS;
                            }
                        }
                            
                            
                      }

              }
         
            
            
        
    }
    
    
    function getKodeJabatan($kode_aktifitas) {
        $sql = "SELECT  KODE_PERAN ";
        $sql .= " FROM EP_ALURKERJA_AKTIFITAS WHERE KODE_AKTIFITAS = " . $kode_aktifitas;
        
        $query = $this->db->query($sql);
        $result = $query->result(); 
        
        
        if (count($result)) {
            $this->proses["KODE_JABATAN"] = $result[0]->KODE_PERAN ;
            $sql = "SELECT  NAMA_JABATAN ";
            $sql .= " FROM MS_JABATAN WHERE KODE_JABATAN = " . $this->proses["KODE_JABATAN"];

            $query = $this->db->query($sql);
            $result = $query->result(); 
            if (count($result)) {
                
                
            $this->proses["NAMA_JABATAN"] = $result[0]->NAMA_JABATAN ;
            }
            
            
            
            
        }
        
    }
    
    function getQueryTender() {
        $sql = "";
         
             
                if ($this->proses["TIPE"] == 'AKHIR') {
               
                         
                    $sql .= "UPDATE EP_PGD_KOMENTAR_TENDER  ";
                    $sql .= " SET  TGL_BERAKHIR = ";
                    $sql .= "  TO_DATE('" . $this->proses["TGL_BERAKHIR"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= " WHERE KODE_KOMENTAR =  " . $this->proses["KODE_KOMENTAR_PREV"] . "";
                    
                    $this->arr_sql[0] = $sql;
                   
               
                    
                    $sql  = " INSERT INTO EP_PGD_KOMENTAR_TENDER  (";
                    $sql  .= "KODE_KOMENTAR   ";
                    $sql  .= ",KODE_TENDER      ";
                    $sql  .= ",KODE_KANTOR  "; 
                    $sql  .= ",KODE_JABATAN ";
                    $sql  .= ",NAMA_JABATAN	 "; 
                    $sql  .= ",NAMA	 ";
                    $sql  .= ",KODE_AKTIFITAS  ";
                    $sql  .= ",NAMA_AKTIFITAS	 ";
                    $sql  .= ",KODE_TRANSISI  ";
                    $sql  .= ",NAMA_TRANSISI	 ";
   
                    
                    $sql  .= ",KOMENTAR	 ";
                    $sql  .= ",ATTACHMENT  ";
                    $sql  .= ",TGL_MULAI	 ";
                    $sql  .= ",TGL_BERAKHIR  ";
                    $sql  .= ",TGL_REKAM ";
                    $sql  .= ",PETUGAS_REKAM  "; 
                    $sql  .= ",TGL_UBAH ";
                    $sql  .= ",PETUGAS_UBAH  ";
                    $sql .= ", KODE_ALURKERJA ) ";
                    $sql .= " VALUES (". $this->proses["KODE_KOMENTAR"]."";
                    $sql .= ", '" . $this->proses["KODE_TENDER"] . "'  "; 
                    $sql .= ", '" . $this->proses["KODE_KANTOR"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' ";
                    $sql .= ", '" . $this->proses["KODE_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["KOMENTAR"] . "'  ";
                    $sql .= ", '" . $this->proses["ATTACHMENT"] . "'  ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_BERAKHIR"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_REKAM"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_UBAH"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_UBAH"] . "' ";
                    $sql .= ", ".$this->proses["KODE_ALURKERJA"]."   )  ";
                    $this->arr_sql[1] = $sql;
                   
                } 
                if ($this->proses["TIPE"] == 'AWAL') {
                    
                    
                    $sql  = " INSERT INTO EP_PGD_KOMENTAR_TENDER  (";
                    $sql  .= "KODE_KOMENTAR   ";
                    $sql  .= ",KODE_TENDER      ";
                    $sql  .= ",KODE_KANTOR  "; 
                    $sql  .= ",KODE_JABATAN ";
                    $sql  .= ",NAMA_JABATAN	 "; 
                    $sql  .= ",NAMA 	 "; 
                    
                    $sql  .= ",KODE_AKTIFITAS  ";
                    $sql  .= ",NAMA_AKTIFITAS	 ";
                    $sql  .= ",KODE_TRANSISI  ";
                    $sql  .= ",NAMA_TRANSISI	 ";
                    $sql  .= ",KOMENTAR	 ";
                    $sql  .= ",ATTACHMENT  ";
                    $sql  .= ",TGL_MULAI	 ";
                    $sql  .= ",TGL_BERAKHIR  ";
                    $sql  .= ",TGL_REKAM ";
                    $sql  .= ",PETUGAS_REKAM  "; 
                    $sql .= ", KODE_ALURKERJA ) ";
                    $sql .= " VALUES (". $this->proses["KODE_KOMENTAR"]."";
                    $sql .= ", '" . $this->proses["KODE_TENDER"] . "'  "; 
                    $sql .= ", '" . $this->proses["KODE_KANTOR"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_JABATAN"] . "'  ";
                     $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' "; 
                    $sql .= ", '" . $this->proses["KODE_AKTIFITAS_DARI"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_AKTIFITAS_DARI"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["KOMENTAR"] . "'  ";
                    $sql .= ", '" . $this->proses["ATTACHMENT"] . "'  ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                   
                    $sql .= ", TO_DATE('" . $this->proses["TGL_REKAM"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' "; 
                    $sql .= ", ".$this->proses["KODE_ALURKERJA"]."   )  ";
                    
                    $this->arr_sql[0] = $sql;
                    
                    $sql  = " INSERT INTO EP_PGD_KOMENTAR_TENDER  (";
                    $sql  .= "KODE_KOMENTAR   ";
                    $sql  .= ",KODE_TENDER      ";
                    $sql  .= ",KODE_KANTOR  "; 
                    $sql  .= ",KODE_JABATAN ";
                    $sql  .= ",NAMA_JABATAN	 "; 
                    $sql  .= ",KODE_AKTIFITAS  ";
                    $sql  .= ",NAMA_AKTIFITAS	 "; 
                    $sql  .= ",KOMENTAR	 ";
                    $sql  .= ",ATTACHMENT  ";
                    $sql  .= ",TGL_MULAI	 ";
                    $sql  .= ",TGL_REKAM ";
                    $sql  .= ",PETUGAS_REKAM  "; 
                    $sql .= ", KODE_ALURKERJA ) ";
                    $sql .= " VALUES (". ($this->proses["KODE_KOMENTAR"] + 1 )."";
                    $sql .= ", '" . $this->proses["KODE_TENDER"] . "'  "; 
                    $sql .= ", '" . $this->proses["KODE_KANTOR"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_AKTIFITAS"] . "'  "; 
                    $sql .= ", '" . $this->proses["KOMENTAR"] . "'  ";
                    $sql .= ", '" . $this->proses["ATTACHMENT"] . "'  ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_REKAM"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' "; 
                    $sql .= ", ".$this->proses["KODE_ALURKERJA"]."   )  ";
                    
                    
                    
                    
                     
                    $this->arr_sql[1] = $sql;
                    
                          
                    $sql  = "UPDATE EP_PGD_KOMENTAR_TENDER  ";
                    $sql .= " SET  TGL_BERAKHIR = ";
                    $sql .= "  TO_DATE('" . $this->proses["TGL_BERAKHIR"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= " WHERE KODE_KOMENTAR =  " . $this->proses["KODE_KOMENTAR_PREV"] . "";
                    
                    $this->arr_sql[2] = $sql;
                   
                    
                } 
                
                if ($this->proses["TIPE"] == 'AWAL_DAN_AKHIR') {
                    
                    
                    $sql  = " INSERT INTO EP_PGD_KOMENTAR_TENDER  (";
                    $sql  .= "KODE_KOMENTAR   ";
                    $sql  .= ",KODE_TENDER      ";
                    $sql  .= ",KODE_KANTOR  "; 
                    $sql  .= ",KODE_JABATAN ";
                    $sql  .= ",NAMA_JABATAN	 "; 
                    $sql  .= ",NAMA 	 "; 
                    
                    $sql  .= ",KODE_AKTIFITAS  ";
                    $sql  .= ",NAMA_AKTIFITAS	 ";
                    $sql  .= ",KODE_TRANSISI  ";
                    $sql  .= ",NAMA_TRANSISI	 ";
                    $sql  .= ",KOMENTAR	 ";
                    $sql  .= ",ATTACHMENT  ";
                    $sql  .= ",TGL_MULAI	 ";
                    $sql  .= ",TGL_BERAKHIR  ";
                    $sql  .= ",TGL_REKAM ";
                    $sql  .= ",PETUGAS_REKAM  "; 
                    $sql .= ", KODE_ALURKERJA ) ";
                    $sql .= " VALUES (". $this->proses["KODE_KOMENTAR"]."";
                    $sql .= ", '" . $this->proses["KODE_TENDER"] . "'  "; 
                    $sql .= ", '" . $this->proses["KODE_KANTOR"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_JABATAN"] . "'  ";
                     $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' "; 
                    $sql .= ", '" . $this->proses["KODE_AKTIFITAS_DARI"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_AKTIFITAS_DARI"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["KOMENTAR"] . "'  ";
                    $sql .= ", '" . $this->proses["ATTACHMENT"] . "'  ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                   
                    $sql .= ", TO_DATE('" . $this->proses["TGL_REKAM"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' "; 
                    $sql .= ", ".$this->proses["KODE_ALURKERJA"]."   )  ";
                    
                    $this->arr_sql[0] = $sql;
                    
                  
                    $sql  = " INSERT INTO EP_PGD_KOMENTAR_TENDER  (";
                    $sql  .= "KODE_KOMENTAR   ";
                    $sql  .= ",KODE_TENDER      ";
                    $sql  .= ",KODE_KANTOR  "; 
                    $sql  .= ",KODE_JABATAN ";
                    $sql  .= ",NAMA_JABATAN	 "; 
                    $sql  .= ",NAMA	 ";
                    $sql  .= ",KODE_AKTIFITAS  ";
                    $sql  .= ",NAMA_AKTIFITAS	 ";
                    $sql  .= ",KODE_TRANSISI  ";
                    $sql  .= ",NAMA_TRANSISI	 ";
   
                    
                    $sql  .= ",KOMENTAR	 ";
                    $sql  .= ",ATTACHMENT  ";
                    $sql  .= ",TGL_MULAI	 ";
                    $sql  .= ",TGL_BERAKHIR  ";
                    $sql  .= ",TGL_REKAM ";
                    $sql  .= ",PETUGAS_REKAM  "; 
                    $sql  .= ",TGL_UBAH ";
                    $sql  .= ",PETUGAS_UBAH  ";
                    $sql .= ", KODE_ALURKERJA ) ";
                    $sql .= " VALUES (". ($this->proses["KODE_KOMENTAR"] + 1) ."";
                    $sql .= ", '" . $this->proses["KODE_TENDER"] . "'  "; 
                    $sql .= ", '" . $this->proses["KODE_KANTOR"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' ";
                    $sql .= ", '" . $this->proses["KODE_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["KOMENTAR"] . "'  ";
                    $sql .= ", '" . $this->proses["ATTACHMENT"] . "'  ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_BERAKHIR"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_REKAM"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_UBAH"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_UBAH"] . "' ";
                    $sql .= ", ".$this->proses["KODE_ALURKERJA"]."   )  ";
                    $this->arr_sql[1] = $sql;
                    
                } 
                
                if (strlen($this->proses["TIPE"])==0) {
                    
                    $sql .= "UPDATE EP_PGD_KOMENTAR_TENDER  ";
                    $sql .= " SET  TGL_BERAKHIR = ";
                    $sql .= "  TO_DATE('" . $this->proses["TGL_BERAKHIR"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= " WHERE KODE_KOMENTAR =  " . $this->proses["KODE_KOMENTAR_PREV"] . " ";
                    
                    $this->arr_sql[0] = $sql;
                    
                    $sql  = " INSERT INTO EP_PGD_KOMENTAR_TENDER  (";
                    $sql  .= "KODE_KOMENTAR   ";
                    $sql  .= ",KODE_TENDER      ";
                    $sql  .= ",KODE_KANTOR  "; 
                    $sql  .= ",KODE_JABATAN ";
                    $sql  .= ",NAMA_JABATAN	 "; 
                    $sql  .= ",KODE_AKTIFITAS  ";
                    $sql  .= ",NAMA_AKTIFITAS	 "; 
                    $sql  .= ",KOMENTAR	 ";
                    $sql  .= ",ATTACHMENT  ";
                    $sql  .= ",TGL_MULAI	 ";
                    $sql  .= ",TGL_REKAM ";
                    $sql  .= ",PETUGAS_REKAM  "; 
                    $sql .= ", KODE_ALURKERJA ) ";
                    $sql .= " VALUES (". ($this->proses["KODE_KOMENTAR"] + 1 )."";
                    $sql .= ", '" . $this->proses["KODE_TENDER"] . "'  "; 
                    $sql .= ", '" . $this->proses["KODE_KANTOR"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_AKTIFITAS"] . "'  "; 
                    $sql .= ", '" . $this->proses["KOMENTAR"] . "'  ";
                    $sql .= ", '" . $this->proses["ATTACHMENT"] . "'  ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_REKAM"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' "; 
                    $sql .= ", ".$this->proses["KODE_ALURKERJA"]."   )  ";
                    
                   
                    
                    $this->arr_sql[1] = $sql;
                }
           
        
        return  $sql;
    }
    
    function getQuery() {
        $sql = "";
         
             
                if ($this->proses["TIPE"] == 'AKHIR') {
               
                         
                    $sql .= "UPDATE EP_KOM_KOMENTAR  ";
                    $sql .= " SET  TGL_BERAKHIR = ";
                    $sql .= "  TO_DATE('" . $this->proses["TGL_BERAKHIR"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= " WHERE KODE_KOMENTAR =  " . $this->proses["KODE_KOMENTAR_PREV"] . "";
                    
                     $this->arr_sql[0] = $sql;
                   
               
                    
                    $sql  = " INSERT INTO EP_KOM_KOMENTAR  (KODE_KOMENTAR   ";
                    $sql .= ", KODE_JASA_BARANG  ";
                    $sql .= ", KODE_SUB_BARANG ";
                    $sql .= ", KODE_KANTOR ";
                    $sql .= ", KODE_JABATAN  ";
                    $sql .= ", JABATAN  ";
                    $sql .= ", KODE_AKTIFITAS ";
                    $sql .= ", AKTIFITAS ";
                    $sql .= ", KODE_RESPON ";
                    $sql .= ", RESPON ";
                    $sql .= ", KOMENTAR ";
                    $sql .= ", ATTACHMENT ";
                    $sql .= ", TGL_MULAI ";    
                    $sql .= ", TGL_BERAKHIR ";  
                    $sql .= ", TGL_REKAM ";
                    $sql .= ", PETUGAS_REKAM  ";
                    $sql .= ", TGL_UBAH ";
                    $sql .= ", PETUGAS_UBAH  ";
                    
                    if  ($this->kode_alurkerja == 2) {
                        $sql .= ", KODE_HARGA "; 
                    }
                    
                    $sql .= ", KODE_ALURKERJA ) ";
                    $sql .= " VALUES (". $this->proses["KODE_KOMENTAR"]."";
                    $sql .= ", '" . $this->proses["KODE_JASA_BARANG"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_SUB_BARANG"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_KANTOR"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["KOMENTAR"] . "'  ";
                    $sql .= ", '" . $this->proses["ATTACHMENT"] . "'  ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_BERAKHIR"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_REKAM"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_UBAH"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_UBAH"] . "' ";
                    
                    if  ($this->kode_alurkerja == 2) {
                        $sql .= ", ".$this->proses["KODE_HARGA"]."";
                    }
                    
                    $sql .= ", ".$this->proses["KODE_ALURKERJA"]."   )  ";
                     $this->arr_sql[1] = $sql;
                   
                } 
                if ($this->proses["TIPE"] == 'AWAL') {
                    $sql  = "INSERT INTO EP_KOM_KOMENTAR  (KODE_KOMENTAR   ";
                    $sql .= ", KODE_JASA_BARANG  ";
                    $sql .= ", KODE_SUB_BARANG ";
                    $sql .= ", KODE_KANTOR ";
                    $sql .= ", KODE_JABATAN  ";
                    $sql .= ", JABATAN  ";
                    $sql .= ", KODE_AKTIFITAS ";
                    $sql .= ", AKTIFITAS ";
                    $sql .= ", KODE_RESPON ";
                    $sql .= ", RESPON ";
                    $sql .= ", KOMENTAR ";
                    $sql .= ", ATTACHMENT ";
                    $sql .= ", TGL_MULAI ";           
                    $sql .= ", TGL_REKAM ";
                    $sql .= ", PETUGAS_REKAM  ";
                    
                    
                      if  ($this->kode_alurkerja == 2 || $this->kode_alurkerja == 3) {
                        $sql .= ", KODE_HARGA "; 
                    }
                    
                    
                    $sql .= ", KODE_ALURKERJA ) ";
                    $sql .= " VALUES (". $this->proses["KODE_KOMENTAR"]."";
                    $sql .= ", '" . $this->proses["KODE_JASA_BARANG"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_SUB_BARANG"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_KANTOR"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["KOMENTAR"] . "'  ";
                    $sql .= ", '" . $this->proses["ATTACHMENT"] . "'  ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_REKAM"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_REKAM"] . "' ";
                      if  ($this->kode_alurkerja == 2 || $this->kode_alurkerja == 3) {
                        $sql .= ", ".$this->proses["KODE_HARGA"]."";
                    }
                    
                    $sql .= ", ".$this->proses["KODE_ALURKERJA"]."   )  ";
                    
                    $this->arr_sql[0] = "";
                    $this->arr_sql[1] = $sql;
                    
                } 
                
                if (strlen($this->proses["TIPE"])==0) {
                    
                    $sql .= "UPDATE EP_KOM_KOMENTAR  ";
                    $sql .= " SET  TGL_BERAKHIR = ";
                    $sql .= "  TO_DATE('" . $this->proses["TGL_BERAKHIR"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql = " WHERE KODE_KOMENTAR =  " . $this->proses["KODE_KOMENTAR_PREV"] . " ";
                    
                    $this->arr_sql[0] = $sql;
                    
                    $sql  = " INSERT INTO EP_KOM_KOMENTAR  (KODE_KOMENTAR   ";
                    $sql .= ", KODE_JASA_BARANG  ";
                    $sql .= ", KODE_SUB_BARANG ";
                    $sql .= ", KODE_KANTOR ";
                    $sql .= ", KODE_JABATAN  ";
                    $sql .= ", JABATAN  ";
                    $sql .= ", KODE_AKTIFITAS ";
                    $sql .= ", AKTIFITAS ";
                    $sql .= ", KODE_RESPON ";
                    $sql .= ", RESPON ";
                    $sql .= ", KOMENTAR ";
                    $sql .= ", ATTACHMENT ";
                    $sql .= ", TGL_MULAI ";           
                    $sql .= ", TGL_UBAH ";
                    $sql .= ", PETUGAS_UBAH  ";
                      if  ($this->kode_alurkerja == 2 || $this->kode_alurkerja == 3) {
                        $sql .= ", KODE_HARGA "; 
                    }
                    
                    $sql .= ", KODE_ALURKERJA ) ";
                    $sql .= " VALUES (". $this->proses["KODE_KOMENTAR"]."";
                    $sql .= ", '" . $this->proses["KODE_JASA_BARANG"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_SUB_BARANG"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_KANTOR"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_JABATAN"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_AKTIFITAS"] . "'  ";
                    $sql .= ", '" . $this->proses["KODE_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["NAMA_TRANSISI"] . "'  ";
                    $sql .= ", '" . $this->proses["KOMENTAR"] . "'  ";
                    $sql .= ", '" . $this->proses["ATTACHMENT"] . "'  ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_MULAI"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", TO_DATE('" . $this->proses["TGL_UBAH"] . "','YYYY-MM-DD HH24:MI:SS' )   ";
                    $sql .= ", '" . $this->proses["PETUGAS_UBAH"] . "' ";
                    if  ($this->kode_alurkerja == 2 || $this->kode_alurkerja == 3) {
                        $sql .= ", ".$this->proses["KODE_HARGA"]."";
                    }
                    
                    $sql .= ", ".$this->proses["KODE_ALURKERJA"]."   )  ";
                    
                    $this->arr_sql[1] = $sql;
                }
           
        
        return  $sql;
    }
    
    function execQueryTender() {
        $this->load->model('Nomorurut','urut');
         
        $urut = $this->urut->get("ALL","KOMENTARTENDER");
        $this->proses["KODE_KOMENTAR"] = $urut;
        
         $this->getQueryTender();
        echo "debug" . $this->debug ;
        if ($this->debug) {
                       print_r($this->proses);  
                       echo $this->arr_sql[0];
                        
                       echo $this->arr_sql[1];
                       if (isset($this->arr_sql[2])) echo  $this->arr_sql[2];
                       
         } else {
           // echo  $this->arr_sql[0] . "<br/>";
           // echo  $this->arr_sql[0] ;
             
           //  print_r($this->arr_sql );
             
          
             
            if (strlen($this->arr_sql[0]) > 10) {
                        if($this->db->simple_query($this->arr_sql[0])) {
                            
                            if ($this->proses["TIPE"] == 'AWAL' || $this->proses["TIPE"] == 'AWAL_DAN_AKHIR' ) {
                                $this->urut->set_plus( "ALL","KOMENTARTENDER") ;
                            }
                        } 
             }
             
              if ($this->db->simple_query($this->arr_sql[1]))    {  

                            $this->urut->set_plus( "ALL","KOMENTARTENDER") ;
                     
                             echo "SUCCESS";
              } 
         
              if (isset( $this->arr_sql[2]) ) {
                  
                  if ($this->db->simple_query($this->arr_sql[2])) {
                      
                      echo "SUCCESS";;
                  }
              }    
               
         }
        
    }            
    
    function execQuery() {
        $this->load->model('Nomorurut','urut');
         
                $urut = $this->urut->get("ALL","KOMENTARKOM");
                $this->proses["KODE_KOMENTAR"] = $urut;
                if ($this->debug) {
                       print_r($this->proses); 
                        $this->getQuery(); 
                       echo $this->arr_sql[0];
                        
                       echo $this->arr_sql[1];
                       
                } else {
                    $sql = $this->getQuery();
                    
                    if (strlen($this->arr_sql[0]) > 10) {
                        $this->db->simple_query($this->arr_sql[0]);
                    }
                    if ($this->db->simple_query($this->arr_sql[1]))    {  

                            $this->urut->set_plus( "ALL","KOMENTARKOM") ;
                     
                             echo "SUCCESS";
                     } else {
                         
                         echo  $sql;
                     }
                   
                }
          
        
        
         
         
    }
    
}

?>
