<?php
include "security.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>RADs(Research Analysis and Database for Scientists)</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<?php
	include "header.php";
?>
<div class="container">
  <p> Firstname: </p>
  <p> Lastname: </p>
  <input type = "checkbox" name = "user" value = "active"><p> username: <?php echo $_SESSION['NAME'];?></p>
</div>

</body>
</html>
