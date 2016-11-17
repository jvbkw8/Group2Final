<?php

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

//$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
$max_file_size = 1024*100; //100 kb
//$path = "uploads/"; // Upload directory
//$count = 0;

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
//			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
//				$message[] = "$name is not a valid format";
//				continue; // Skip invalid file formats
//			}
	        else{ // No error found! Move uploaded files 
//	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
//	            $count++; // Number of successfully uploaded file
			echo $name;
			echo " accepted";
			echo "<br>";
			$binaryData = addslashes (file_get_contents($_FILES['files']['tmp_name'][$f]));
			$sql = "INSERT INTO files (data,name) VALUES ('{$binaryData}', '{$name}')";
			echo "<br>";
			echo $sql;

			// prepare and bind
			$stmt = $conn->prepare("INSERT INTO files (data,name) VALUES (?, ?)");
			$stmt->bind_param("ss", $binaryData,  $name);

			//execute
			$stmt->execute();
	        }
	    }
	}
}

$stmt->close();
$conn->close();

?>
