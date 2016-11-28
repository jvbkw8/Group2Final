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
      echo "{success: 'Resetting Password'}";
      break;
    case "activateUser":
      echo "{success: 'Activating User'}";
      break;
    case "deactivateUser":
      echo "{success: 'Deactivating User'}";
      break;
    case "toggleAdmin":
      echo "{success: 'Toggling Admin'}";
      break;
    default:
      echo "{error: 'Action requested is not clear. ".$_POST['action']."}";
  }
} else {
  echo "{error: 'Could not connect. Try again later'}";
}
?>
