<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpProject01";
try{
    $conn = new PDO('mysql:host=localhost', $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$conn->exec("DROP DATABASE phpProject01");
    $sqlDB = "CREATE DATABASE if NOT EXISTS phpProject01";
    $conn->exec($sqlDB);
    //echo "new db made";
    $conn = new PDO('mysql:host=localhost;dbname=phpProject01', $username, $password);
    // $sql = "DROP TABLE IF EXISTS `users`;";
    // $conn->exec($sql);

    $sql="CREATE TABLE if NOT EXISTS users (userId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, fullName varchar(128)NOT NULL, userName varchar(128) NOT NULL, userEmail varchar(128) NOT NULL, twoFactorEnabled BOOLEAN DEFAULT FALSE, twoFactorCodeSecret varchar(255) default '', userPwd varchar(128) NOT NULL )";
    $conn->exec($sql);

    $sql="CREATE TABLE IF NOT EXISTS convocontroller (userIdOne int(11) NOT NULL, userIdTwo int(11) NOT NULL, convoId int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY);";
    $conn->exec($sql);
    
    /*
    $sql2 = "INSERT INTO `users` (fullName, userName, userEmail, twoFactorEnabled, twoFactorCodeSecret, userPwd) VALUES ('William Chalifoux', 'swafit', 'william.chalifoux@gmail.com', false, '', 'password')";
    $conn->exec($sql2);
    */
    echo '<br><br>';
$sql="SELECT * FROM `users`;";
    foreach ($conn->query($sql) as $row) {
        echo $row['userId'] . "\t";
        echo $row['fullName'] . "\t";
        echo $row['userName'] . "\t";
        echo $row['userEmail'] . "\n";
        echo $row['twoFactorEnabled']."\t";
        echo $row['twoFactorCodeSecret']."\t";
        echo $row['userPwd']."\t";
        echo '<br>';
    }


    $conn=null;
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}    
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





// sql where
$sql = "SELECT * FROM users WHERE email='Doe' ;";
/*
$result = $conn->query($sql);
echo '<br>';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}

//sql order by
echo '<br>';
$sql = "SELECT id, firstname, lastname FROM Guests ORDER BY firstname";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}

// sql delete
$sql = "DELETE FROM Guests WHERE id=3";
echo '<br>';
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

//sql update
echo '<br>';
$sql = "UPDATE Guests SET lastname='Rogers' WHERE id=2";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

//sql limit
$sql="SELECT * FROM Guests LIMIT 1, 3";
$result = $conn->query($sql);
echo '<br>';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
*/

$conn->close();


?>