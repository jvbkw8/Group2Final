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
$stmt = $conn->prepare("select id from user WHERE username=? AND password=?");
$stmt->bind_param("ss", $input,  $input);


//execute
$stmt->execute();

$stmt->bind_result($id);
$stmt->store_result();
$stmt->fetch();

echo $id;

$stmt->close();
$conn->close();

?>
