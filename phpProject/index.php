<?php
  include_once 'header.php';
?>
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

<section class="index-intro">
<?php
 
  date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s');

echo 'Date: ', $date;
echo "<br>";

 include_once 'phpCode/includes/createdb.inc.php';
?>


  <h1>This Is Our Chatroom Site</h1>
  <p><a href="login.php">Sign up</a> and start a chat room live messaging session!</p>

</section>


<section class="index-categories">
    
  <h2>A few suggestions</h2>
  <div class="index-categories-list">

<div class="container">
  <p>Use a startup chat service who has it users at heart.</p>
</div>

<div class="container darker">
  <p>Have a conversation and be able to sort thorough old chats.</p>
</div>

<div class="container darker">
  <p>Chat with people you know.</p>
</div>
</section>

<?php
  include_once 'footer.php';
?>
</body>