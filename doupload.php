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


$max_file_size = 1024*10000; //1mb?



if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	
	//set manifest name for all
	$manifestname = $_POST["manifestname"];
	
	//insert manifest name and get its id
	$stmt = $conn->prepare("INSERT INTO manifest(name) VALUES (?)");
	$stmt->bind_param("s", $manifestname);	
	$stmt->execute();
	$manifestid = mysqli_insert_id($conn);
	
	// for each file
	foreach ($_FILES['files']['name'] as $f => $name) {
		
	//echo $name;
	//echo "<br>";
	//continue;
		
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
			$stmt = $conn->prepare("INSERT INTO files (data,name,owner, manifestid) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("bssi", $null,  $name, $owner, $manifestid);
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
