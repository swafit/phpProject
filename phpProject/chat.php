<?php include_once 'header.php';
if(!isset($_SESSION['userId'])){
  header("location: login.php");
  exit();
}
?>

<head>
    <link rel="stylesheet" href="style.css" />

    <style>
    #chats {
        border-collapse: collapse;
        width: 100%;
    }

    #chats td,
    #chats th {
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
</head>


<body>

    <?php 
//include_once 'phpCode/includes/functions.inc.php';

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dbName = "phpProject01";
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dbName);

$selectedUserId = $_POST['selectedId'];
$userIdOne = $_SESSION["userId"];
$userIdTwo = $selectedUserId;
if ($userIdOne >= $selectedUserId){
  $userIdOne = $selectedUserId;
  $userIdTwo = $_SESSION["userId"];
}

//write message
if(isset($_POST['message'])&&$_POST['message']!=""){
  //echo "message: ".$_POST['message'];
  $userId = $_SESSION['userId'];
  $sql = "INSERT INTO messages(userIdOne, userIdTwo, writterId, message, dateWritten) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../../chat.php?error=stmtfailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "iiiss", $userIdOne, $userIdTwo, $userId, $_POST['message'], $_POST['dateWritten']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
      ?>
    </div>

    <section class="userclass">

        <form action="userlist.php" method="post">
            <button type="submit" value="userlist">Go back to User List</button>
        </form><br><br>

        <div id="chatspace"></div>
        <p>Type something in the input field to search throughout the messages:</p>
        <input class="form-control" id="filter" type="text" placeholder="Search...">
        <br>
        <br>





        <table class="table-striped table-bordered table" id="chats">
            <thead>
                <tr>
                    <th>Message</th>
                    <th>Time stamp</th>
                    <th>Message written by user with id</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php     
                //get all the messages from the specific database
              $sql="SELECT * FROM messages WHERE userIdOne=? AND userIdTwo=? ORDER BY dateWritten ASC;";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: index.php?error=stmtfailed");
                exit();
              }
              mysqli_stmt_bind_param($stmt, "ii", $userIdOne, $userIdTwo);
              mysqli_stmt_execute($stmt);

              $rs_result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_array($rs_result)) {    
              //Display each field of the records.    
              ?>
                <tr>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['dateWritten']; ?></td>
                    <td><?php echo $row['writterId']; ?></td>
                </tr>
                <?php } ?>

            </tbody>
        </table>

        <form action="chat.php" method="post">
            <label for="msg">Type Message...</label>
            <input type="text" maxlength="255" id="msg" name="message">
            <input type="hidden" id="selectedId" name="selectedId" value="<?php echo $_POST['selectedId']; ?>">
            <button type="submit" value="send">Send </button><br><br><br>
            <?php
              date_default_timezone_set('America/New_York');
              $date = date('Y-m-d H:i:s');
            ?>
            <input type="hidden" id="dateWritten" name="dateWritten" value="<?php echo $date;?>">
        </form>

        <form action="chat.php" method="post">
            <input type="hidden" id="selectedId" name="selectedId" value="<?php echo $_POST['selectedId'];?>">
            <button type="submit" name="convoDB" value="Refresh">Refresh messages</button>
        </form>

        <script>
        $(document).ready(function() {
            $("#filter").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        </script>
        <?php include_once 'footer.php'; ?>