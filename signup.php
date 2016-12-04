<?php
session_start();
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">

    <title>RADs Signup</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
  </head>

  <body>
	  <?php
	  include "header.php";
	  ?>
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-3"></div>
		<div class="col-md-4 col-sm-4 col-xs-6">
			<h2>Sign Up</h2>
			<form action="signupVerify.php" method="POST">
				<div class="row form-group">
						<input id="user" class='form-control' type="text" name="username" placeholder="username">
				</div>
				<div class="row form-group">
						<input id="password" class='form-control' type="password" name="userpassword" placeholder="password">
				</div>
        <div class="row form-group">
          <input id="password-confirm" class="form-control" type="password" name="password_confirm" placeholder="confirm password">
          </div>
				<div class="row form-group">
						<input class=" btn btn-info" type="submit" name="submit" value="Sign Up"/>
				</div>
			</form>
		</div>
	  </div>
	  <div class="row">
		  <div class="col-md-4 col-sm-4 col-xs-3"></div>
		  <div id="error" class="alert alert-danger col-md-4 col-sm-4 col-xs-6" style="display:none"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></div>
	  </div>
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
	<script>
		$(document).ready(function(){
			if($("#error").html() != ""){
				$("#error").toggle();
			}
		});
	</script>
</html>
