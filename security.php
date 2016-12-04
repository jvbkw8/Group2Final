<?php
session_start();
$requireLogin = false;
if(!isset($_SESSION['NAME'])){
  $requireLogin = true;
} else {
  include "connection.php";
  $conn = new mysqli($servername, $username, $password, $dbname);
  $query = "SELECT * from user where BINARY username = '".$_SESSION['NAME']."' and activeuserflag = 1";
  $r = mysqli_query($conn, $query);
  if($r->num_rows != 1){
     $requireLogin = true;
  }
  
}
if($requireLogin){
  header("Location: /Group2Final/login.php");
}
?>
