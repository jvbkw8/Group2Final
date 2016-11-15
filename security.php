<?php
session_start();
if(!isset($_SESSION['NAME'])){
  header("Location: /Group2Final/login.php");
}
?>
