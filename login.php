<?php

	session_start(); // session starts with the help of this function

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">

    <title>RADs Login</title>

   
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="../bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    
    <link href="../bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    
    <link href="app.css" rel="stylesheet">

    
    <script src="../bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
		<script>


		</script>
  </head>

  <body>
  <?php //include "header.php"; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-3"></div>
			<div class="col-md-4 col-sm-4 col-xs-6">
				<h2>Login</h2>
				<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
					<div class="row form-group">
							<input class='form-control' type="text" name="username" placeholder="username">
					</div>
					<div class="row form-group">
							<input class='form-control' type="password" name="password" placeholder="password">
					</div>
					<div class="row form-group">
							<input class=" btn btn-info" type="submit" name="submit" value="Login"/>
					</div>
				</form>

			</div>

		</div>




		
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>