<head>
  <link rel="icon" src="RADS tab.PNG">
</head>
<?php
switch($_SERVER['PHP_SELF']){
  case "/Group2Final/index.php":
      $index_active = "active";
      break;
  case "/Group2Final/upload.php":
      $upload_active = "active";
      break;
  case "/Group2Final/search.php":
      $search_active = "active";
      break;
  case "/Group2Final/account.php":
      $account_active = "active";
      break;
  case "/Group2Final/logout.php":
      $logout = "active";
      break;
}
?>

<div class="container" style="margin-bottom:1em">
  <h2><img src="RADs logo.PNG" width="200px" height="auto"><span style="float:right;"><?php
    $admin = "";
    if(isset($_SESSION['ADMIN']) and $_SESSION['ADMIN'] == 1){
      $admin = "super user ";
    }
    if(isset($_SESSION['NAME'])){
      echo "Welcome ".$admin.$_SESSION['NAME']."!";
    }
    ?></span></h2>
  <br>
  <ul class="nav nav-pills nav-justified">
    <li class="<?=$index_active?>"><a href="index.php">Home</a></li>
    <li class="<?=$upload_active?>"><a href="upload.php">Upload</a></li>
    <li class="<?=$search_active?>"><a href="search.php">Search Manifests</a></li>
    <?php
       if(isset($_SESSION['ADMIN']) and $_SESSION['ADMIN'] == 1){
          ?>
          <li class="<?=$account_active?>"><a href="account.php">Account Manager</a></li>
        <?php
       }
       ?>
    <li class="<?=$logout_active?>"><a href="logout.php">Logout</a></li>
  </ul>
</div>
