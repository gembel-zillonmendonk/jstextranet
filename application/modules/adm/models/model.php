<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author FM
 */
class Model extends MY_Model {

    function __construct($table) {
        parent::__construct();
        $this->table = $table;
        $this->init();
    }

}

?>
