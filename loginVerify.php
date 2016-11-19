<?php
	//error_reporting(-1);
        $user_name = $_POST['username'];
        $user_password = $_POST['userpassword'];
	if(!$user_name or !$user_password){
		header("Location: login.php?error=Invalid username or password");
		exit();
	}
	session_start(); // session starts with the help of this function
//         include "connection.php";
// 	$conn = new mysqli($servername, $username, $password);
	//echo "session started";
// 	if(class_exists('PDO')){
// 		echo "pdo exists";
// 	} else {
// 		echo "pdo does not exist";
// 	}
	require_once "DBConn.php";
// 	echo "dbconn included";
	$dbconn = new DBConn();
// 	echo "dbconn created";
	if($dbconn->connectToDatabase()){
// 	echo "connected to db<br>";
	//$link = mysqli_connect("$servername", "$username", "$password", "$dbname") or die ("Connection Error " . mysqli_error($link));

	//$sql = "SELECT username, isadmin, hashedpassword FROM db.user WHERE BINARY username = '$user_name' and activeuserflag = 1;";
	$sql = "SELECT username, isadmin, hashedpassword FROM db.user WHERE BINARY username = ? AND activeuserflag = 1;";
	$row = $dbconn->select($sql, array($user_name));
	$errorstring = "";
	if(count($errors = $dbconn->getErrors()) > 0){
		foreach($errors as $error){
			$errorstring .= $error."<br>";
		}
		$errorstring = rtrim($errorstring, "<br>");
	} //else {
// 		echo "no errors after select statement<br>";
// 	}
// 	$result = $conn->query($sql);
// 	$row = $result->fetch_assoc();

	if(password_verify($user_password, $row['hashedpassword'])){
		$_SESSION['NAME'] = $user_name;
		$_SESSION['ADMIN'] = $row['isadmin'];
		//echo "success<br>";
		if(isset($_POST['test'])){
			echo "{success: true,
			name: '$user_name',
			isadmin: $row['isadmin'],
			error: 0}";
		} else {
			header("Location: index.php");
		}
		exit();
	} else {
		if(isset($_POST['test']){
			echo "{success: false,
			name: '$user_name',
			isadmin: $row['isadmin'],
			error: '$errorstring'}";
		} else {
// 			echo "no user found, or password is incorrect<br>";
			header("Location: login.php?error=Invalid username or password");
			exit();
		}
	}
//}
?>
