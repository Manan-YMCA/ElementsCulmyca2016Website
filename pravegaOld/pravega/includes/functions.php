<?php

class GlobalFunctions {

    function generate_password($password) {
        $salt = 'hjghbdjgh7486539neojnvge0@#$nfwgjknej';
        $password = md5($password . $salt);
        return $password;
    }

    function genRandomString($length) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters))];
        }
        return $string;
    }

}

?>
