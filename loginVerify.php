<?php
	//error_reporting(-1);
        $user_name = $_POST['username'];
        $user_password = $_POST['userpassword'];
	if(!$user_name or !$user_password){
		header("Location: login.php?error=Invalid username or password");
		exit();
	}
	session_start(); // session starts with the help of this function
        include "connection.php";
	$conn = new mysqli($servername, $username, $password);
	//echo "session started";
// 	if(class_exists('PDO')){
// 		echo "pdo exists";
// 	} else {
// 		echo "pdo does not exist";
// 	}
// 	require_once "DBConn.php";
// 	echo "dbconn included";
// 	$dbconn = new DBConn();
// 	echo "dbconn created";
	//if($dbconn->connectToDatabase()){
// 	echo "connected to db<br>";
	//$link = mysqli_connect("$servername", "$username", "$password", "$dbname") or die ("Connection Error " . mysqli_error($link));
	//TODO:  hash password!
	$sql = "SELECT username, hashedpassword FROM db.user WHERE username = '$user_name';";
	//$sql = "SELECT username FROM user WHERE username = ? AND password= ?;";
// 	$row = $dbconn->select($sql, array($user_name, $user_password));
// 	if(count($errors = $dbconn->getErrors()) > 0){
// 		foreach($errors as $error){
// 			echo $error."<br>";
// 		}
// 	} else {
// 		echo "no errors after select statement<br>";
// 	}
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	//if ($user_name == $row['username'] ) {
	if(password_verify($user_password, $row['hashedpassword'])){
		$_SESSION[NAME] = $user_name;
		//echo "success<br>";
		header("Location: index.html");
		exit();
	} else {
// 		echo "no user found, or password is incorrect<br>";
		header("Location: login.php?error=Invalid username or password");
		exit();
	}
//}
?>
