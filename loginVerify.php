<?php
        $user_name = $_POST['username'];
        $user_password = $_POST['userpassword'];
	if(!$user_name or !$user_password){
		header("Location: login.php?error=Invalid username or password");
		exit();
	}
	session_start(); // session starts with the help of this function
        //include "connection.php";
	$conn = new mysqli($servername, $username, $password);
	require_once "DBConn.php";
	$dbconn = new DBConn();
	//$link = mysqli_connect("$servername", "$username", "$password", "$dbname") or die ("Connection Error " . mysqli_error($link));
	//TODO:  hash password!
	$sql = "SELECT username FROM user WHERE username = ? AND password= ?;";
	$rows = $dbconn->select($sql, array($user_name, $user_password));
	if(count($errors = $dbconn->getErrors()) > 0){
		foreach($errors as $error){
			echo $error."<br>";
		}
	}
// 	$result = $conn->query($sql);
// 	$row = $result->fetch_assoc();
	if ($user_name == $rows['username'] ) {
		$_SESSION[NAME] = $user_name;
		header("Location: index.html");
		exit();
	} else {
		header("Location: login.php?error=Invalid username or password");
		exit();
	}
?>
