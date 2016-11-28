<?php
include "security.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
?>

<?php
//gets file id via post from search screen table and deletes data
//nathan hensel
if(isset($_POST['deleteid'])
	{
	$db_link = new mysqli('localhost', 'root', '', 'db');
	$query = "delete from files where id={$_POST["deleteid"]};" or die('Error, query failed');;
	$result = mysqli_query($db_link, $query);

	mysqli_close($db_link);

	header( 'Location: /Group2Final/search.php' ) ;
	exit();
	}
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

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 50%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

<body>
<?php
	include "header.php";
?>

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
<?php
//This block gets all the files and constructs a table.  more to come
	$db_link = new mysqli('localhost', 'root', '', 'db');
	$query = "select * from files;";
	if ($result = mysqli_query($db_link, $query)){

	echo "<table>";
    	//header
	echo "<tr>";
	echo "<th>File Name</th>";
	echo "<th>File ID</th>";
	echo "<th>Owner</th>";
	echo "<th>Get File</th>";
	echo "<th>View Manifest</th>";
	echo "</tr>";

	//data  
                     while ($row = mysqli_fetch_assoc($result))
			{
			if ($row["owner"] == $_SESSION['NAME'])
				{
				echo "<tr><td>{$row["name"]}</td><td>{$row["id"]}</td><td><form action='search.php' method='post'><button type='submit' name='id' value={$row["id"]} class='btn btn-info'>Delete</button></form></td><td><a href='download.php?id={$row["id"]}' class='btn btn-info' type='submit' name='' value='download'>Download</a></td><td><a href='dosomethingelse.php' class='btn btn-info' type='submit' name='' value=''>View</a></td></tr>";
				}
			else
				{
				echo "<tr><td>{$row["name"]}</td><td>{$row["id"]}</td><td>{$row["owner"]}</td><td><a href='download.php?id={$row["id"]}' class='btn btn-info' type='submit' name='' value='download'>Download</a></td><td><a href='dosomethingelse.php' class='btn btn-info' type='submit' name='' value=''>View</a></td></tr>";
				}

                    	} 

                    echo "</table>";
            }

            mysqli_free_result($result);
            mysqli_close($db_link);
?>








</div>
		

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
