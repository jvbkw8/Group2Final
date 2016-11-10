<?php
	$failure = "{success:false}";
	$success = "{success:true}";
        $username = $_POST['username'];
        $userpassword = $_POST['userpassword'];
	if(!$username or !$userpassword){
		echo $failure;
		exit();
	}
	session_start(); // session starts with the help of this function
        include "connection.php";
	$conn = new mysqli($servername, $username, $password);
	//$link = mysqli_connect("$servername", "$username", "$password", "$dbname") or die ("Connection Error " . mysqli_error($link));
	//TODO:  hash password!
	$sql = "SELECT username FROM db.user WHERE username = '$user' AND password= '$user_password';";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if ($username == $row['username'] ) {
		$_SESSION[NAME] = $row['username'];
		echo $success;
		exit();
	}else {
		echo $failure;
		exit();
	}
?>
