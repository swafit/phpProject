<?php include_once 'header.php';?>
<head>
<link rel="stylesheet" href="style.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js%22%3E"></script>
    <style>
      #chats{
        border-collapse: collapse;
  width: 100%;
      }
      #chats td, #chats th {
        border: 1px solid #ddd;
  padding: 8px;
      }
      #chats th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
        /*body[padding= 25px]*/
    input[type=text] {
  width: 130px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

/* When the input field gets focus, change its width to 100% */
input[type=text]:focus {
  width: 100%;
}
    </style>
    <?php
    /*
    $convoDB = $_SESSION['convoDB'];
        $conn = mysqli_connect('localhost', 'root', '');  
        if (! $conn) {  
                die("Connection failed" . mysqli_connect_error());  
        }  
        else {  
                mysqli_select_db($conn, $convoDB);  
        }
*/
    ?>
</head>

<body>
  
<?php include_once 'phpCode/includes/functions.inc.php';

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dbName = "phpproject01";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dbName);
$convoId = getConvoId($conn, $_POST['selectedId']);



?>
<div id="wrapper">
    <div id="menu">
        <!-- add user name here 
        <p class="welcome">Welcome, <b> <?php echo $_SESSION['name']; ?></b></p>
-->

</div>

<?php
/*
      //get previous chat
      $me = $_SESSION['user'];
      $id_sent = $me['user_id'];
      $id_received = $them['user_id'];
      $messages = $connect->query("SELECT * FROM chat ORDER BY date_time ASC")->fetchAll();
      foreach($messages as $messages){
        if ($messages['id_received'] == $id_sent && $messages['id_sent'] == $id_received )
        
        {
          echo '<div class="received"><p class="name">'.$messages['user_sent']."</p>";
          echo $messages['content']."<br>";
          echo '<p class="date">'.$messages['date_time']."<br></p></div>";
        }
        
        if ($messages['id_sent'] == $id_sent && $messages['id_received'] == $id_received)
        
        {
          echo '<div class="sent"><p class="name">'.$messages['user_sent']."</p>";
          echo $messages['content']."<br>";
          echo '<p class="date">'.$messages['date_time']."<br></p></div>";
        }
      }
      */
      ?>
      </div>

      <section class="userclass">  
      <form action = "userlist.php" method = "post">
      <button type="submit" value="userlist">Go back to User List</button></form><br><div id="chatspace"></div>

      <p>Type something in the input field to search throughout the messages:</p> 
      <input class="form-control" id="filter" type="text" placeholder="Search...">
      <br>
      <br>

          <thead>

      <table class="table-striped table-bordered table">
        <table id="chats">
          <thead>   
              <tr>   
                  <th>Message</th>   
                  <th>Time stamp</th>  
                  <th>Name</th>
              </tr>   
          </thead>   
      <tbody id="myTable">   
    <?php     
    
            //while ($row = mysqli_fetch_array($rs_result)) {    
                  // Display each field of the records.    ?>     
            <tr>     
             <td><?php //echo $row['fullName']; ?></td>
            <td><?php //echo $row['userEmail']; ?></td>
        <body>
                </tr>     
            <?php     
                //get all the messages from the specific database
/*
              $sql="SELECT * FROM ".$convoId." WHERE convoId=?;";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../../chat.php?error=stmtfailed");
                exit();
              }
              mysqli_stmt_bind_param($stmt, "i", $convoId);
              mysqli_stmt_execute($stmt);
*/

            ?>     
          </tbody>   
        </table>   
  
          <table id= "chats">
    <div class="pagination">    
      </tr>
      <form name= "messageTimestamp action 
                    <th>Name </th>= " method="POST">
    <script>
      $(document).ready(function(){
        $("#filter").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
    </script>
        
    <label for ="msg">Type Message...</label>
    <input type ="text" maxlength="255" id="msg" name="msg">
    <button type="submit" value="send">Send </button><br>

    <form action="chat.php" method ="post">
        <button type="submit" value="Refresh">Refresh</button></form>
    </form> 
    <?php include_once 'footer.php'; ?>