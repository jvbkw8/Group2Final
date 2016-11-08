<?php

//	session_start(); // session starts with the help of this function

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

    <title>RADs Login</title>

   
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
    
    <!--<link href="../bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->

    
    <!--<link href="app.css" rel="stylesheet">-->

    
    <!--<script src="../bootstrap/assets/js/ie-emulation-modes-warning.js"></script>-->
		<script>


		</script>
  </head>

  <body>
  <?php //include "header.php"; ?>
	<div class="container">
		<?php
            $action = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['username'] == ''/*something in database*/ && 
                  $_POST['password'] == '' /*corresponding to username in database*/) {
                //  go to logged in opening page
                 
               }else {
                  $action = 'Wrong username or password';
               }
            }
         ?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
