<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerjaan_pgd extends MY_Controller {
 	
	function __construct()
    {
        parent::__construct(); 
	}
	
	function index(){
		 $this->layout->view("pekerjaan_pgd_list");
	}
	
        function editor(){
              $kode_aktifitas = 0;
              $sql = "SELECT KODE_AKTIFITAS, KODE_TENDER, KODE_KANTOR ";
              $sql .= "FROM EP_PGD_KOMENTAR_TENDER ";
              $sql .= "WHERE KODE_KOMENTAR =  " . $this->input->get("KODE_KOMENTAR") ;
                $query = $this->db->query($sql);
                $result = $query->result(); 

                if (count($result))  {
                    $kode_aktifitas = $result[0]->KODE_AKTIFITAS;
                    $data["kode_aktifitas"] = $result[0]->KODE_AKTIFITAS;
                    $data["kode_komentar"] =$this->input->get("KODE_KOMENTAR");
                    
                    $data["kode_tender"] = $result[0]->KODE_TENDER;
                    $data["kode_kantor"] = $result[0]->KODE_KANTOR;
                    
                  
                } 
              
              $sql = "SELECT KODE_PERENCANAAN,   KODE_KANTOR_PERENCANAAN ";
              $sql .= "FROM EP_PGD_TENDER ";
              $sql .= " WHERE KODE_TENDER =  " . $data["kode_tender"] ;
              $sql .= " AND KODE_KANTOR =  '" . $data["kode_kantor"] . "' " ;
              
                $query = $this->db->query($sql);
                $result = $query->result(); 

                if (count($result))  {
                    
                     $data["kode_perencanaan"] = $result[0]->KODE_PERENCANAAN;
                    $data["kode_kantor_perencanaan"] = $result[0]->KODE_KANTOR_PERENCANAAN;
                    
                  
                }   
                
            
              $this->load->model('alurkerja','alur');
              $this->alur->mulai(5);
              $data["arr_antarmuka"] = $this->alur->getAntarMuka($kode_aktifitas);
              
           
            
               
             $this->layout->view("pengadaan_editor", $data);
             
            
        }
        
	 
}	