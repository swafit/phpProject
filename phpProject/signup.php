<head>
<style>
  
        .required:after {
            content:" *";
            color: red;
        }

   
    </style>
    <link rel="stylesheet" href="style.css" />
</head>

<?php
  include_once 'header.php';
  session_start();
  if(isset($_SESSION['userId'])){
    header("location: userlist.php");
    exit();
  }
?>

<section class="signup-form">
  <h2>Sign Up</h2>
  <div class="signup-form-form">
    <form action="phpCode/includes/signup.inc.php" method="post">
      
      <label for="fname" class="required">Full name</label>
      <input type="text" class="required" name="name" id="fname" placeholder="Full name..." required autofocus onkeyup="check()">
      
      <label for="email" class="required">Email</label><span id="Emailmessage"></span>
      <input type="text" class="required" name="email" id="email" required onkeyup="check()">
      
      <label for="username" class="required">Username</label>
      <input type="text" class="required" name="username" id="username" placeholder="Username..." required onkeyup="check()">

      <label for="pwd" class="required">Password</label>
      <input type="password" id="pwd" name="pwd" onkeyup="check()" required><br>
      <label for="show1">Show Password</label>
      <input type="checkbox" id="show1" onclick="showPWD()">
      
      <label for="pwd2" class="required">Repeat password</label>
      <input type="password" id="pwd2" name="pwd2" onkeyup="check()" placeholder="Repeat Password..." required><br>
      <label for="show2">Show Password</label>
      <input type="checkbox" id="show2" onclick="showPWD2()">

      <label for="tfa">Verify with Two-Factor Authentication?</label>
      <input type="checkbox" id="tfa" name="tfa" class="checkbox" value="True"/>
      
        <span id="message"></span>
      </label>
      
      <button type="submit" id="sbmt" name="submit" disabled>Sign up</button>
    </form>
  </div>


  <script type="text/javascript">
        let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
        function check() {
            var email = document.getElementById('email');
            var mailformat = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
            if(email.value.match(mailformat)){
              document.getElementById('Emailmessage').innerHTML = '';
                if(strongPassword.test(document.getElementById('pwd').value)) {
                    if (document.getElementById('pwd').value == document.getElementById('pwd2').value) {
                        document.getElementById('message').innerHTML = '';
                        document.getElementById("sbmt").disabled = false;
                      } else {
                        document.getElementById('message').style.color = 'red';
                        document.getElementById('message').innerHTML = 'Password not matching';
                        document.getElementById("sbmt").disabled = true;
                      }
                }else {
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = 'Password needs to contain a minimum of 8 characters, a special character, an uppercase and lowercase, and a number to be valid';
                    document.getElementById("sbmt").disabled = true;
                  }
            }else{
                document.getElementById('Emailmessage').style.color = 'red';
                document.getElementById('Emailmessage').innerHTML = 'Please enter a valid email';
                document.getElementById("sbmt").disabled = true;
            }    
        }
            
        function showPWD() {
              var x = document.getElementById("pwd");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
        function showPWD2() {
              var x = document.getElementById("pwd2");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
        
    </script>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      }
      else if ($_GET["error"] == "invaliduid") {
        echo "<p>Choose a proper username!</p>";
      }
      else if ($_GET["error"] == "invalidemail") {
        echo "<p>Choose a proper email!</p>";
      }
      else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<p>Passwords doesn't match!</p>";
      }
      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong!</p>";
      }
      else if ($_GET["error"] == "usernametaken") {
        echo "<p>Username already taken!</p>";
      }
      else if ($_GET["error"] == "none") {
        echo "<p>You have signed up!</p>";
      }//redirect using get method from php code
      // header("Location:../signup.php?location=".$_SERVER['HTTP_REFERER']);

      // $test = $_GET['location'];
      // header('Location:'.$test);
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>
