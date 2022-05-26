<?php
  session_start();
  include_once 'phpCode/includes/functions.inc.php';
  //include_once 'generateqrcode.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP Login System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <!--A quick navigation-->
    <nav>
      <div class="wrapper">
        <a href="index.php"></a>
        <img src="img/logowhite.png" alt="Blogs logo">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="userlist.php">User List</a></li>
          
          <?php
            if (isset($_SESSION["userId"])) {
              echo "<li>". $_SESSION["userId"]."</li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
            }
            else {
              echo "<li><a href='signup.php'>Sign up</a></li>";
              echo "<li><a href='login.php'>Log in</a></li>";
            }
          ?>
          <form action = "" method=post>
    <button type="submit" value="Logout">Log out</button>
        </ul>
      </div>
      
    </nav>
          
<!--A quick wrapper to align the content (ends in footer.php)-->
<div class="wrapper">