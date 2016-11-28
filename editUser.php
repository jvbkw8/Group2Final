<?php
if(!isset($_POST['id']) || !isset($_POST['action'])){
  echo json_encode(array("error"=>'Required data not sent'));
  exit();
}
header("Content-Type: application/json");
require "DBConn.php";
$conn = new DBConn();
if($conn->connectToDatabase()){
  switch($_POST['action']){
    case "resetPassword":
      echo json_encode(array("success"=> 'Resetting Password'));
      break;
    case "activateUser":
      echo json_encode(array("success"=> 'Activating User'));
      break;
    case "deactivateUser":
      echo json_encode(array("success"=> 'Deactivating User'));
      break;
    case "toggleAdmin":
      echo json_encode(array("success"=> 'Toggling Admin'));
      break;
    default:
      echo json_encode(array("error"=> 'Action requested is not clear. ".$_POST['action']."'"));
  }
} else {
  echo json_encode(array("error"=> 'Could not connect. Try again later'));
}
?>
