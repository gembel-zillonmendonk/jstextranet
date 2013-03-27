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
class Pengadaan_monitor extends MY_Controller
{
    public $rules;
    public $where;

    public function __construct()
    {
        parent::__construct();
       // $this->session->set_userdata('kode_vendor', '512');
    }
    
    function header(){
         $sql = "SELECT T.KODE_TENDER, T.JUDUL_PEKERJAAN, T.LINGKUP_PEKERJAAN, T.TIPE_KONTRAK, T.NAMA_PERENCANA, T.MATA_UANG, K.NAMA_KANTOR  ";
                $sql .= " FROM EP_PGD_TENDER T ";
                $sql .= " LEFT JOIN MS_KANTOR K ON T.KODE_KANTOR = K.KODE_KANTOR";
                
                $sql .= " WHERE T.KODE_TENDER = '" .$this->input->get("KODE_TENDER"). "' ";
                $sql .= " AND T.KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
                
                $query = $this->db->query($sql);
                $result = $query->result();
                $data["judul_pekerjaan"] = "";
                $data["lingkup_pekerjaan"] = "";
                $data["tipe_kontrak"] = "";
                $data["nama_perencana"] = "";
                $data["kode_tender"] = "";
                $data["nama_kantor"] = "";
                $data["mata_uang"] = "";
                
                if (count($result)) {
                    $data["judul_pekerjaan"] = $result[0]->JUDUL_PEKERJAAN; 
                    $data["lingkup_pekerjaan"] = $result[0]->LINGKUP_PEKERJAAN; 
                    $data["tipe_kontrak"] = $result[0]->TIPE_KONTRAK; 
                    $data["nama_perencana"] = $result[0]->NAMA_PERENCANA; 
                    $data["kode_tender"] = $result[0]->KODE_TENDER; 
                    $data["nama_kantor"] = $result[0]->NAMA_KANTOR;
                    $data["mata_uang"] = $result[0]->MATA_UANG;
                    
                }
                
                
                
		$this->load->view("pengadaan/pengadaan_monitor_header", $data);        
        
    }
    
    
        function metode_jadwal() {
            $sql = "SELECT P.METODE_TENDER,M.NAMA_METODE_TENDER,  P.METODE_SAMPUL, S.NAMA_METODE_SAMPUL , P.KODE_EVALUASI, P.KETERANGAN_EVALUASI ";
            $sql .= " , P.TGL_PEMBUKAAN_REG, P.TGL_PENUTUPAN_REG, P.TGL_PRE_LELANG, P.LOKASI_PRE_LELANG, P.TGL_PEMBUKAAN_LELANG, P.PTP_INQUIRY_NOTES ";
            $sql .= " , K.NAMA_KANTOR, P.TGL_MULAI_PENAWARAN";
            $sql .= " FROM EP_PGD_PERSIAPAN_TENDER P "; 
            $sql .= " LEFT JOIN EP_PGD_METODE M ON P.METODE_TENDER = M.METODE_TENDER ";
            $sql .= " LEFT JOIN EP_PGD_SAMPUL S ON P.METODE_SAMPUL = S.METODE_SAMPUL ";
            $sql .= " LEFT JOIN EP_PGD_EVALUASI_MODEL E ON P.KODE_EVALUASI = E.KODE_EVALUASI ";
            $sql .= " LEFT JOIN EP_PGD_EVALUASI_TIPE TE ON E.KODE_TIPE = TE.KODE_TIPE ";
            $sql .= " LEFT JOIN MS_KANTOR K ON P.KODE_KANTOR_KIRIM = K.KODE_KANTOR ";
            
            $sql .= " WHERE P.KODE_TENDER = '" .$this->input->get("KODE_TENDER"). "' ";
            $sql .= " AND P.KODE_KANTOR = '" .$this->input->get("KODE_KANTOR"). "' ";
                
            $data["nama_metode_tender"] = "";
            $data["nama_metode_sampul"] = "";
            $data["metode_evaluasi"] = "";
            $data["template_evaluasi"] = "";
            $data["keterangan_tambahan"] = "";
            
            $data["tgl_pembukaan_reg"] = "";
            $data["tgl_penutupan_reg"] = "";
            $data["tgl_pre_lelang"] = "";
            $data["lokasi_pre_lelang"] = "";
            $data["tgl_pembukaan_lelang"] = "";
            $data["tgl_mulai_penawaran"] = "";
            $data["lokasi_kirim"] = "";
            

            $query = $this->db->query($sql);
            $result = $query->result();
            
            if (count($result)) {
                $data["nama_metode_tender"] = $result[0]->NAMA_METODE_TENDER;
                $data["nama_metode_sampul"] = $result[0]->NAMA_METODE_SAMPUL;
                $data["metode_evaluasi"] = "";
                $data["template_evaluasi"] = $result[0]->KETERANGAN_EVALUASI;
                $data["keterangan_tambahan"] = $result[0]->PTP_INQUIRY_NOTES;
                $data["tgl_pembukaan_reg"] = $result[0]->TGL_PEMBUKAAN_REG;
                $data["tgl_penutupan_reg"] = $result[0]->TGL_PENUTUPAN_REG;
                $data["tgl_pre_lelang"] = $result[0]->TGL_PRE_LELANG;
                $data["lokasi_pre_lelang"] = $result[0]->LOKASI_PRE_LELANG;
                $data["tgl_pembukaan_lelang"] = $result[0]->TGL_PEMBUKAAN_LELANG;
                $data["tgl_mulai_penawaran"] = $result[0]->TGL_MULAI_PENAWARAN;
                $data["lokasi_kirim"] = $result[0]->NAMA_KANTOR;
                
            }
            
                
                
             $this->load->view("pengadaan/pengadaan_monitor_metode_jadwal", $data);         
                 
            
        }
	
    
}
?>
