<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengadaan extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();		  
	}

	function index() {
		$this->layout->view("pengadaan_list");
	}
	
        function add() {
                $this->load->model("opsi", "opsi");
                $data["arr_tipekontrak"] = $this->opsi->getTipeKontrak();
            
                $this->load->model('alurkerja','alur');
                        
                $this->alur->mulai(5);
                $data["kode_alurkerja"] = 5;
                $data["kode_komentar"] = 0;
                $data["rs_transisi"] = $this->alur->getTransisi(1001);
 
                
                
		$this->layout->view("pengadaan_add", $data);
	}
        
        function add_item_tender(){
            if ($this->input->post("KODE_BARANG_JASA")) {
                
                
              //  print_r($_POST);
                
                $sql = "INSERT INTO EP_PGD_ITEM_TENDER (
                    KODE_TENDER
                    , KODE_KANTOR
                    , KODE_BARANG_JASA
                    , KODE_SUB_BARANG_JASA
                    , KETERANGAN
                    , JUMLAH
                    , UNIT
                    , HARGA
                    , TGL_REKAM
                    , PETUGAS_REKAM ) ";
                $sql .= " VALUES (";
                $sql .= "'" . $this->input->post("KODE_TENDER") . "' ";
                $sql .= ",'" . $this->input->post("KODE_KANTOR") . "' ";
                $sql .= ",'" . $this->input->post("KODE_BARANG_JASA") . "' ";
                $sql .= ",'" . $this->input->post("KODE_SUB_BARANG_JASA") . "' ";
                $sql .= ",'" . $this->input->post("KETERANGAN") . "' ";
                $sql .= "," . str_replace(",","",$this->input->post("JUMLAH")) . "  ";
                $sql .= ",'" . $this->input->post("UNIT") . "' ";
                $sql .= "," . str_replace(",","",$this->input->post("HARGA")) . "  ";
                 $sql .= " ,   TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')  ";
                $sql .= ",'" . $this->session->userdata("kode_user") . "'";    
                $sql .= ")";
                 
               // echo $sql; 
                    if ($this->db->simple_query($sql)) {
                    echo "1"    ;
                     	
                
                    
                } else {
                    echo "0";
                    
                } 
                
                return;
                
            }
        }
        
        function add_tender(){
            if ($this->input->post("KODE_PERENCANAAN")) {
                
                 // print_r($_POST);
                 if ($this->input->post("KODE_TENDER") > 0 ) {
                     
                    echo  $this->input->post("KODE_TENDER");
                    return;
                 }
                
                
                
                
                $this->load->model('Nomorurut','urut');	 
                $urut = $this->urut->get($this->input->post("KODE_KANTOR"),"TENDER");	
                
                $sql = "INSERT INTO EP_PGD_TENDER (";
                $sql .= "KODE_TENDER";
                $sql .= ",KODE_KANTOR";
                $sql .= ",KODE_JAB_PEMOHON";
                $sql .= ",NAMA_PEMOHON";
                $sql .= ",JUDUL_PEKERJAAN";
                $sql .= ",LINGKUP_PEKERJAAN";
                $sql .= ",TIPE_KONTRAK";
                $sql .= ",KODE_PERENCANAAN";
                $sql .= ",KODE_KANTOR_PERENCANAAN";
                $sql .= ",  TGL_REKAM"; 
                $sql .= ", PETUGAS_REKAM";
                $sql .= ")";
                $sql .= "VALUES (";
                $sql .= $urut;
                $sql .= ",'" . $this->input->post("KODE_KANTOR") . "'";
                $sql .= ",'" . $this->input->post("KODE_JABATAN") . "'";
                $sql .= ",'" . $this->input->post("NAMA_JABATAN") . "'";
                $sql .= ",'" . $this->input->post("JUDUL_PEKERJAAN") . "'";
                $sql .= ",'" . $this->input->post("LINGKUP_PEKERJAAN") . "'";
                $sql .= ",'" . $this->input->post("TIPE_KONTRAK") . "'";
                $sql .= ",'" . $this->input->post("KODE_PERENCANAAN") . "'";
                $sql .= ",'" . $this->input->post("KODE_KANTOR_PERENCANAAN") . "'";
                $sql .= " ,   TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD')  ";
                $sql .= ",'" . $this->session->userdata("kode_user") . "'";    
                $sql .= ")";
               //  echo $sql;
                
                if ($this->db->simple_query($sql)) {
                    echo $urut   ;
                    $this->urut->set_plus( $this->input->post("KODE_KANTOR"),"TENDER");	
                
                    
                } else {
                    echo "0";
                    
                } 
                
                
                
                
                
             return;   
                
                
            }
        }
        
        
        function add_item() {
		$this->layout->view("pengadaan_add_item");
	}
        
	
}	