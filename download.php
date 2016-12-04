<?php
include "security.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";





$db_link = new mysqli('localhost', 'root', '', 'db');
$query = "select * from files where id={$_GET["id"]};" or die('Error, query failed');;
$result = mysqli_query($db_link, $query);


//data  
$row = mysqli_fetch_assoc($result);
			
$filename = $row['name'];
//$mimetype = $row['mimetype'];
$filedata = $row['data'];
header("Content-length: ".strlen($filedata));
//header("Content-type: 'image/png'");
header("Content-disposition: download; filename=$filename");
//$filedata=addslashes($filedata);
echo $filedata;

mysqli_close($db_link);

exit();

?>
