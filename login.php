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
  </head>

  <body>
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-3"></div>
		<div class="col-md-4 col-sm-4 col-xs-6">
			<h2>Login</h2>
			<form onsubmit="verifyLogin();">
				<div class="row form-group">
						<input id="user" class='form-control' type="text" name="username" placeholder="username">
				</div>
				<div class="row form-group">
						<input id="password" class='form-control' type="password" name="password" placeholder="password">
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
	  <script>
		  function verifyLogin(){
			console.log("attempting to verify login");
			var username = $('#user').val();
			var userpassword = $('#password').val();
			$.ajax(
				url: "verifyLogin.php",
				data: {username:username, userpassword:userpassword},
				method: "POST",
				success: function(html){
					if(html.success == true){
						window.location.replace("index.html");	
					} else {
						alert(html);
					}
				},
				error: function(html){
					console.log("error: " + html);
				}
			);	  
		  }
	  </script>
  </body>
</html>
