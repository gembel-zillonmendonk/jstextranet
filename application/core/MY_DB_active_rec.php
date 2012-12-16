<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Active Record Class
 *
 * This is the platform-independent base Active Record implementation class.
 *
 * @package		CodeIgniter
 * @subpackage	Drivers
 * @category	Database
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/database/
 */
class MY_DB_active_record extends CI_DB_active_record {

    public function from($from, $prefix_single = TRUE) {

        foreach ((array) $from as $val) {
            if (strpos($val, ',') !== FALSE) {
                foreach (explode(',', $val) as $v) {
                    $v = trim($v);
                    $this->_track_aliases($v);

                    $this->ar_from[] = $this->_protect_identifiers($v, $prefix_single, NULL, FALSE);

                    if ($this->ar_caching === TRUE) {
                        $this->ar_cache_from[] = $this->_protect_identifiers($v, $prefix_single, NULL, FALSE);
                        $this->ar_cache_exists[] = 'from';
                    }
                }
            } else {
                $val = trim($val);

                // Extract any aliases that might exist.  We use this information
                // in the _protect_identifiers to know whether to add a table prefix
                $this->_track_aliases($val);

                $this->ar_from[] = $this->_protect_identifiers($val, $prefix_single, NULL, FALSE);

                if ($this->ar_caching === TRUE) {
                    $this->ar_cache_from[] = $this->_protect_identifiers($val, $prefix_single, NULL, FALSE);
                    $this->ar_cache_exists[] = 'from';
                }
            }
        }
//print_r($this->ar_from);
//        print_r($this->ar_cache_from);
        return $this;
    }

    protected function _merge_cache() {
        if (count($this->ar_cache_exists) == 0) {
            return;
        }

        foreach (array_unique($this->ar_cache_exists) as $val) {
            $ar_variable = 'ar_' . $val;
            $ar_cache_var = 'ar_cache_' . $val;

            if (count($this->$ar_cache_var) == 0) {
                continue;
            }

//            $this->$ar_variable = array_unique(array_merge($this->$ar_cache_var, $this->$ar_variable));
            $this->$ar_variable = array_merge($this->$ar_cache_var, $this->$ar_variable);
//            print_r(array_merge($this->$ar_cache_var, $this->$ar_variable)); 
        }
//print_r(array_merge($this->ar_from, $this->ar_cache_from));
//print_r(array_unique($this->ar_cache_exists));
        // If we are "protecting identifiers" we need to examine the "from"
        // portion of the query to determine if there are any aliases
        if ($this->_protect_identifiers === TRUE AND count($this->ar_cache_from) > 0) {
            $this->_track_aliases($this->ar_from);
        }
        $this->ar_no_escape = $this->ar_cache_no_escape;
    }

}

/* End of file DB_active_rec.php */
/* Location: ./system/database/DB_active_rec.php */