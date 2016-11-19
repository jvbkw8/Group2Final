<?php
include "security.php";
if(!$_SESSION['ADMIN']){
  header("Location: login.php");
}
?>
<script>
  var loginCredentials = [
    {test:true, username:"", userpassword:"",expected:false}, //no username or password
    {test:true, username:"", userpassword:"test", expected:false},//no username
    {test:true, username:"testing", userpassword: "invalidpassword", expected:false}, //valid username, invalid password
    {test:true, username:"testing", userpassword: "test", expected:true}, //valid username and password
    {test:true, username:"tesTIng", userpassword: "test", expected:false}, //username with capitals changed, password that would work for username: testing
    {test:true, username:"testing", userpassword: "teSt", expected:false}, //valid username, password with capitals changed
    {test:true, username:"admin", userpassword: "admin", expected:true}, //another valid username and password
    {test:true, username:"admin;delete from user where username = 'testing';", userpassword:"admin", expected:false}, //sql injection!!!
    {test:true, username:"testing", userpassword: "test", expected:true} //test if the known account is still there after the sql injection attempt
  ]
  for(var i = 0; i < loginCredentials.length; i++){
    $.ajax({
      url:"loginVerify.php",
      data: loginCredentials[i],
      success: function(html){
        $('#results').append($('<div>').html("success: " + html.success + "   username: " + html.name + "   isadmin: " + html.isadmin + "   dberrors: " + html.error));
      },
      error: function(html){
        console.log("ajax error");
      }
    });
  }
</script>
<div id="results">
</div>
