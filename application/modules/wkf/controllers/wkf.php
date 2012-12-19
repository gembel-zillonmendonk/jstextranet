<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wkf extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->library('workflow');

        $active = $this->workflow->getActiveInstances();
        $finish = $this->workflow->getEndInstances();
        $this->layout->view('list', array(
            'active' => $active,
            'finish' => $finish,
        ));
    }

    public function start() {
        $this->load->library('workflow');
        $kode_wkf = isset($_REQUEST['kode_wkf']) ? $_REQUEST['kode_wkf'] : 1;
        $kode_transisi = isset($_REQUEST['kode_transisi']) ? $_REQUEST['kode_transisi'] : false;
        $catatan = isset($_REQUEST['catatan']) ? $_REQUEST['catatan'] : false;

        if ($_POST) {

            $kode_proses = $this->workflow->start($kode_wkf, $kode_transisi, $catatan);

            $referer_url = isset($_REQUEST['referer_url']) ? $_REQUEST['referer_url'] : $_SERVER['HTTP_REFERER'];

            redirect($referer_url);
        }

        // get start node
        $query = $this->db->query("select kode_wkf, kode_aktifitas, kode_posisi, kode_user, kode_aplikasi, parameter, tipe from EP_WKF_AKTIFITAS where kode_wkf = $kode_wkf and is_mulai = 1");
        $node = $query->row_array();

        // get available transition
        $transitions = $this->workflow->getTransition($node['KODE_AKTIFITAS']);

        // build parameters if exists
        $parameters = array();
        foreach ($transitions as $v) {
            $node = $this->workflow->getNodeById($v['AKTIFITAS_ASAL']);
            $parameters = $parameters + (array) json_decode($node['PARAMETER'], true);
        }

        // get available constraints & replace @@parameter for execution
        $variable = array();
        foreach ($_REQUEST as $k => $v) {
            $variable[] = array('KEY' => $k, 'VALUE' => rawurlencode($v));
        }
        $constraints = $this->workflow->getConstraintForExecution(0, $node['KODE_AKTIFITAS'], 'onload', $variable);

//        echo $node['KODE_AKTIFITAS'];
//        print_r($variable);
//        print_r($constraints);

        $this->layout->view('start', array(
            'kode_wkf' => $kode_wkf,
            'transitions' => $transitions,
            'parameters' => $parameters,
            'constraints' => $constraints,
        ));
    }

    public function run() {
        $this->load->library('workflow');

        $kode_proses = isset($_REQUEST['kode_proses']) ? $_REQUEST['kode_proses'] : null;
        if (!isset($kode_proses)) {
            $wkf_id = isset($_REQUEST['kode_wkf']) ? $_REQUEST['kode_wkf'] : 1;
            $kode_proses = $this->workflow->start($wkf_id);
            //redirect('/wkf/index');
        }

        if ($_POST) {
            $kode_transisi = $_REQUEST['kode_transisi'];
            $catatan = isset($_REQUEST['catatan']) ? $_REQUEST['catatan'] : null;
            $user = isset($_REQUEST['user']) ? $_REQUEST['user'] : ($this->session->userdata("user_id"));
            $this->workflow->executeNode($kode_proses, $kode_transisi, $catatan, $user);

            $referer_url = isset($_REQUEST['referer_url']) ? $_REQUEST['referer_url'] : $_SERVER['HTTP_REFERER'];

            redirect($referer_url);
            //redirect('/wkf/index');
        }

        // load workflow instance
        $instance = $this->workflow->getInstance($kode_proses);
        // load workflow instance
        $history = $this->workflow->getHistory($kode_proses);
        // load workflow variable
        $variables = $this->workflow->getParamfromDB($kode_proses);

        // merge variable from db and $_REQUEST
        $variable = array();
        foreach ($_REQUEST as $k => $v) {
            $variable[] = array('KEY' => $k, 'VALUE' => rawurlencode($v));
        }
        $variables = array_merge($variables, $variable);

        // get available transition
        $transitions = $this->workflow->getTransition($instance['KODE_AKTIFITAS']);

        // get available constraints & replace @@parameter for execution
        $constraints = $this->workflow->getConstraintForExecution($kode_proses, $instance['KODE_AKTIFITAS'], 'onload', $variables);

        // build parameters if exists
        $parameters = array();
        foreach ($transitions as $v) {
            $node = $this->workflow->getNodeById($v['AKTIFITAS_ASAL']);
            $parameters = $parameters + (array) json_decode($node['PARAMETER'], true);
        }

        if ($this->_is_ajax_request())
            $this->load->view('run', array(
                'instance' => $instance,
                'history' => $history,
                'transitions' => $transitions,
                'parameters' => $parameters,
                'constraints' => $constraints,
            ));
        else
            $this->layout->view('run', array(
                'instance' => $instance,
                'history' => $history,
                'transitions' => $transitions,
                'parameters' => $parameters,
                'constraints' => $constraints,
            ));
    }

    public function list_history() {
        $this->load->library('workflow');

        $kode_proses = isset($_REQUEST['kode_proses']) ? $_REQUEST['kode_proses'] : null;
        $kode_proses = isset($_REQUEST['KODE_PROSES']) ? $_REQUEST['KODE_PROSES'] : $kode_proses;
        $history = $this->workflow->getHistory($kode_proses);
        
        if ($this->_is_ajax_request())
            $this->load->view('list_history', array(
                'history' => $history,
            ));
        else
            $this->layout->view('list_history', array(
                'history' => $history,
            ));
    }
    
    public function graph() {

        $this->load->library('workflowGraphViz');

//        $node = array(
//            array('from' => 'Start', 'to' => 'Persetujuan Registrasi'),
//            array('from' => 'Persetujuan Registrasi', 'to' => 'Approve'),
//            array('from' => 'Persetujuan Registrasi', 'to' => 'Reject'),
//            array('from' => 'Persetujuan Registrasi', 'to' => 'Perbaikan data'),
//        );
//
//        $sql = "
//            select * from (
//                select decode(b.nama_aktifitas, 'Start', b.nama_aktifitas, b.kode_aktifitas || '-' || b.nama_aktifitas) as \"from\"
//                    , decode(c.nama_aktifitas, 'Finish', c.nama_aktifitas, c.kode_aktifitas || '-' || c.nama_aktifitas) as \"to\"
//                    , c.tipe as \"tipe\"
//                    , a.kode_transisi || '-' || a.nama_transisi as \"label\" 
//                    , url as \"url\"
//                from ep_wkf_transisi a
//                inner join ep_wkf_aktifitas b on a.aktifitas_asal = b.kode_aktifitas
//                inner join ep_wkf_aktifitas c on a.aktifitas_tujuan = c.kode_aktifitas
//                left join (
//                    select rtrim(xmlagg(xmlelement(e, '&' || tipe || '=' || konteks )).extract('//text()').extract('//text()') ,',') url, kode_transisi
//                    from ep_wkf_transisi_const
//                    group by kode_transisi
//                ) x on x.kode_transisi = a.kode_transisi
//                where kode_wkf='" . $_REQUEST['kode_wkf'] . "'
//            )";

        $sql = "select * from ep_wkf where kode_wkf = '" . $_REQUEST['kode_wkf'] . "'";
        $row = $this->db->query($sql)->row_array();

        $config = array(
//            'Start' => array('shape' => 'doublecircle', 'fontcolor' => 'red', 'fontsize' => '8.0'),
//            'Finish' => array('shape' => 'doublecircle', 'style' => 'filled', 'fontcolor' => 'red', 'fontsize' => '8.0'),
            'node' => array('shape' => 'box', 'fontcolor' => 'blue', 'fontsize' => '9.0', 'fixedsize' => 'false'),
            'edge' => array('fontcolor' => 'black', 'fontsize' => '7.0'),
            'graph' => array('splines' => 'polyline', 'label' => $row['NAMA'], 'rankdir' => 'TB', 'ratio'=>'auto'),
        );

        $sql = "select a.kode_aktifitas, a.nama_aktifitas, a.tipe, a.is_mulai, a.is_akhir
            from ep_wkf_aktifitas a
            left join ep_wkf_aktifitas_const b on a.kode_aktifitas = b.kode_aktifitas
            where a.kode_wkf = '" . $_REQUEST['kode_wkf'] . "'";

        $rows = $this->db->query($sql)->result_array();

        foreach ($rows as $k => $v) {
            $config[$v['KODE_AKTIFITAS']] = array(
                'label' => $v['KODE_AKTIFITAS'] . "\n" . $v['NAMA_AKTIFITAS']
                , 'shape' => ($v['IS_MULAI'] == 1 ? 'doublecircle' : ($v['IS_AKHIR'] == 1 ? 'circle' : ($v['TIPE'] == 'system' ? 'diamond' : 'box')))
                , 'fontcolor' => 'blue'
                , 'fontsize' => '8.0'
                , 'fixedsize' => 'false'
            );
        }

        $sql = "
            select * from (
                select b.kode_aktifitas as \"from\"
                    , c.kode_aktifitas as \"to\"
                    , c.tipe as \"tipe\"
                    , a.kode_transisi || '-' || a.nama_transisi as \"label\" 
                    , url as \"url\"
                    , a.kondisi as \"kondisi\"
                from ep_wkf_transisi a
                inner join ep_wkf_aktifitas b on a.aktifitas_asal = b.kode_aktifitas
                inner join ep_wkf_aktifitas c on a.aktifitas_tujuan = c.kode_aktifitas
                left join (
                    select rtrim(xmlagg(xmlelement(e, '&' || tipe || '=' || konteks )).extract('//text()').extract('//text()') ,',') url, kode_transisi
                    from ep_wkf_transisi_const
                    group by kode_transisi
                ) x on x.kode_transisi = a.kode_transisi
                where kode_wkf='" . $_REQUEST['kode_wkf'] . "'
            )";

        $query = $this->db->query($sql);
        $node = $query->result_array();


//echo "<pre>";
//print_r($node);
//die();
        $data = array('node' => $node, 'config' => $config);
        $this->workflowgraphviz->image($data);
    }

    public function _is_ajax_request() {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */