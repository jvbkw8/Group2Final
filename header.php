<?php
echo $_SERVER['PHP_SELF'];
switch($_SERVER['PHP_SELF']){
  case "/index.php":
      $index_active = "active";
      break;
  case "/upload.php":
      $upload_active = "active";
      break;
  case "/search.php":
      $search_active = "active";
      break;
  case "/account.php":
      $account_active = "active";
      break;
  case "/logout.php":
      $logout = "active";
      break;
}    
?>

<div class="container">
  <h2>Upload Manifest</h2>
  <br>
  <ul class="nav nav-pills nav-justified">
    <li class="<?=$index_active?>"><a href="index.php">Home</a></li>
    <li class="<?=$upload_active?>"><a href="upload.php">Upload</a></li>
    <li class="<?=$search_active?>"><a href="search.php">Search Manifests</a></li>
    <li class="<?=$account_active?>"><a href="account.php">Account</a></li>
    <li class="<?=$logout_active?>"><a href="logout.php">Logout</a></li>
  </ul>
</div>
