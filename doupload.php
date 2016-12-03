<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, "", $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$max_file_size = 1024*1000; //1mb?

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }

	        else{ // No error found
			//for each file do these things
			$binaryData = file_get_contents($_FILES['files']['tmp_name'][$f]);
			$owner = $_SESSION['NAME'];
			$null = NULL;
			// prepare and bind
			$stmt = $conn->prepare("INSERT INTO files (data,name,owner) VALUES (?, ?, ?)");
			$stmt->bind_param("bss", $null,  $name, $owner);
			
			$stmt->send_long_data(0, $binaryData);	//this made it all work
				
			$stmt->execute();
	        }
	    }
	}
}

$stmt->close();
$conn->close();
header( 'Location: /Group2Final/upload.php' ) ;
?>
