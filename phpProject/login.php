<?php
  include_once 'header.php';
?>
<?php
if(isset($_SESSION['userId'])){
  header("location: userlist.php");
  exit();
}
?>
<title>Chat room Log in</title>
<link rel="stylesheet" href="style.css" />
</head>



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
