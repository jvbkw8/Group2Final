<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$input = "test";
$id= "";

// Create connection
$conn = new mysqli($servername, $username, "", $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("select permission_name FROM permission WHERE id=?");
$stmt->bind_param("i", $usertypeid);

//execute
$stmt->execute();
$stmt->bind_result($id);
$stmt->store_result();
$stmt->fetch();
echo $id;
$stmt->close();
$conn->close();
?>
