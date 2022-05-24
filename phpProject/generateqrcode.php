<?php

# Include packages
require_once(__DIR__ . '/vendor/autoload.php');

# Create the 2FA class
$google2fa = new phpCode\includes\Google2FA();

# Print a user secret for user to enter into their phone. 
# The application needs to persist this somewhere safely where other users can't get it.
$userSecret = $google2fa->generateSecretKey();

print "Please enter the following secret into your phone:" . PHP_EOL .  $userSecret . PHP_EOL;