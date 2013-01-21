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
class vendor extends MY_Controller
{
    public $rules;
    public $where;

    public function __construct()
    {
        parent::__construct();
        //$this->session->set_userdata('user_id', '512');
        //$this->session->set_userdata('user_id', '7827400');

        $this->where = 'KODE_VENDOR = ' . $this->session->userdata('kode_vendor');
        $this->rules = array(
            '0' => array(// tabs-1
                array('model' => 'ep_vendor_perusahaan', 'label' => 'NAMA PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_alamat', 'label' => 'KONTAK PERUSAHAAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_kontak_person', 'label' => 'KONTAK PERSON', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_jamsostek', 'label' => 'KEPESERTAAN JAMSOSTEK', 'rules' => 'required', 'where' => $this->where),
            ),
            '1' => array(// tabs-2
                array('model' => 'ep_vendor_akta', 'label' => 'AKTA PENDIRIAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_domisili', 'label' => 'DOMISILI PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_npwp', 'label' => 'NPWP', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_mitra', 'label' => 'JENIS MITRA KERJA', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_siup', 'label' => 'SIUP', 'rules' => 'hasOne', 'where' => $this->where),
                //array('model' => 'ep_vendor_ijin', 'label' => 'IJIN LAIN-LAIN (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_tdp', 'label' => 'TDP', 'rules' => 'required', 'where' => $this->where),
            //array('model' => 'ep_vendor_agen', 'label' => 'SURAT KEAGENAN/DISTRIBUTORSHIP (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where . " AND TIPE = 'AGEN'"),
            //array('model' => 'ep_vendor_importir', 'label' => 'ANGKA PENGENAL IMPORTIR (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where . " AND TIPE = 'IMPORTIR'"),
            ),
            '2' => array(// tabs-3
                array('model' => 'ep_vendor_komisaris', 'label' => 'DEWAN KOMISARIS', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_direksi', 'label' => 'DEWAN DIREKSI', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '3' => array(// tabs-4
                array('model' => 'ep_vendor_bank', 'label' => 'REKENING BANK', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_modal', 'label' => 'MODAL SESUAI DENGAN AKTA TERAKHIR', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_laporan_keuangan', 'label' => 'INFORMASI LAPORAN KEUANGAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_klasifikasi', 'label' => 'KLASIFIKASI PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
            ),
            '4' => array(// tabs-5
                array('model' => 'ep_vendor_barang', 'label' => 'BARANG YANG BISA DIPASOK', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_jasa', 'label' => 'JASA YANG BISA DIPASOK', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '5' => array(// tabs-6
                array('model' => 'ep_vendor_tenaga_utama', 'label' => 'TENAGA AHLI UTAMA', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'ep_vendor_tenaga_pendukung', 'label' => 'TENAGA AHLI PENDUKUNG', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '6' => array(// tabs-7
//                array('model' => 'ep_vendor_sertifikat', 'label' => 'KETERANGAN SERTIFIKAT', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '7' => array(// tabs-8
                array('model' => 'ep_vendor_peralatan', 'label' => 'KETERANGAN TENTANG FASILITAS / PERALATAN', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '9' => array(// tabs-10
                array('model' => 'ep_vendor_principal', 'label' => 'PRINCIPAL', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_subkontraktor', 'label' => 'SUBKONTRAKTOR', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'ep_vendor_afiliasi', 'label' => 'PERUSAHAAN AFILIASI', 'rules' => 'required', 'where' => $this->where),
            ),
        );
    }

    public function view()
    {
        $this->layout->view('vendor/view');
    }

    public function update()
    {
        $is_success = '';
        $kode_vendor = $this->session->userdata('kode_vendor');
        $param = array(
            array('name' => ':p1', 'value' => $kode_vendor, 'length' => -1, 'type' => SQLT_INT),
//           array('name'=>':a2', 'value'=>&$is_success),
        );
//        $this->db->stored_procedure('EP', 'PROC_EP_VENDOR_COPY_TO_TEMP', $param);

        // cek if proses update vendor exists
        $sql = "select * 
                from ep_wkf_proses a
                where kode_wkf = 51
                and parameter = '{\"KODE_VENDOR\":\"". $this->session->userdata('kode_vendor') ."\"}'
                and tanggal_selesai is null";
        
        $row = $this->db->query($sql)->row_array();
        if(count($row) > 0){
            show_error("Anda sedang dalam persetujuan update profile, harap tunggu sampai proses selesai");
        }
        
        $this->db->query("
            begin
                PROC_EP_VENDOR_COPY_TO_TEMP(" . $this->session->userdata('kode_vendor') . "); 
            end;", FALSE, FALSE);
        
        $this->layout->view('vendor/update');
    }

    public function monitor_update()
    {
        $this->layout->view('vendor/monitor_update');
    }
    public function validate_before_update()
    {
        $this->rules = array(
            '0' => array(// tabs-1
                array('model' => 'temp.ep_vendor_temp_perusahaan', 'label' => 'NAMA PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_alamat', 'label' => 'KONTAK PERUSAHAAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_kontak_person', 'label' => 'KONTAK PERSON', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_jamsostek', 'label' => 'KEPESERTAAN JAMSOSTEK', 'rules' => 'required', 'where' => $this->where),
            ),
            '1' => array(// tabs-2
                array('model' => 'temp.ep_vendor_temp_akta', 'label' => 'AKTA PENDIRIAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_domisili', 'label' => 'DOMISILI PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_npwp', 'label' => 'NPWP', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_mitra', 'label' => 'JENIS MITRA KERJA', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_siup', 'label' => 'SIUP', 'rules' => 'hasOne', 'where' => $this->where),
                //array('model' => 'temp.ep_vendor_temp_ijin', 'label' => 'IJIN LAIN-LAIN (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_tdp', 'label' => 'TDP', 'rules' => 'required', 'where' => $this->where),
            //array('model' => 'temp.ep_vendor_temp_agen', 'label' => 'SURAT KEAGENAN/DISTRIBUTORSHIP (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where . " AND TIPE = 'AGEN'"),
            //array('model' => 'temp.ep_vendor_temp_importir', 'label' => 'ANGKA PENGENAL IMPORTIR (OPSIONAL)', 'rules' => 'hasOne', 'where' => $this->where . " AND TIPE = 'IMPORTIR'"),
            ),
            '2' => array(// tabs-3
                array('model' => 'temp.ep_vendor_temp_komisaris', 'label' => 'DEWAN KOMISARIS', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_direksi', 'label' => 'DEWAN DIREKSI', 'rules' => 'hasOne', 'where' => $this->where),
            ),
            '3' => array(// tabs-4
                array('model' => 'temp.ep_vendor_temp_bank', 'label' => 'REKENING BANK', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_modal', 'label' => 'MODAL SESUAI DENGAN AKTA TERAKHIR', 'rules' => 'required', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_laporan_keuangan', 'label' => 'INFORMASI LAPORAN KEUANGAN', 'rules' => 'hasOne', 'where' => $this->where),
                array('model' => 'temp.ep_vendor_temp_klasifikasi', 'label' => 'KLASIFIKASI PERUSAHAAN', 'rules' => 'required', 'where' => $this->where),
            ),
//            '4' => array(// tabs-5
//                array('model' => 'temp.ep_vendor_temp_barang', 'label' => 'BARANG YANG BISA DIPASOK', 'rules' => 'hasOne', 'where' => $this->where),
//                array('model' => 'temp.ep_vendor_temp_jasa', 'label' => 'JASA YANG BISA DIPASOK', 'rules' => 'hasOne', 'where' => $this->where),
//            ),
//            '5' => array(// tabs-6
//                array('model' => 'temp.ep_vendor_temp_tenaga_utama', 'label' => 'TENAGA AHLI UTAMA', 'rules' => 'hasOne', 'where' => $this->where),
//                array('model' => 'temp.ep_vendor_temp_tenaga_pendukung', 'label' => 'TENAGA AHLI PENDUKUNG', 'rules' => 'hasOne', 'where' => $this->where),
//            ),
//            '6' => array(// tabs-7
//                array('model' => 'temp.ep_vendor_temp_sertifikat', 'label' => 'KETERANGAN SERTIFIKAT', 'rules' => 'hasOne', 'where' => $this->where),
//            ),
//            '7' => array(// tabs-8
//                array('model' => 'temp.ep_vendor_temp_peralatan', 'label' => 'KETERANGAN TENTANG FASILITAS / PERALATAN', 'rules' => 'hasOne', 'where' => $this->where),
//            ),
//            '9' => array(// tabs-10
//                array('model' => 'temp.ep_vendor_temp_principal', 'label' => 'PRINCIPAL', 'rules' => 'required', 'where' => $this->where),
//                array('model' => 'temp.ep_vendor_temp_subkontraktor', 'label' => 'SUBKONTRAKTOR', 'rules' => 'required', 'where' => $this->where),
//                array('model' => 'temp.ep_vendor_temp_afiliasi', 'label' => 'PERUSAHAAN AFILIASI', 'rules' => 'required', 'where' => $this->where),
//            ),
        );

        foreach ($this->rules as $k => $v)
        {
            if ($return = $this->xvalidation($v))
            {
                echo json_encode($return);
                exit();
            }
        }
        exit();
    }

    public function create_or_edit()
    {
        if (isset($_REQUEST['KODE_VENDOR']))
            $this->session->set_userdata('user_id', $_REQUEST['KODE_VENDOR']);

        if ($this->_is_ajax_request())
            $this->load->view('vendor/create_or_edit');
        else
            $this->layout->view('vendor/create_or_edit');
    }

    /*
     * internal actions
     */

    public function todo()
    {
        $this->layout->view('vendor/todo');
    }

    public function checklist_doc()
    {
        if (isset($_REQUEST['KODE_VENDOR']))
            $this->session->set_userdata('user_id', $_REQUEST['KODE_VENDOR']);

        $this->session->set_userdata();

        if ($this->_is_ajax_request())
            $this->load->view('vendor/checklist_doc');
        else
            $this->layout->view('vendor/checklist_doc');
    }

    public function activation()
    {
        if (isset($_POST))
        {
            redirect('vendor/todo');
        }
        $this->layout->view('vendor/activation');
    }

    public function compare()
    {
        if (isset($_REQUEST['KODE_VENDOR']))
            $this->session->set_userdata('user_id', $_REQUEST['KODE_VENDOR']);

        if ($this->_is_ajax_request())
            $this->load->view('vendor/compare');
        else
            $this->layout->view('vendor/compare');
    }

    // for internal & external actions

    public function xvalidation($rules = array())
    {
        if (count($rules) == 0)
            return false;

        $ret = array('errors' => array());
        foreach ($rules as $v)
        {
            if (!isset($v['rules']))
                return false;

//            $obj = $this->_load_model($v['model']);
            $model = str_replace(".", "/", strtolower($v['model']));
            $this->load->model($model, $v['model']);
            $obj = $this->$v['model'];

//echo $obj->table.'<br>';
//print_r($this);
            if (!$obj)
                show_error("Model Not Found : " . $v['model']);
//            else
//                echo "<br/>Found : " . $v['model'];
//            continue;

            $err = true;
            $cnt = 0;
            if ($v['rules'] == 'required')
            {
                $fields = implode(',', array_keys($obj->validation, array('required' => true)));
                $this->where = '( ' . implode(' IS NOT NULL AND ', array_keys($obj->validation, array('required' => true))) . ' IS NOT NULL )';

                $this->where .= ' AND ' . $v['where'];
                $this->db->select($fields);
                $this->db->where($this->where);
                $this->db->from($obj->table);

                $cnt = $this->db->count_all_results();
                $err = $cnt > 0 ? false : true;
            }
            else
            {
                $filter = $v['where'];
                if (count($obj->attributes) > 0)
                {
                    foreach ($obj->attributes as $key => $value)
                    {
                        if (strlen($filter))
                            $filter .= " AND $key = '$value'";
                        else
                            $filter .= " $key = '$value'";
                    }
                }

                $this->db->where($filter);
                $this->db->from($obj->table);

                $cnt = $this->db->count_all_results();
                $err = $cnt > 0 ? false : true;
            }

//            echo $this->db->last_query() . ";\n";
//            echo $obj->table ."=".strtolower($v['model'])."\n";
//            unset($this->obj);
//            unset($obj);
//            echo $v['rules']."=".$cnt."xx";
            if ($err)
            {
//                echo $v['label'] . ' tidak boleh kosong';
                $ret['errors'][] = array('model' => get_class($obj), 'message' => $v['label'] . ' tidak boleh kosong');
            }
        }

        if (count($ret['errors']) > 0)
        {
//$this->session->set_flashdata($ret);
            return $ret;
        }

        return false;
    }

    public function view_data_vendor()
    {
        if (isset($_REQUEST['KODE_VENDOR']))
            $this->session->set_userdata('user_id', $_REQUEST['KODE_VENDOR']);

        if ($this->_is_ajax_request())
            $this->load->view('vendor/view_data_vendor');
        else
            $this->layout->view('vendor/view_data_vendor');
    }

    public function _view()
    {
        $this->load->view('vendor/_view');
    }

    public function _view_temp()
    {
        $this->load->view('vendor/_view_temp');
    }

    public function _editor()
    {
        $this->load->view('vendor/_editor');
    }

    public function start_wkf_registration()
    {
        
    }

    public function view_checklist_doc()
    {
        $this->load->view('vendor/view_checklist_doc');
    }
}
?>
