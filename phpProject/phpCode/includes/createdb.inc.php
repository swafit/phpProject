<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpProject01";
try{
    $conn = new PDO('mysql:host=localhost', $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$conn->exec("DROP DATABASE phpProject01");
    $conn->exec("CREATE DATABASE if NOT EXISTS phpProject01");
    $conn = new PDO('mysql:host=localhost;dbname=phpProject01', $username, $password);
    // $conn->exec("DROP TABLE IF EXISTS `messages`;");
    $conn->exec("CREATE TABLE if NOT EXISTS users (userId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, fullName varchar(128)NOT NULL, userName varchar(128) NOT NULL, userEmail varchar(128) NOT NULL, twoFactorEnabled BOOLEAN DEFAULT FALSE, twoFactorCodeSecret varchar(255) default '', userPwd varchar(128) NOT NULL )");

    // $conn->exec("CREATE TABLE IF NOT EXISTS convocontroller (userIdOne int(11) NOT NULL, userIdTwo int(11) NOT NULL, convoId int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY);");
    
    // $sql = "CREATE TABLE if NOT EXISTS convos (messageId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, convoId int(11) NOT NULL, userId int(11) NOT NULL, message VARCHAR(255) NOT NULL, dateWritten VARCHAR(255) NOT NULL);";
    // $conn->exec($sql);
    $sql = "CREATE TABLE if NOT EXISTS messages (messageId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, userIdOne int(11) NOT NULL, userIdTwo int(11) NOT NULL, writterId int(11) NOT NULL, message VARCHAR(255) NOT NULL, dateWritten VARCHAR(255) NOT NULL);";
    $conn->exec($sql);
    /*
    $sql2 = "INSERT INTO `users` (fullName, userName, userEmail, twoFactorEnabled, twoFactorCodeSecret, userPwd) VALUES ('William Chalifoux', 'swafit', 'william.chalifoux@gmail.com', false, '', 'password')";
    $conn->exec($sql2);
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
    */


    $conn=null;
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}    
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->close();


?>