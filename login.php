<?php

	session_start(); // session starts with the help of this function

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">

    <title>JAWAZ's Site</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="app.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
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




		<?php


		if(isset($_POST['submit'])) {

				$link = mysqli_connect("localhost", "root", "P@s5w0rd", "finproject") or die ("Connection Error " . mysqli_error($link));
				$sql = "SELECT username, hashed_password, p.pid FROM employee NATURAL JOIN employee_has_permissions AS p WHERE LOWER(username) LIKE LOWER(?);";

				if ($stmt = mysqli_prepare($link, $sql)) {
					$user = $_POST['username'];
					$pass = $_POST['password'];

					mysqli_stmt_bind_param($stmt, "s", $user) or die("bind param");
					if(mysqli_stmt_execute($stmt)) {


					}
					else {
						echo "<h4>Failed</h4>";

					}
					$result = mysqli_stmt_get_result($stmt);
					$row = mysqli_fetch_assoc($result);

					if(password_verify($pass, $row['hashed_password'])){

						$_SESSION["username"] = $user;
						$_SESSION["loggedin"] = 1;
						$_SESSION['pid'] = $row['pid'];

						header("Location: inventory.php");
					}
					else{
						echo "Incorect Credentials";

					}


				}
				else {
					die("prepare failed");
				}
				mysqli_stmt_close($stmt);
				mysqli_close($link);
			}

		?>
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