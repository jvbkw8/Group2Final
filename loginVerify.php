<?php
	$failure = "{success:false";
	$success = "{success:true}";
        $user_name = $_POST['username'];
        $user_password = $_POST['userpassword'];
	if(!$user_name or !$user_password){
		header("Location: login.php?error=Invalid username or password");
		//echo $failure."}";
		exit();
	}
	session_start(); // session starts with the help of this function
        include "connection.php";
	$conn = new mysqli($servername, $username, $password);
	//$link = mysqli_connect("$servername", "$username", "$password", "$dbname") or die ("Connection Error " . mysqli_error($link));
	//TODO:  hash password!
	$sql = "SELECT username FROM db.user WHERE username = '$user_name' AND password= '$user_password';";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$failure .= ', username: "'.$user_name.'", password: "'.$user_password.'", sql: "'.$sql.'"}';
	if ($user_name == $row['username'] ) {
		$_SESSION[NAME] = $row['username'];
		header("Location: index.html");
		//echo $success;
		exit();
	} else {
		header("Location: login.php?error=Invalid username or password");
		//echo $failure;
		exit();
	}
?>
