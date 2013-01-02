<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends MY_Controller
{ 
    public function __construct()
    {
        parent::__construct();
       // $this->session->set_userdata('kode_vendor', '512');
    }
    
    function index() {
         $this->session->userdata('kode_vendor');   
         
         // Undangan Pengadaan
         
         $sql = "SELECT KODE_TENDER, KODE_KANTOR ";
         $sql .= " FROM VW_PGD_PEKERJAAN_VENDOR ";
         $sql .= " WHERE KODE_VENDOR =  " . $this->session->userdata('kode_vendor');   
         $sql .= " AND PTVS_STATUS = 1";   
         
          
         $query = $this->db->query($sql);
         $result = $query->result(); 
          
         $data["cnt_undangan"] = count($result);
         
         $sql = "SELECT KODE_TENDER, KODE_KANTOR ";
         $sql .= " FROM EP_PGD_TENDER_VENDOR_STATUS ";
         $sql .= " WHERE KODE_VENDOR =  " . $this->session->userdata('kode_vendor');   
         $sql .= " AND STATUS in  (2,20) ";   
         
         $query = $this->db->query($sql);
         $result = $query->result(); 
         $data["cnt_tunggu_penawaran"] = count($result);
         
         
         $sql = "SELECT KODE_TENDER, KODE_KANTOR ";
         $sql .= " FROM EP_PGD_TENDER_VENDOR_STATUS ";
         $sql .= " WHERE KODE_VENDOR =  " . $this->session->userdata('kode_vendor');   
         $sql .= " AND STATUS in  (3,21) ";   
         
         $query = $this->db->query($sql);
         $result = $query->result(); 
         $data["cnt_sudah_kirim_penawaran"] = count($result);
         
         
         $sql = "SELECT KODE_TENDER, KODE_KANTOR ";
         $sql .= " FROM EP_PGD_TENDER_VENDOR_STATUS ";
         $sql .= " WHERE KODE_VENDOR =  " . $this->session->userdata('kode_vendor');   
         $sql .= " AND STATUS in  (11) ";   
         
         $query = $this->db->query($sql);
         $result = $query->result(); 
         $data["cnt_award"] = count($result);
         
         
         $sql = "SELECT KODE_TENDER, KODE_KANTOR ";
         $sql .= " FROM EP_PGD_TENDER_VENDOR_STATUS ";
         $sql .= " WHERE KODE_VENDOR =  " . $this->session->userdata('kode_vendor');   
         $sql .= " AND STATUS in  (10) ";   
         
         $query = $this->db->query($sql);
         $result = $query->result(); 
         $data["cnt_negosiasi"] = count($result);
         
         
         
         $this->layout->view('home', $data);
    }
    
    
}
