<?php

class FormActionValidator {

    var $faverrors;

    function postDataExist($textbox) {
        if (isset($_POST[$textbox]) && $_POST[$textbox] != '') {
            return true;
        } else {
            $this->faverrors[] = 'Data is not present in POST';
            return false;
        }
    }

    function getDataExist($textbox) {
        if (isset($_GET[$textbox]) && $_GET[$textbox]) {
            return true;
        } else {
            $this->faverrors[] = 'Data is not present in GET';
            return false;
        }
    }

    function preventInjuctionPost($textbox) {
        return htmlspecialchars(mysql_real_escape_string(stripslashes(trim($_POST[$textbox]))));
    }

    function preventInjuctionGet($textbox) {
        return htmlspecialchars(mysql_real_escape_string(stripslashes(trim($_GET[$textbox]))));
    }

    /**
     * Form Action Validator
     * 
     * 
     */
    function foundErrors() {
        if (count($this->faverrors) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Return a string containing a list of errors found,
    // Seperated by a given deliminator
    function listErrors($delim = '<br/>') {
        return implode($delim, $this->faverrors);
    }

    // Manually add something to the list of errors
    function addError($description) {
        $this->faverrors[] = $description;
    }

}

?>
