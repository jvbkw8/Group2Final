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
if(isset($_POST['deleteid']))
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
			<div class="col-md-6 col-sm-10 col-xs-10">
				<div class="col-md-5">
				<form action="/Group2Final/search.php" method="post">				
					  <label for="example-first-input" class=" col-form-label">By Filename:</label>			 
					  <br>
					  <input class="form-control" type="text" placeholder="" name="searchname" value="<?php if(isset($_POST['searchname'])){echo $_POST['searchname'];}?>">
					  <br>
					  <br>
					  <input type="submit" value="Search" class="btn btn-info">
				</form>


				<br>
				<br>
				<form action="/Group2Final/search.php" method="post">
					  <label for="example-first-input" class="col-form-label">By Username:</label>
					  <br>						  
					  <input class="form-control" type="text" placeholder="" name="searchowner" value="<?php if(isset($_POST['searchowner'])){echo $_POST['searchowner'];}?>">
					  <br>
					  <br>
					  <input type="submit" value="Search" class="btn btn-info">
				</form>
				<br>
				<br>
				<form action="/Group2Final/search.php" method="post">
					  <label for="example-first-input" class="col-form-label">By Manifest:</label>
					  <br>						  
					  <input class="form-control" type="text" placeholder="" name="searchmanifest" value="<?php if(isset($_POST['searchmanifest'])){echo $_POST['searchmanifest'];}?>">
					  <br>
					  <br>
					  <input type="submit" value="Search" class="btn btn-info">
				</form>
				</div>
			</div>
			<div class="col-md-6 col-sm-10 col-xs-10">
<?php
//This block gets all the files and constructs a table.  more to come
	$db_link = new mysqli('localhost', 'root', '', 'db');

	if(isset($_POST['searchowner']))
		{
		$query = "select files.*, manifest.name as manifestname from files left join manifest on files.manifestid = manifest.id where owner LIKE '%{$_POST["searchowner"]}%';";
		}
	elseif(isset($_POST['searchname']))
		{
		$query = "select files.*, manifest.name as manifestname from files left join manifest on files.manifestid = manifest.id where files.name LIKE '%{$_POST["searchname"]}%';";
		}
	elseif(isset($_POST['searchmanifest']))
		{
		$query = "select files.*, manifest.name as manifestname from files left join manifest on manifest.id = files.manifestid where manifest.name LIKE '%{$_POST["searchmanifest"]}%';";
		}
	else
		{
		$query = "select files.*, manifest.name as manifestname from files left join manifest on manifest.id = files.manifestid;";
		}

	if ($result = mysqli_query($db_link, $query)){
		?>
		<table>
			<tr>
				<th>File Name</th>
				<th>Owner</th>
				<th>Get File</th>
				<th>View Manifest</th>
				<th>Manifest Name</th>
				<th>Delete File?</th>
			</tr>
				
		<?php
		//data  
		while ($row = mysqli_fetch_assoc($result))
		{
			//echo print_r($row);continue;
		     $manifestname = (isset($row['manifestname']))?$row['manifestname']:"";
		     ?>
			<tr>
				<td><?php echo $row["name"];?></td>
				<td><?php echo $_SESSION['NAME'];?></td>
				<td><a href='download.php?id=<?php echo $row["id"];?>' class='btn btn-info'>Download</a></td>
				<td><form action='search.php' method='post'><button type="submit" name='searchmanifest' class='btn btn-info' value='<?php echo $row['manifestname'];?>'>View Files From This Manifest</button></form></td>
				<td><?php echo $manifestname;?></td>
				<?php
				if($row["owner"] == $_SESSION['NAME'] || (isset($_SESSION['ADMIN']) && $_SESSION['ADMIN'] == 1)){
					?>
					<td><form action='search.php' method='post'><button type='submit' name='deleteid' value="<?php echo $row["id"];?>" class='btn btn-info'>Delete</button></form></td>
					<?php
				} else {
					?>
					<td></td>
					<?php
				}
			?>
			</tr>
			<?php
		    }
		?>
		</table>
		<?php
		    mysqli_free_result($result);
		    mysqli_close($db_link);
	}
	?>
		</div>
	</div>
</div>
		

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
