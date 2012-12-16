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
class po extends MY_Controller
{
    public $rules;
    public $where;

    public function update_progress(){
        
        if($this->_is_ajax_request())
            $this->load->view('po/update_progress');
        else
            $this->layout->view('po/update_progress');
    }
    
    public function update_bastp(){
        if($this->_is_ajax_request())
            $this->load->view('po/update_bastp');
        else
            $this->layout->view('po/update_bastp');
    }
    
    public function detail(){        
        if($this->_is_ajax_request())
            $this->load->view('po/detail');
        else
            $this->layout->view('po/detail');
    }
    
    public function list_todo(){
        if($this->_is_ajax_request())
            $this->load->view('po/list_todo');
        else
            $this->layout->view('po/list_todo');
    }
    
    public function todo(){
        $this->layout->view('po/todo');
    }
    
    public function monitoring(){
        $this->layout->view('po/monitoring');
    }
}
?>
