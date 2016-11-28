<?php
if(!isset($_POST['id']) || !isset($_POST['action'])){
  echo "{error: 'Required data not sent'}";
  exit();
}
require "DBConn.php";
$conn = new DBConn();
if($conn->connectToDatabase()){
  switch($_POST['action']){
    case "resetPassword":
      break;
    case "activateUser":
      break;
    case "deactivateUser":
      break;
    case "toggleAdmin":
      break;
    default:
      echo "{error: 'Action requested is not clear. ".$_POST['action']."}";
  }
} else {
  echo "{error: 'Could not connect. Try again later'}";
}
?>
