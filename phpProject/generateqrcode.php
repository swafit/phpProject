<?php

# Include packages
require_once(__DIR__ . '/vendor/autoload.php');

# Create the 2FA class
//$google2fa = new phpCode\includes\Google2FA();

$userSecret = $google2fa->generateSecretKey();


//print "Please enter the following secret into your phone:" . PHP_EOL .  $userSecret . PHP_EOL;