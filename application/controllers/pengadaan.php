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
       // $this->session->set_userdata('user_id', '512');
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
    
    function pendaftaran_add() {
        if($this->input->post("KODE_TENDER")) {
            
            $sql = "SELECT METODE_SAMPUL ";
            $sql .= " FROM EP_PGD_PERSIAPAN_TENDER ";
            $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
            $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
            
            $query = $this->db->query($sql);
            $result = $query->result();
            $pvts_status = 20;
            $metode_sampul = 0;
            if (count($result)) {
                $metode_sampul = $result[0]->METODE_SAMPUL; 
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
                $sql .= ", PETUGAS_UBAH = '" . $this->session->userdata("user_id") . "' ";    
                $sql .= " WHERE KODE_TENDER = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR =  " . $this->input->post("KODE_VENDOR")  ;

            } else {
                $sql = "INSERT INTO EP_PGD_TENDER_VENDOR_STATUS (KODE_TENDER, KODE_KANTOR, KODE_VENDOR, STATUS, TGL_REKAM, PETUGAS_REKAM)";
                $sql .= " VALUES ('" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " ,'" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " ," . $this->input->post("KODE_VENDOR")     ;
                $sql .= " ," . $this->input->post("PTVS_STATUS")     ;
                $sql .= ", TGL_UBAH = TO_DATE('" .  date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )   ";
                $sql .= ", PETUGAS_UBAH = '" . $this->session->userdata("user_id") . "' ";   

                
                
                
            }
            
            if ($this->db->simple_query($sql)) {
                echo 1;
            } else {
                echo "0"; // .$sql;
            }
            
            
            
            
             
            
        }
        
    }
    
    
    function pendaftaran() {
        
        
        $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
        $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
        $data["KODE_VENDOR"] = $this->session->userdata("user_id");
         
        
        
         
         $this->layout->view('pengadaan/pendaftaran', $data);
        
    }
    
    
    function pekerjaan() {
        $sql = "SELECT PTVS_STATUS ";
         $sql .= " FROM VW_PGD_PEKERJAAN_VENDOR ";
         $sql .= " WHERE KODE_VENDOR =  " . $this->session->userdata('kode_vendor');   
         $sql .= " AND KODE_TENDER  = '" . $this->input->get("KODE_TENDER") . "'";
         $sql .= " AND KODE_KANTOR = '" . $this->input->get("KODE_KANTOR") . "'";
              
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
                     
                     $this->penawaran();
                     break;
                  
                 
                 
             }
             
             
         }
        
        
        
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
             $sql .= " , PETUGAS_UBAH = '" . $this->session->userdata("user_id") . "'" ;
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
             $sql .= " ,'" . $this->session->userdata("user_id") . "')" ;
             
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
        $sql .= ", PETUGAS_UBAH = '" . $this->session->userdata("user_id") . "' ";    
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
            if ($row->KODE_VENDOR == $this->session->userdata("user_id")  ) {
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
                $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " SET KETERANGAN_VENDOR = '" . $_POST["KETERANGAN_VENDOR"][$i] . "'";
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $_POST["KETERANGAN"][$i] . "'";

                    if ($this->db->simple_query($sql)) {
                        echo 1;

                    } else {
                        echo 0;
                    }
                $i++;
            }
            
            
            exit();
        }
        
        
        if ($this->input->post("administrasi")) {
            
            // print_r($_POST);
            $i = 0;
            foreach($_POST["KETERANGAN"] as $k=>$v) {
                $sql = "UPDATE EP_PGD_PENAWARAN_TEKNIS ";
                $sql .= " SET VENDOR_CEK = " . $_POST["VENDOR_CEK"][$i];
                $sql .= " WHERE KODE_TENDER  = '" . $this->input->post("KODE_TENDER") . "'";
                $sql .= " AND KODE_KANTOR = '" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= " AND KODE_VENDOR = '" . $this->input->post("KODE_VENDOR") . "'";
                $sql .= " AND KETERANGAN = '" . $v . "'";

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
        $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("user_id") . " ";
        
        
         $query = $this->db->query($sql);
         $result = $query->result();
        
         
        
        $data["KODE_TENDER"] = $this->input->get("KODE_TENDER");
        $data["KODE_KANTOR"] = $this->input->get("KODE_KANTOR");
        $data["KODE_VENDOR"] = $this->session->userdata("user_id");
         
        
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
        $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("user_id") . " ";
        
        
        $query = $this->db->query($sql);
        $data["rsadm"] = $query->result();
       
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
                $sql .= " AND KODE_VENDOR =  " . $this->session->userdata("user_id") . " ";


                $query = $this->db->query($sql);
                $data["rsteknis"] = $query->result();
                
// echo $sql;
        
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
                $sql .= " AND  KODE_VENDOR =  " . $this->session->userdata("user_id") . "  ";
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
