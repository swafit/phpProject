<?php
  include_once 'header.php';
  session_start();
  if(!isset($_SESSION['userId'])){
    header("location: login.php");
    exit();
  }
  ?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js%22%3E"></script>
    <style>
      #users{
        border-collapse: collapse;
  width: 100%;
      }
      #users td, #users th {
        border: 1px solid #ddd;
  padding: 8px;
      }
      #users th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
      body {
    background-color: #333333;
}

.wrapper {
    width: 900px;
    margin: 0 auto;
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
  
<link rel="stylesheet" href="style.css" />

</head>

<body>
<?php

?>
<section class="userclass">
<div id="wrapper">
    <div id="menu">
        <!-- add user name here 
        <p class="welcome">Welcome, <b> <?php echo $_SESSION['name']; ?></b></p>
-->

</div>


      </div>

<div id="chatspace"></div>

 <p>Type something in the input field to search throughout the table:</p>
        <input class="form-control" id="filter" type="text" placeholder="Search...">
        <br>

            <thead>

        <table class="table-striped table-bordered table">
        <table id="users">
            <thead>   
                <tr>   
                    <th>Full Name</th>   
                    <th>Email</th>  
                    <th>Conversation</th>
                </tr>   
            </thead>   
        <tbody id="myTable">   
    <?php     
            while ($row = mysqli_fetch_array($rs_result)) {    
                  // Display each field of the records.    ?>     
            <tr>     
             <td><?php echo $row['fullName']; ?></td>     
            <td><?php echo $row['userEmail']; ?></td>
            <td>
                <form action="chat.php" method ="post">
                <button type="submit" value="Open Conversation">Open Conversation</button>
                <input type="hidden" name="selectedId" value="<?php echo $row['userId']; ?>">
            </form>
            </td>                                        
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
    </body>
<?php
  include_once 'footer.php';
?>
</section>
