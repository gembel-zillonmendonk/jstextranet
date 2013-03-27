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
class Lelang extends MX_Controller
{
     
    public function __construct()
    {
        parent::__construct();
       // $this->session->set_userdata('kode_vendor', '512');
    }
    
    function index() { 
          
        
         
        
        $sql = "SELECT T.KODE_TENDER, T.KODE_KANTOR, T.JUDUL_PEKERJAAN, P.TGL_PEMBUKAAN_REG, TGL_PENUTUPAN_REG
                FROM   EP_PGD_TENDER T
                INNER JOIN EP_PGD_KOMENTAR_TENDER K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
                INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
                WHERE (K.TGL_BERAKHIR IS NULL) AND (K.KODE_AKTIFITAS in (1411, 1502,   1711))
                AND P.TGL_PENUTUPAN_REG >= TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' ) ";
        if (strlen($this->input->post("cari"))) {
            $sql .= " AND  ". $this->input->post("kolom") . " like '%" . $this->input->post("cari") . "%'" ;
        }
        
        
        
        $query = $this->db->query($sql);
        $data["rslelang"] = $query->result();
        
        $data["cari"] =  $this->input->post("cari");
        $data["kolom"] =  $this->input->post("kolom");
        
        
         $sql = "SELECT T.KODE_TENDER, T.KODE_KANTOR, T.JUDUL_PEKERJAAN, P.TGL_PEMBUKAAN_REG, TGL_PENUTUPAN_REG, A.NAMA_AKTIFITAS 
                FROM   EP_PGD_TENDER T
                INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
                LEFT JOIN EP_ALURKERJA_AKTIFITAS A ON T.STATUS = A.KODE_AKTIFITAS 
                LEFT JOIN (SELECT T.KODE_TENDER, T.KODE_KANTOR 
                FROM   EP_PGD_TENDER T
                INNER JOIN EP_PGD_KOMENTAR_TENDER K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
                INNER JOIN EP_PGD_PERSIAPAN_TENDER P ON T.KODE_TENDER = P.KODE_TENDER AND T.KODE_KANTOR = P.KODE_KANTOR
                WHERE (K.TGL_BERAKHIR IS NULL) AND (K.KODE_AKTIFITAS in (1402, 1502, 1702))
                AND P.TGL_PENUTUPAN_REG >= TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS' )) X 
                    ON T.KODE_TENDER = X.KODE_TENDER AND T.KODE_KANTOR = X.KODE_KANTOR
                WHERE   P.METODE_TENDER = 2 
                AND X.KODE_TENDER IS NULL
                ";
        
          $query = $this->db->query($sql);
        $data["rslelanghis"] = $query->result();
        
         
        $this->load->view('pengadaan/daftar_lelang', $data);
    }
    
    
    public function grid($model = null)
    {
        // check and load model
        $model = $this->_load_model($model);
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
