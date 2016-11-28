<?php
//gets file id via post from search screen table and deletes data
//nathan hensel
include "security.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$db_link = new mysqli('localhost', 'root', '', 'db');
$query = "delete from files where id={$_POST["id"]};" or die('Error, query failed');;
$result = mysqli_query($db_link, $query);

mysqli_close($db_link);
exit();
?>
