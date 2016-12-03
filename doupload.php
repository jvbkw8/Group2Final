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


$max_file_size = 1024000*10000; //1mb?


$numFilesNotUploaded = 0;
$numFilesUploaded = 0;
$error = array();
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	
	//set manifest name for all
	$manifestname = $_POST["manifestname"];
	
	$stmt = $conn->prepare("SELECT name FROM manifest where name = ?");
	$stmt->bind_param("s", $manifestname);
	if(!$stmt->execute()){
		$error[] = "Problem when checking if manifest name exists";
	}
	$mcheck = "";
	$stmt->bind_result($mcheck);
	while($stmt->fetch()){
		$error[] = "Manifest name ".$mcheck." already exists.";
	}
	//insert manifest name and get its id
	$stmt = $conn->prepare("INSERT INTO manifest(name) VALUES (?)");
	$stmt->bind_param("s", $manifestname);	
	if(!$stmt->execute()){
		$error[] = "Manifest name not stored.";
		break;
	}
	$manifestid = mysqli_insert_id($conn);
	
	if(count($error) == 0){
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
			    $error[] = "$name is too large!";
			    continue; // Skip large files
			}

			else{ // No error found
				//for each file do these things
				$binaryData = file_get_contents($_FILES['files']['tmp_name'][$f]);
				$owner = $_SESSION['NAME'];
				$null = NULL; //this made it all work

				// prepare and bind
				$stmt = $conn->prepare("INSERT INTO files (data, name, owner, manifestid) VALUES (?, ?, ?, ?)");
				$stmt->bind_param("bssi", $null,  $name, $owner, $manifestid);
				$stmt->send_long_data(0, $binaryData);	//this made it all work	
				if(!$stmt->execute()){
					$numFilesNotUploaded++;
				} else {
					$numFilesUploaded++;
				}
			}
		    }
		}
	}
} else {
	$error[] = "No files uploaded.";
}
if($numFilesUploaded == 0){
	$error[] = "No files uploaded";
}
if($numFilesNotUploaded > 0){
	$plural = ($numFilesNotUploaded > 1)? "s":"";
	$error[] = $numFilesNotUploaded." file".$plural." not uploaded.";
}
foreach($error as $msg){
	$errorMsg .= $msg."<br>";	
}
if(isset($errorMsg)){
	$errorMsg = rtrim($errorMsg, "<br>");
}

$stmt->close();
$conn->close();
if(isset($errorMsg)){
	header( 'Location: /Group2Final/upload.php?error='.$errorMsg ) ;
}else if{
	header('Location: /Group2Final/upload.php?success='.$numFilesUploaded);
}
?>
