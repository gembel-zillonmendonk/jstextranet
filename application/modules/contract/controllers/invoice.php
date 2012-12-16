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
class invoice extends MY_Controller
{
    public $rules;
    public $where;

    public function create_draft(){
        if($this->_is_ajax_request())
            $this->load->view('contract/invoice/draft');
        else
            $this->layout->view('contract/invoice/draft');
    }
    
    public function detail(){        
        if($this->_is_ajax_request())
            $this->load->view('contract/invoice/detail');
        else
            $this->layout->view('contract/invoice/detail');
    }
    
    public function monitoring(){
        if($this->_is_ajax_request())
            $this->load->view('contract/invoice/monitoring');
        else
            $this->layout->view('contract/invoice/monitoring');
    }
    
    public function verification(){
        if($this->_is_ajax_request())
            $this->load->view('contract/invoice/verification');
        else
            $this->layout->view('contract/invoice/verification');
    }
    
    public function list_todo() {
        if($this->_is_ajax_request())
            $this->load->view('contract/invoice/list_todo');
        else
            $this->layout->view('contract/invoice/list_todo');
    }
}
?>
