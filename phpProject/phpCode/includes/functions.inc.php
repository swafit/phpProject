<?php
//write a message to the specific database
function writeMessage($conn, $convoId, $timeStamp, $message){
	$userId = $_SESSION['id'];
	$sql = "INSERT INTO".$convoId." (userId, message, dateWritten) VALUES (?, ?, ?);";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../../chat.php?error=stmtfailed");
			exit();
		}
		mysqli_stmt_bind_param($stmt, "iss", $userId, $message, $timeStamp);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
}

//get all the messages from the specific database
function getChats($convoId, $conn){
	$sql="SELECT * FROM ".$convoId." WHERE convoId=?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../chat.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "i", $convoId);
	mysqli_stmt_execute($stmt);



}


// Check for empty input signup
function emptyInputSignup($conn, $name, $username, $email, $twofaEnabled, $twofaCodeSecret, $pwd, $pwdRepeat) {
	$result=false;
	if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}


//get the id of the convo
function getConvoId($conn, $selectedUserId) {
	$sql="SELECT * FROM convoController WHERE userIdOne=? AND userIdTwo=?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../chat.php?error=stmtfailed");
		exit();
	}
	$userIdOne = $_SESSION['$id'];
	$userIdTwo = $selectedUserId;
	if ($userIdOne >= $selectedUserId){
		$userIdOne = $selectedUserId;
		$userIdTwo = $_SESSION['$id'];
	}
	mysqli_stmt_bind_param($stmt, "ii", $userIdOne, $userIdTwo);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		$convoId = $row['convoId'];
	}
	else {
		$sql = "INSERT INTO convoController (userIdOne, userIdTwo) VALUES (?, ?);";
		$stmt1 = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt1, $sql)) {
			header("location: ../../chat.php?error=stmtfailed");
			exit();
		}
		mysqli_stmt_bind_param($stmt1, "ii", $userIdOne, $userIdTwo);
		$convoId = mysqli_stmt_insert_id($stmt1);
		mysqli_stmt_close($stmt1);
		$sqlDB = "CREATE TABLE if NOT EXISTS ".$convoId." (messageId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, userId int(11) NOT NULL, message VARCHAR(255) NOT NULL, dateWritten VARCHAR(255) NOT NULL);";
    	$conn->exec($sqlDB);
	}
	mysqli_stmt_close($stmt);

	return $convoId;
}


// Check invalid username
function invalidUid($username) {
	$result=false;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// duplicate Check to ensure no invalid emails are used to signup with
function invalidEmail($email) {
	$result=false;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// secondary Check to ensure passwords match
function pwdMatch($pwd, $pwdrepeat) {
	$result=false;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if username is in database, if so then return data
function uidExists($conn, $username) {
  $sql = "SELECT * FROM users WHERE userId = ? OR userEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../signup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// Insert new user into database
function createUser($conn, $name, $username, $email, $tfe, $tfcs,  $pwd) {
	$sql = "INSERT INTO users (fullName, userName, userEmail, twoFactorEnabled, twoFactorCodeSecret, userPwd) VALUES (?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../../signup.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "ssssss", $name, $username, $email, $tfe, $tfcs, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../../signup.php?error=none");
	exit();
}

// Check for empty input login
function emptyInputLogin($username, $pwd) {
	$result=false;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Log user into website
function loginUser($conn, $username, $pwd) {
	$uidExists = uidExists($conn, $username);

	if ($uidExists === false) {
		header("location: ../../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../../login.php?error=wronglogin");
		exit();
	}
	elseif ($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $uidExists["userId"];
		$_SESSION["useruid"] = $uidExists["userUid"];
		header("location: ../../index.php?error=none");
		exit();
	}
}

