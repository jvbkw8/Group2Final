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

//execute
$stmt->execute();

////set permission////
// prepare and bind
$stmt = $conn->prepare("INSERT INTO permissiongroup (permissionid) VALUES (?)");
$stmt->bind_param("i", $permissionid);

//execute
$stmt->execute();

$stmt->close();
$conn->close();
?>
