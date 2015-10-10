<?php
session_start();
class LoggedIn {
    function logincheck() {
		 if (isset($_SESSION['HTTP_USER_AGENT'])) {
            if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
                $this->logout();
                exit;
            }
         }

        if (!isset($_SESSION['user'])) {
            $this->logout();
            exit;
        }
      }

    function logout() {
        session_start();
        unset($_SESSION['user']);
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['HTTP_USER_AGENT']);
        session_unset();
        session_destroy();
        header('location:login.php');
    }
}

?>
