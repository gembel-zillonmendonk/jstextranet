<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author farid
 */
class Ep_pgd_tender_sanggahan extends MY_Model
{
    public $table = "EP_PGD_TENDER_SANGGAHAN";
    public $elements_conf = array(
        
        'KODE_TENDER' => array(
            'label' => 'NOMOR PENGADAAN',
            'type' => 'dropdown',
        ),
        'KODE_KANTOR' => array(
            'type' => 'hidden',
        ),
        'JUDUL',
        'SUBSTANSI',
        'BUKTI'=> array(
            'label' => 'BUKTI PENDUKUNG',
            'type' => 'textarea',
        ),
        'LAMPIRAN_PENDUKUNG',
        'JAM_MATA_UANG',
        'JAM_NILAI',
        'JAM_BANK',
        'JAM_NOMOR',
        'JAM_TGL_MULAI',
        'JAM_TGL_BERAKHIR',
//  'DISETUJUI_OLEH',
//  'STATUS',
//  'NO_JAWABAN',
//  'JUDUL_JAWABAN',
//  'ISI_JAWABAN',
//  'FILE_JAWABAN',
//  'TANGGAL_DIBUAT',
//  'TANGGAL_DITUTUP',
    );
    public $validation = array(
        'KODE_TENDER' => array('required' => true),
        'JUDUL' => array('required' => true),
        'SUBSTANSI' => array('required' => true),
         'BUKTI' => array('required' => true),
        'LAMPIRAN_PENDUKUNG' => array('required' => true),
        'JAM_MATA_UANG' => array('required' => true),
        'JAM_NILAI' => array('required' => true),
        'BANK' => array('required' => true),
        'NO_REFERENSI' => array('required' => true),
        'TANGGAL_MULAI' => array('required' => true),
        'TANGGAL_SELESAI' => array('required' => true),
        'JUMLAH' => array('required' => true),
    );

    //public $form_view = 'pengadaan/form_penawaran';

    function __construct()
    {
        parent::__construct();
        $this->init();

        // set default value here
        $CI = & get_instance();
        $this->attributes['KODE_VENDOR'] = $CI->session->userdata('kode_vendor');
        
        // get selected value 
        $query = $this->db->query('SELECT T.KODE_TENDER, T.KODE_KANTOR, T.JUDUL_PEKERJAAN 
            FROM EP_PGD_TENDER T
            INNER JOIN EP_PGD_TENDER_VENDOR_STATUS S ON T.KODE_TENDER = S.KODE_TENDER AND T.KODE_KANTOR = S.KODE_KANTOR
            LEFT JOIN  (
                SELECT DISTINCT KODE_TENDER, KODE_KANTOR FROM EP_PGD_KOMENTAR_TENDER WHERE KODE_AKTIFITAS IN
                (1406, 1407, 1408, 1409, 1410, 1510, 1511, 1512, 1513, 1514, 1609, 1610,1611, 1612, 1613, 1705, 1706,1707,1708,1709) 
                AND TGL_BERAKHIR IS NULL ) K ON T.KODE_TENDER = K.KODE_TENDER AND T.KODE_KANTOR = K.KODE_KANTOR
            
        WHERE   S.KODE_VENDOR = ' . $this->attributes['KODE_VENDOR']);
        
        
        $rows = $query->result_array();
        
        $this->elements_conf['KODE_TENDER']['options'] = array();
        foreach ($rows as $v)
        {
            $this->elements_conf['KODE_TENDER']['options'][$v['KODE_TENDER']] = $v['KODE_TENDER'];
            $this->attributes['KODE_KANTOR'] =  $v['KODE_KANTOR'];
        }
    }

}
?>
