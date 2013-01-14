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
class top extends MY_Controller
{
    public function list_todo(){
        if($this->_is_ajax_request())
            $this->load->view('top/list_todo');
        else
            $this->layout->view('top/list_todo');
    }
    
    public function create_draft(){
        
        if($this->_is_ajax_request())
            $this->load->view('top/draft');
        else
            $this->layout->view('top/draft');
    }
    
    public function detail(){        
        if($this->_is_ajax_request())
            $this->load->view('top/detail');
        else
            $this->layout->view('top/detail');
    }
    
    public function todo(){
        $this->layout->view('top/todo');
    }
    
    public function monitoring(){
        $this->layout->view('top/monitoring');
    }
}
?>
