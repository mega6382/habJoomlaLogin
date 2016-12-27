# HabJoomlaLogin

Joomla Login functionality for external sources.

Installation
-----------

Copy files from `joomla-site` directory to the root of your Joomla website.

Copy files from `other-site` directory to where you want to access this API from.


How To Use
----------

Send POST params `user` and `pass` to *hab-joomla-login.php*	located inside `joomla-site`. And it will return user data like json_encoded: username, name, email etc.

To use script inside `other-site`. Simply include the *HabJoomlaLogin.php*, to your code and call the `HabJoomlaLogin` class. here is an example:

    <?php
    
    include "path/to/HabJoomlaLogin.php";
    //Login Data username and password
    $data = [
    		"user" => "user123";
    		"pass" => "pass123";
    	];
    //Path to the hab-joomla-login.php located on the server with Joomla installation.
    $pathJoomla = "path/to/hab-joomla-login.php";
    
    //Contains the array with user information
    $login = HabJoomlaLogin::doLogin($data, $pathJoomla);
