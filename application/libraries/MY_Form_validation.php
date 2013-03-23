<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    function run($module = '', $group = '') {
        (is_object($module)) AND $this->CI = & $module;
        return parent::run($group);
    }

    function unique($value, $params) {
        $CI = & get_instance();

        $CI->form_validation->set_message('unique',
                'The %s is already being used.');

        list($model, $field) = explode(".", $params, 2);

        $find = "findOneBy" . $field;

        if (Doctrine::getTable($model)->$find($value)) {
            return false;
        } else {
            return true;
        }
    }

}

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */