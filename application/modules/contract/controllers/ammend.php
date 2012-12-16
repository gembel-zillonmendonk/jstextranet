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
class ammend extends MY_Controller
{
    public function create_draft(){
        
        if($this->_is_ajax_request())
            $this->load->view('ammend/draft');
        else
            $this->layout->view('ammend/draft');
    }
    
    public function compare(){
        
        if($this->_is_ajax_request())
            $this->load->view('ammend/compare');
        else
            $this->layout->view('ammend/compare');
    }
    
    public function detail(){        
        if($this->_is_ajax_request())
            $this->load->view('ammend/detail');
        else
            $this->layout->view('ammend/detail');
    }
    
    public function todo(){
        $this->layout->view('ammend/todo');
    }
    
    public function monitoring(){
        $this->layout->view('ammend/monitoring');
    }
}
?>
