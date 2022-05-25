<?php 
session_start();
if(isset($_SESSION['user'])){
  header("location: user_list.php");
  exit();
}
?>
<DOCTYPE html>
<html>
<head>
<title>Chat room Log in</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
  include_once 'header.php';
?>


<section class="signup-form">
  <h2>Log In</h2>
  <div class="signup-form-form">
    <form action="phpCode/includes/login.inc.php" method="post">
      <input type="text" name="uid" placeholder="Username/Email...">
      <input type="password" name="pwd" placeholder="Password...">
      <button type="submit" name="submit">Log in</button><br><br>
      <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
    </form>
  </div>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      }
      else if ($_GET["error"] == "wronglogin") {
        echo "<p>Wrong login!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>
</body>
</html>
