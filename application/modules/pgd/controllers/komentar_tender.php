<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komentar_tender extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct();
		 
		$this->load->model('Nomorurut','urut');
                $this->load->model('alurkerja','alur');
                $this->alur->setDebug(0);
	}

	function add(){
		 
                 print_r($_POST);
                 
                
                 $this->alur->mulai($this->input->post("kode_alurkerja"));
                 
                 $this->alur->setKodeKomentar(0);
                 
                 if ($this->input->post("kode_transisi")==1001) {
                      $arr = array();
                        $arr["KODE_KOMENTAR"] =  $this->input->post("kode_komentar");
                         

                        $this->alur->setParamInitial($arr);
                 }
                 
                 
                 print_r($arr);
                 
                 $this->alur->setKomentar($this->input->post("komentar"));
                 $this->alur->setAttachment('attachment');
                 
                 $this->alur->getAktifitasKe($this->input->post("kode_transisi"));
                
                 
                 
                /*
		$urut = $this->urut->get("ALL","KOMENTARKOM");
		$kode_sub_barang = ($this->input->post("kode_sub_barang") ? $this->input->post("kode_sub_barang") : ""); 		
		
		$kode_harga = strlen($this->input->post("kode_harga")) == 0 ? 0 : $this->input->post("kode_harga")  ;
		
		$sql = "INSERT INTO EP_KOM_KOMENTAR (
				   KODE_KOMENTAR, KODE_HARGA, KODE_JASA_BARANG, KODE_SUB_BARANG, 
				   KODE_KANTOR, KODE_JABATAN, JABATAN, 
				   NAMA, KODE_AKTIFITAS, AKTIFITAS, 
				   KODE_ALURKERJA, TGL_MULAI, TGL_BERAKHIR, 
				   KODE_RESPON_TENDER, RESPON, KOMENTAR, 
				   ATTACHMENT, TGL_REKAM, PETUGAS_REKAM) ";				
		$sql .= " VALUES ( ".$urut.", " . $kode_harga  . ",  '" . $this->input->post("kode_jasa_barang"). "' , '".$kode_sub_barang."' 
				, '".$this->session->userdata("kode_kantor")."','" . $this->session->userdata("kode_jabatan") . "', '" . $this->session->userdata("nama_jabatan") . "', 
			   NULL,  8001 , 'INPUT HARGA', 1 , TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD'), NULL, 
			   NULL, NULL, NULL, 
			   NULL, TO_DATE('" . date("Y-m-d") . "','YYYY-MM-DD') , '" . $this->session->userdata("kode_user") . "' ) "; 
		
		echo $sql;
		if($this->db->simple_query($sql)) {
			$this->urut->set_plus( "ALL","KOMENTARKOM") ;
			echo "1";
		} else {
			echo "0";
		}
                */    
        }

	
	function update() {
		 print_r($_POST);
                  
                 $this->alur->mulai($this->input->post("kode_alurkerja"));
                 
                 
                 $this->alur->setKodeKomentar($this->input->post("kode_komentar"));
                 //if ($this->input->post("kode_transisi")==287) {
                        $arr = array();
                        $arr["KODE_KOMENTAR"] =  $this->input->post("kode_komentar");
                        $arr["KODE_TENDER"] =  $this->input->post("KODE_TENDER");
                         

                        $this->alur->setParamInitial($arr);
                 //}
              
                 $this->alur->setKomentar($this->input->post("komentar"));
                 $this->alur->setAttachment('attachment');
                 
                 $this->alur->getAktifitasKe($this->input->post("kode_transisi"));
                
                 
                
	
	}
        
        function edit() {
             
                         
                $data["kode_alurkerja"] = 5;
                $data["kode_komentar"] = $this->input->get("KODE_KOMENTAR");
                $data["kode_tender"] = $this->input->get("KODE_TENDER");
                $data["kode_kantor"] = $this->input->get("KODE_KANTOR");
                
                
                $kode_aktifitas = $this->input->get("KODE_AKTIFITAS");
                $data["rs_transisi"] = $this->alur->getTransisi($kode_aktifitas);
                
            
            $this->load->view("komentar_tender_edit", $data);
        }
        
	
	
}	
	