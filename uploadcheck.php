<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
</head>
<title>Upload Check</title>
<?php
	require('./login.php'); //Login page must exist
	
	//If no session exists
	if(!$_SESSION) echo "You are not logged in. Please log in and try again.";
	
$target_dir = "./docs/uploads/";
$target_file = $target_dir . basename($_FILES["my_file"]["name"]); //Name of file
$allowedExts = array("doc", "docx"); //Allow both
$extension = end(explode(".", $_FILES["my_file"]["name"]);
$upload_max_filesize = 1000000000; //1GB worth of information
$max_file_uploads = 10; //NEEDS DISCUSSION - Number of uploaded files available for one upload session

if(($_FILES["my_file"]["type"] == "application/msword") //doc
	|| ($_FILES["my_file"]["type"] -- "application/vnd.openxmlformats-officedocument.wordprocessingml.document") //docx
	&& ($_FILES["my_file"]["size"] < $upload_max_filesize )) // Less than 1 GB & End if

	if($_FILES == NULL) echo "Please choose a file to submit.";

	if ($_FILES["my_file"]["error"] == 0) echo "Uploaded document successfully"; //Success
	if ($_FILES["my_file"]["error"] == 4) echo "You need to add a file to upload!"; //Fail
	if ($_FILES["my_file"]["error"] != 0 && $_FILES["file"]["error"] != 4) echo "File failed to upload"; //Fail

?>

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
<body>
<script>
</script>
</body>
</html>