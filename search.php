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

<title>Search Manifests</title>
</head>


<body>

<div class="container">
  <h2>Search Manifests</h2>
  <br>
  <ul class="nav nav-pills nav-justified">
    <li><a href="index.html">Home</a></li>
    <li><a href="upload.php">Upload</a></li>
    <li class="active"><a href="#">Search Manifests</a></li>
    <li><a href="account.php">Account</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</div>

<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-10 col-xs-310"></div>
			<div class="col-md-8 col-sm-10 col-xs-10">
				<h2></h2>
				<form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
					<div class="form-group row">
					  <label for="example-first-input" class="col-xs-2 col-form-label">By filename:</label>
					  <div class="col-xs-10">
					  <input class="form-control" type="text" placeholder="" id="filename">
					  <br>
					  </div>
					</div>
					<div class="form-group row">
						<label for="example-last-input" class="col-xs-2 col-form-label">By Username: </label>
						<div class="col-xs-10">
							<input class="form-control" type="text" placeholder="" id="byname">
							<br>
					</div>
					</div>
					<br>
					<div class="row form-group">
					  <a href="searchResult.php" class=" btn btn-info" type="submit" name="" value="login">Search</a>
					</div>
				</form>
		</div>
			</div>
</div>
		

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
