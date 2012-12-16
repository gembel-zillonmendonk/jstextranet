<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Loader
 *
 * @author farid
 */
 
 
/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {

    public function database($params = '', $return = FALSE, $active_record = NULL) {
        // Grab the super object
        $CI = & get_instance();

        // Do we even need to load the database class?
        if (class_exists('CI_DB') AND $return == FALSE AND $active_record == NULL AND isset($CI->db) AND is_object($CI->db)) {
            return FALSE;
        }

        require_once(BASEPATH . 'database/DB.php');

        // Load the DB class
        $db = & DB($params, $active_record);

        $my_driver = config_item('subclass_prefix') . 'DB_' . $db->dbdriver . '_driver';
        $my_driver_file = APPPATH . 'core/drivers/' . $db->dbdriver . '/' . $my_driver . EXT;

        if (file_exists($my_driver_file)) {
            require_once($my_driver_file);
            $db = new $my_driver(get_object_vars($db));
        }

        if ($return === TRUE) {
            return $db;
        }
        
        // Initialize the db variable.  Needed to prevent
        // reference errors with some configurations
        $CI->db = '';
        $CI->db = $db;
        
        //print_r($db->list_columns('EP_VENDOR'));
        /*
          if ($return === TRUE) {
          return DB($params, $active_record);
          }
         

        // Initialize the db variable.  Needed to prevent
        // reference errors with some configurations
        $CI->db = '';

        // Load the DB class
        $CI->db = & DB($params, $active_record);
         */
    }
/*
    public function model($model, $name = '', $db_conn = FALSE) {
        if (is_array($model)) {
            foreach ($model as $babe) {
                $this->model($babe);
            }
            return;
        }

        if ($model == '') {
            return;
        }

        $path = '';

        // Is the model in a sub-folder? If so, parse out the filename and path.
        if (($last_slash = strrpos($model, '/')) !== FALSE) {
            // The path is in front of the last slash
            $path = substr($model, 0, $last_slash + 1);

            // And the model name behind it
            $model = substr($model, $last_slash + 1);
        }

        if ($name == '') {
            $name = $model;
        }

        if (in_array($name, $this->_ci_models, TRUE)) {
            return;
        }

        $CI = & get_instance();
        if (isset($CI->$name)) {
            show_error('The model name you are loading is the name of a resource that is already being used: ' . $name);
        }

        $model = strtolower($model);

        foreach ($this->_ci_model_paths as $mod_path) {

            if (!file_exists($mod_path . 'models/' . $path . $model . '.php')) {
                continue;
            }

            if ($db_conn !== FALSE AND !class_exists('CI_DB')) {
                if ($db_conn === TRUE) {
                    $db_conn = '';
                }

                $CI->load->database($db_conn, FALSE, TRUE);
            }

            if (!class_exists('CI_Model')) {
                load_class('Model', 'core');
            }

            require_once($mod_path . 'models/' . $path . $model . '.php');

            $model = ucfirst($model);

            if (func_num_args() > 3) {
                $refl = new ReflectionClass($model);
                $CI->$name = $refl->newInstanceArgs(array_slice(func_get_args(), 3));
            } else {
                $CI->$name = new $model();
            }

            //$CI->$name = new $model();

            $this->_ci_models[] = $name;
            return;
        }

        // couldn't find the model
        show_error('Unable to locate the model you have specified: ' . $model);
    }
*/
}

?>
