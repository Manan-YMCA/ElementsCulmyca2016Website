<?php
# Include the Autoloader (see "Libraries" for install instructions)
require 'php/vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-3qzkjwywk-67fwlke64w99s6cxpwo2z8');
$domain = "pravega.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Milind Hegde <me@pravega.org>',
                        'to'      => 'Baz <milind.hegde@gmail.com>',
                        'subject' => 'Hello',
                        'text'    => 'Testing some Mailgun awesomness!'));
						
var_dump($result);
						
?>