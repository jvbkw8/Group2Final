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

<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-10 col-xs-310"></div>
			<div class="col-md-8 col-sm-10 col-xs-10">
				<h2></h2>
				<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
					<div class="form-group row">
						<label for="example-first-input" class="col-xs-2 col-form-label">Username:</label>
						<div class="col-xs-10">
							<input class="form-control" type="text" placeholder="username" id="username">
							<br>
					</div>
					</div>
					<div class="form-group row">
  						<label for="example-date-input" class="col-xs-2 col-form-label">Date</label>
 						<div class="col-xs-10">
							 <input class="form-control" type="date" value="2016-01-01" id="example-date-input">
							 <br>
 					 </div>	
 					 </div>
					<form method="post" enctype="multipart/form-data">
            <input type="file" name="my_file[]" multiple>
        </form>
        <?php
            if (isset($_FILES['my_file'])) {
                $myFile = $_FILES['my_file'];
                $fileCount = count($myFile["name"]);

                for ($i = 0; $i < $fileCount; $i++) {
                    ?>
                        
                    <?php
                }
            }
        ?><br>
					<div class="row form-group">
							<a href="index.html" class=" btn btn-info" type="submit" name="login" value="login">Submit</a>
					</div>
				</form>
		</div>
			</div>
</div>
		</div>
</div>	</div> </div>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
