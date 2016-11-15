<?php
    $user_name = $_POST['username'];
    $user_password = $_POST['userpassword'];
    $user_password_confirm = $_POST['password_confirm'];
    if(!$user_name or !$user_password or !$user_password_confirm){
      header("Location: signup.php?error=Please fill in all fields");
        exit();
    }
    if($user_password != $user_password_confirm){
      header("Location: signup.php?error=Passwords must match");
        exit();
    }
    include "connection.php";
    $conn = new mysqli($servername, $username, $password);
    $usernamecheck = "select * from db.user where username = '$user_name';";
    //echo $usernamecheck;
    $result = $conn->query($usernamecheck);
    if($result->num_rows != 0){
        header("Location: signup.php?error=Username already exists");
        exit();
    }
    $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);
    $sql = "INSERT into db.user (username, hashedpassword) values ('$user_name', '$hashedPassword');";
    //echo $sql;exit();
    $conn->query($sql);
    if($conn->affected_rows != 1){
      header("Location: signup.php?error=Information not stored");
        exit();
    }
    session_start();
    $_SESSION[NAME] = $user_name;
    header("Location: index.php");
?>
