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
$stmt = $conn->prepare("INSERT INTO file (groupid, path, activeuserflag) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sss", $username, $hashedpassword, $usertypeid, $activeuserflag);
//execute
$stmt->execute();
$stmt->close();
$conn->close();
?>
