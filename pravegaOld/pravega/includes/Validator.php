<?php

require_once 'SystemComponent.php';

class Validator extends SystemComponent {

    var $errors; // A variable to store a list of error messages

    function postDataExist($textbox) {
        if (isset($_POST[$textbox]) && $_POST[$textbox] != '') {
            return true;
        } else {
            $this->errors[] = 'Data is not present in POST';
            return false;
        }
    }

    function getDataExist($textbox) {
        if (isset($_GET[$textbox]) && $_GET[$textbox]) {
            return true;
        } else {
            $this->errors[] = 'Data is not present in GET';
            return false;
        }
    }

    function preventInjuction($textbox) {
        return mysql_real_escape_string(stripslashes($_POST[$textbox]));
    }
    function preventInjcnGET($textbox)
    {
        return mysql_real_escape_string(stripslashes($_GET[$textbox]));
    }

    // Validate something's been entered
    // NOTE: Only this method does nothing to prevent SQL injection
    // use with addslashes() command

    function validateGeneral($theinput, $description = '') {
        if (trim($theinput) != "") {
            return true;
        } else {
            $this->errors[] = $description;
            return false;
        }
    }

    // Validate text only
    function validateTextOnly($theinput, $description = '') {
        $result = ereg("^[A-Za-z0-9\ ]+$", $theinput);
        if ($result) {
            return true;
        } else {
            $this->errors[] = $description;
            return false;
        }
    }

    // Validate text only, no spaces allowed
    function validateTextOnlyNoSpaces($theinput, $description = '') {
        $result = ereg("^[A-Za-z0-9]+$", $theinput);
        if ($result) {
            return true;
        } else {
            $this->errors[] = $description;
            return false;
        }
    }

    // Validate email address
    function validateEmail($themail, $description = '') {

        if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $themail)) {
            $this->errors[] = $description;
            return false;
        }
        return true;
    }

    // Validate numbers only
    function validateNumber($theinput, $description = '') {
        if (is_numeric($theinput)) {
            return true; // The value is numeric, return true
        } else {
            $this->errors[] = $description; // Value not numeric! Add error description to list of errors
            return false; // Return false
        }
    }

    // Validate date
    function validateDate($thedate, $description = '') {

        if (strtotime($thedate) === -1 || $thedate == '') {
            $this->errors[] = $description;
            return false;
        } else {
            return true;
        }
    }

    // Check whether any errors have been found (i.e. validation has returned false)
    // since the object was created
    function foundErrors() {
        if (count($this->errors) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Return a string containing a list of errors found,
    // Seperated by a given deliminator
    function listErrors($delim = ' ') {
        return implode($delim, $this->errors);
    }

    // Manually add something to the list of errors
    function addError($description) {
        $this->errors[] = $description;
    }

}

?>