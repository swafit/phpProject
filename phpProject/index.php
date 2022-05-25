<head>
<link rel="stylesheet" href="style.css" />
<style>
body {
    background-color: #333333;
}

.wrapper {
    width: 900px;
    margin: 0 auto;
}
  </style>
</head>
<!--Splitting the header and footer into separate documents makes things easier!-->
<body>
<?php
  include_once 'header.php';
  ?>
<section class="index-intro">
<?php
 
  date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');

echo 'Date: ', $date;
echo "<br>";

 include_once 'phpCode/includes/createdb.inc.php';
?>


  <h1>This Is Our Chatroom Site</h1>
  <p>Sign up and start a chat room live messaging session!</p>

</section>


<section class="index-categories">
    
  <h2>Some Basic Categories</h2>
  <div class="index-categories-list">
  <h2>Chat Messages</h2>

<div class="container">
  <p>Hello. How are you today?</p>
  <span class="time-right">11:00</span>
</div>

<div class="container darker">
  <p>Hey! I'm fine. Thanks for asking!</p>
  <span class="time-left">11:01</span>
</div>

<div class="container">
  <p>Sweet! So, what do you wanna do today?</p>
  <span class="time-right">11:02</span>
</div>

<div class="container darker">
  <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
  <span class="time-left">11:05</span>
</div>
</section>

<?php
  include_once 'footer.php';
?>
</body>