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
$stmt = $conn->prepare("DELETE FROM file WHERE groupid =?)");
$stmt->bind_param("i", $groupid);

//execute
$stmt->execute();
$stmt->close();
$conn->close();
///filesystem operations still need to be dealt with
?>
