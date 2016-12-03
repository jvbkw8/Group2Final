<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $('head').ready(function(){
        $('head').append($("<link rel='shortcut icon' href='RADstab.ico'>"));
    });
</script>
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
      $logout_active = "active";
      break;
    case "/Group2Final/login.php":
        $login_active = "active";
        break;
    case "/Group2Final/signup.php":
        $signup_active = "active";
        break;
}
?>
<div style="width:100%; height:100%; overflow-y:none">
<div style="border-bottom:1px solid black;padding-bottom:1em; position:fixed; top:0px; width:100%; z-index:50000; background-color:white;">
    <h2><a href="index.php"><img src="RADs logo.PNG" width="200px" height="auto"></a><span style="padding:20px 25px 0px 0px;float:right;"><?php
    $admin = "";
    if(isset($_SESSION['ADMIN']) and $_SESSION['ADMIN'] == 1){
      $admin = "super user ";
    }
    if(isset($_SESSION['NAME'])){
      echo "Welcome ".$admin.$_SESSION['NAME']."!";
    }
    ?></span></h2>
  <ul class="nav nav-pills nav-justified" style="position:relative; margin-top:-5em;width:800px; margin-left:auto; margin-right:auto">
    <li class="<?=$index_active?>"><a href="index.php">Home</a></li>
    <li class="<?=$upload_active?>"><a href="upload.php">Upload</a></li>
    <li class="<?=$search_active?>"><a href="search.php">Search Manifests</a></li>
    <?php
       if(isset($_SESSION['ADMIN']) and $_SESSION['ADMIN'] == 1){
          ?>
          <li class="<?=$account_active?>"><a href="account.php">Account Manager</a></li>
        <?php
       }
        if(isset($_SESSION['NAME'])){
       ?>
        <li class="<?=$logout_active?>"><a href="logout.php">Logout</a></li>
       <?php
        } else {
         ?>
          <li class="<?=$login_active?>"><a href="login.php">Login</a></li>
          <li class="<?=$signup_active?>"><a href="signup.php">Sign Up</a></li>
          <?php
        }
        ?>
  </ul>
</div>
<div class="container" style="margin-top:150px; width:100%">
    <div class="container" style="width:100%; height:100%; overflow-y:auto">
