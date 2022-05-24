<?php

# Include packages
require_once(__DIR__ . '/vendor/autoload.php');

# Create the 2FA class
$google2fa = new PragmaRX\Google2FA\Google2FA();

# Get the 2FA code from the user. If this is a website, you would fetch from a posted field instead.
//TODO change to form data
// print "Please enter your 2FA code:" . PHP_EOL;
$code = readline();

# Fetch/load the user secret in whatever way you do.
$userSecret = fetchUserSecretFromPersistenceStore();

# Verify the code is correct against our persisted user secret.
# This returns true if correct, false if not.
$valid = $google2fa->verifyKey($userSecret, $code); 

print ($valid) ? "Authenication PASSED!": "Authentication FAILED!";
print PHP_EOL;