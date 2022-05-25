<?php

if (isset($_POST["submit"])) {

  // First we get the form data from the URL
  $name = $_POST["name"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $twofaEnabled = isset($_POST["tfa"]);
  $twofaCodeSecret = '123';
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwd2"];
  /*
if ($twofaEnabled=='')
  $twofaEnabled = false;
  */
  // Then we run a bunch of error handlers to catch as many user mistakes we can
  // These functions can be found in functions.inc.php

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  /*
  // Left inputs empty
  // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
  if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
    header("location: ../../signup.php?error=emptyinput");
		exit();
  }
	// Proper username chosen
  if (invalidUid($username) !== false) {
    header("location: ../../signup.php?error=invaliduid");
		exit();
  }
  // Proper email chosen
  if (invalidEmail($email) !== false) {
    header("location: ../../signup.php?error=invalidemail");
		exit();
  }
  // Do the two passwords match?
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../../signup.php?error=passwordsdontmatch");
		exit();
  }
  // Is the username taken already
  if (uidExists($conn, $username) !== false) {
    header("location: ../../signup.php?error=usernametaken");
		exit();
  }
*/
  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  createUser($conn, $name, $username, $email, $twofaEnabled, $twofaCodeSecret, $pwd);

} else {
	header("location: ../signup.php");
    exit();
}
