<?php
include "security.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
	<title>Upload Manifest</title>
</head>

<body>
<?php
	include "header.php";
?>
<br>
<br>
<?php
	if (isset ($_GET["error"]))
	{
	echo '<div class="alert alert-danger" id="alertbad">';
	echo '<strong>Success!</strong> {$_GET["error"]}.';
	echo '</div>';
	else
	{
	echo '<div class="alert alert-success" id="alertgood">';
	echo '<strong>Success!</strong> All files uploaded.';
	echo '</div>';
	}	
		
		
?>
	
	
<br>
<div class="container">
  <form action="doupload.php" method="post" enctype="multipart/form-data" onsubmit="return checkForm(this)";>
    <input type="file" id="file" name="files[]" multiple="multiple" minFiles="1" />
    <br>
    Manifest Name:
    <br>
    <input type="text" id="inputfield" name="manifestname" />
    <br>
    <br>
    <input class="btn btn-info" type="submit" value="Upload" />
  </form>
</div>

	
<script type="text/javascript">
  function checkForm(form)
  {
    // validation fails if the input is blank
    if(form.inputfield.value == "")
    	{
	alert("No manifest name");
	form.inputfield.focus();
	return false;
    }
   if(form.file.value == "")
   	{
	alert("No files selected");
	form.inputfield.focus();
	return false;   
   	}
  else
  	{
	// validation was successful
	return true;
	}
  }

</script>
	
	
</body>
</html>
