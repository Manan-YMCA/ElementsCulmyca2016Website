<?php

class SystemComponent {

    var $settings;

    function getsettings() {

        $settings['siteDir'] = 'www/wamp/admin_panel';
        $settings['dbhost'] = 'localhost';
		
        /*$settings['dbusername'] = 'root';
        $settings['dbpassword'] = '';
        $settings['dbname'] = 'pravega';
		
		$settings['dbusername'] = 'mediatoo_pravega';
        $settings['dbpassword'] = 'pravega';
        $settings['dbname'] = 'mediatoo_pravega';*/
		
		$settings['dbusername'] = 'pravega';
        $settings['dbpassword'] = 'pravega@123';
        $settings['dbname'] = 'pravega';
		
        $settings['formaction'] = htmlentities($_SERVER["PHP_SELF"]);

        return $settings;
    }

}

?>