<?php
	if(isset($_POST['test'])){
		header("Content-Type: application/json");
	}
        $user_name = $_POST['username'];
        $user_password = $_POST['userpassword'];
	if(!$user_name or !$user_password){
		if(isset($_POST['test'])){
			$errorstring = "";
			$passed = "false";
			if($_POST['expected'] == "false"){
				$passed = "true";
			}
			$returnarray = array("login_success"=>"false",
					    "login_expected"=>$_POST['expected'],
					    "test_passed"=>$passed,
					    "username"=>$user_name,
					    "error"=>$errorstring);
			echo json_encode($returnarray);
// 			echo "{login_success: 'false',
// 			login_expected: '".$_POST['expected']."',
// 			test_passed: '".$passed."',
// 			username: '".addslashes($user_name)."',
// 			error: '".$errorstring."'}";
		} else {
			header("Location: login.php?error=Invalid username or password");
		}
		exit();
	}
	session_start(); // session starts with the help of this function
	require_once "DBConn.php";
	$dbconn = new DBConn();
	if($dbconn->connectToDatabase()){
		$sql = "SELECT username, isadmin, hashedpassword FROM db.user WHERE BINARY username = ? AND activeuserflag = 1;";
		$rows = $dbconn->select($sql, array($user_name));
		if($rows !== false && count($rows) == 1){
			$row = $rows[0];
			$errorstring = "";
		} else {
			$errorstring = "Username not found.";
		}
		$errorstring = "";
		if(count($errors = $dbconn->getErrors()) > 0){
			foreach($errors as $error){
				$errorstring .= $error."<br>";
			}
			$errorstring = rtrim($errorstring, "<br>");
		}
		if(!$errorstring and isset($row['hashedpassword']) and password_verify($user_password, $row['hashedpassword'])){
			$_SESSION['NAME'] = $user_name;
			$_SESSION['ADMIN'] = $row['isadmin'];
			if(isset($_POST['test'])){
				$passed = "false";
				if($_POST['expected'] == "true"){
					$passed = "true";
				}
				$returnarray = array("login_success"=>"true",
						    "login_expected"=>$_POST['expected'],
						    "test_passed"=>$passed,
						    "username"=>$user_name,
						    "isadmin"=>$row['isadmin'],
						    "error"=>$errorstring);
				echo json_encode($returnarray);
// 				echo "{login_success: 'true',
// 				login_expected: '".$_POST['expected']."',
// 				test_passed: '".$passed."',
// 				username: '".addslashes($user_name)."',
// 				isadmin: '".$row['isadmin']."',
// 				error: '0'}";
			} else {
				header("Location: index.php");
			}
			exit();
		} else {
			if(isset($_POST['test'])){
				$passed = "false";
				if($_POST['expected'] == "false"){
					$passed = "true";
				}
				$returnarray = array("login_success"=>"false",
						    "login_expected"=>$_POST['expected'],
						    "test_passed"=>$passed,
						    "username"=>$user_name,
						    "error"=>$errorstring);
				echo json_encode($returnarray);
// 				echo "{login_success: 'false',
// 				login_expected: '".$_POST['expected']."',
// 				test_passed: '".$passed."',
// 				username: '".addslashes($user_name)."',
// 				error: '".$errorstring."'}";
			} else {
				header("Location: login.php?error=Invalid username or password");
			}
			exit();
		}
	} else {header("Location: login.php?error=Problems connecting.  Please try again later.");}
?>
