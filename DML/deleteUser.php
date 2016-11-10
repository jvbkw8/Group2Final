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
$stmt = $conn->prepare("DELETE FROM user WHERE id=?");
$stmt->bind_param("i", $userid);

// set parameters 
$userid = $_POST["userid"];

//execute
$stmt->execute();

$stmt->close();
$conn->close();
?>
