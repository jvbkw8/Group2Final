<?php
$servername = "localhost";
$username = "root";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, "", $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO user (username, hashedpassword, usertypeid, activeuserflag) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sss", $username, $hashedpassword, $usertypeid, $activeuserflag);

// set parameters 
$username = $_POST["username"];
$hashedpassword = $_POST["hashedpasswor"];
$usertypeid = $_POST["usertypeid"];
$activeuserflag = $_POST["activeuserflag"];

//execute
$stmt->execute();

$stmt->close();
$conn->close();
?>
