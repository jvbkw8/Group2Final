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
      $newPassword = password_hash("password123", PASSWORD_DEFAULT);
      $q = "UPDATE db.user SET hashedpassword = ? where id = ?";
      if($conn->update($q, $newPassword, $_POST['id'])){
        echo json_encode(array("success"=> 'Password is now password123'));        
      } else {
        echo json_encode(array("error"=> 'Password not reset'));
      }
      break;
    case "activateUser":
      $q = "UPDATE db.user SET activeuserflag = ? where id = ?";
      if($conn->update($q, "1", $_POST['id'])){
        echo json_encode(array("success"=> 'User activated'));
      } else {
        echo json_encode(array("error"=> 'User activation failed'));
      }
      break;
    case "deactivateUser":
      $q = "UPDATE db.user SET activeuserflag = ? where id = ?";
      if($conn->update($q, "0", $_POST['id'])){
        echo json_encode(array("success"=> 'User deactivated'));
      } else {
        echo json_encode(array("error"=> 'User deactivation failed'));
      }
      break;
    case "adminify":
      $q = "UPDATE db.user SET isadmin = ? where id = ?";
      if($conn->update($q, '1', $_POST['id'])){
        echo json_encode(array("success"=> 'User is now an admin'));
      } else {
        echo json_encode(array("error"=> 'Adminification failed'));
      }
      break;
    case "deadminify":
      $q = "UPDATE db.user SET isadmin = ? where id = ?";
      if($conn->update($q, '0', $_POST['id'])){
        echo json_encode(array("success"=> 'User is no longer an admin'));
      } else {
        echo json_encode(array("error"=> 'De-admnification failed'));
      }
      break;
    default:
      echo json_encode(array("error"=> 'Action requested is not clear. '.$_POST['action']));
  }
} else {
  echo json_encode(array("error"=> 'Could not connect. Try again later'));
}
?>
