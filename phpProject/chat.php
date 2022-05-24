<?php
  include_once 'header.php';
  ?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js%22%3E"></script>
    <style>
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
        $conn = mysqli_connect('localhost', 'root', '');  
        if (! $conn) {  
                die("Connection failed" . mysqli_connect_error());  
        }  
        else {  
                mysqli_select_db($conn, 'phpProject01');  
        } 

       /*
       //pagination available
        $per_page_record=10;
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        
        $start_from = ($page-1) * $per_page_record;     
        $query = "SELECT count(*) FROM `users`";     
*/
        $query = "SELECT * FROM `users`";     
        $rs_result = mysqli_query($conn, $query);    
/*
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     

        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";
        $query = "SELECT * FROM `users` LIMIT $per_page_record, $start_from";     
        $rs_result = mysqli_query ($conn, $query);    
        */
        
    ?>
</head>

<body>
<?php

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

<div id="chatspace"></div>

 <p>Type something in the input field to search throughout the table:</p>
        <input class="form-control" id="filter" type="text" placeholder="Search...">
        <br>

            <thead>

        <table class="table-striped table-bordered table">
            <thead>   
                <tr>   
                    <th>Full Name</th>   
                    <th>Email</th>  
                </tr>   
            </thead>   
        <tbody id="myTable">   
    <?php     
            while ($row = mysqli_fetch_array($rs_result)) {    
                  // Display each field of the records.    ?>     
            <tr>     
             <td><?php echo $row['fullName']; ?></td>     
            <td><?php echo $row['userEmail']; ?></td>                                        
            </tr>     
            <?php     
                };    
            ?>     
          </tbody>   
        </table>   
  
     <div class="pagination">    
      <?php  
        
          /*
    echo "</br>";     
        // Number of pages required.   
               
      
        if($page>=2){   
            echo "<a href='index1.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='index1.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='index1.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='index1.php?page=".($page+1)."'>  Next </a>";   
        }   
  */
      ?>    



<form name="message " action = "" method="POST">
    <input name="usertxt" type="text" id="usertxt" placeholder="Type Message..." />
    <button type="send" id="sendtxt" name="send" value="Send"></button><br>
</form>

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
    
<?php
  include_once 'footer.php';
?>

