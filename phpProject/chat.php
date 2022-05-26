<?php include_once 'header.php';
if(!isset($_SESSION['userId'])){
  header("location: login.php");
  exit();
}
?>
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
    function writeMessage($conn, $convoId, $timeStamp, $message){
      $userId = $_SESSION['userId'];
      $sql = "INSERT INTO convo".$_SESSION['convoId']." (userId, message, dateWritten) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: ../../chat.php?error=stmtfailed");
          exit();
        }
        mysqli_stmt_bind_param($stmt, "iss", $userId, $message, $timeStamp);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
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
  
<?php 
//include_once 'phpCode/includes/functions.inc.php';

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dbName = "phpproject01";
$selectedUserId = $_POST['selectedId'];
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dbName);
$convoId = getConvoId($conn, $selectedUserId);
      ?>
      </div>

      <section class="userclass">  
      <form action = "userlist.php" method = "post">
      <button type="submit" value="userlist">Go back to User List</button></form><br><br>
      
      <div id="chatspace"></div>
      <p>Type something in the input field to search throughout the messages:</p> 
      <input class="form-control" id="filter" type="text" placeholder="Search...">
      <br>
      <br>

          <thead>
          


      <table class="table-striped table-bordered table" id="chats">
          <thead>   
              <tr>   
                  <th>Message</th>   
                  <th>Time stamp</th>  
                  <th>Name</th>
              </tr>   
          </thead>   
      <tbody id="myTable">   
    <?php     
                //get all the messages from the specific database

              $sql="SELECT * FROM convo".$convoId." WHERE convoId=?;";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../../chat.php?error=stmtfailed");
                exit();
              }
              mysqli_stmt_bind_param($stmt, "i", $convoId);
              mysqli_stmt_execute($stmt);


            while ($row = mysqli_fetch_array($rs_result)) {    
                  //Display each field of the records.    
                  ?>     
            <tr>     
              <td><?php echo $row['message']; ?></td>
              <td><?php echo $row['dateWritten']; ?></td>
              <td><?php echo $row['userId']; ?></td>
<?php } ?>
        <body>
                </tr>     

          </tbody>   
        </table>   
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
        <form action = "" method = "post">
    <label for ="msg">Type Message...</label>
    <input type ="text" maxlength="255" id="msg" name="msg">
    <button type="submit" value="send">Send </button><br><br><br>
    </form>
    <form action="chat.php" method ="post">
        <button type="submit" name="convoDB" value="Refresh">Refresh messages</button>
        <?php
        date_default_timezone_set('America/New_York');
        $date = date('Y-m-d H:i:s');
        echo 'Date: ', $date;
        ?>
      </form>
    </form> 
    <?php include_once 'footer.php'; ?>