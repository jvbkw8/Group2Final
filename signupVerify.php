<?php
    $user_name = $_POST['username'];
    $user_password = $_POST['userpassword'];
    $user_password_confirm = $_POST['password_confirm'];
    if(!$user_name or !$user_password or !$user_password_confirm){
      header("Location: signup.php?error=Please fill in all fields");
    }
    if($user_password != $user_password_confirm){
      header("Location: signup.php?error=Passwords must match");
    }
    include "connection.php";
    $conn = new mysqli($servername, $username, $password);
    $hashedPassword = password_hash($user_password);
    $sql = "INSERT into (username, hashedpassword) values ($user_name, $hashedPassword);";
    $conn->query($sql) or header("Location: signup.php?error=Connection error");
    if($conn->affected_rows != 1){
      header("Location: signup.php?error=Information not stored");
    }
    header("Location: login.php");
?>
