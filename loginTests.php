<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
  var loginCredentials = [
    {test:true, username:"", userpassword:"",expected:"false"}, //no username or password
    {test:true, username:"", userpassword:"test", expected:"false"},//no username
    {test:true, username:"testing", userpassword: "invalidpassword", expected:"false"}, //valid username, invalid password
    {test:true, username:"testing", userpassword: "test", expected:"true"}, //valid username and password
    {test:true, username:"tesTIng", userpassword: "test", expected:"false"}, //username with capitals changed, password that would work for username: testing
    {test:true, username:"testing", userpassword: "teSt", expected:"false"}, //valid username, password with capitals changed
    {test:true, username:"admin", userpassword: "admin", expected:"true"}, //another valid username and password
    {test:true, username:"admin;delete from user where username = 'testing';", userpassword:"admin", expected:"true"}, //sql injection!!!
    {test:true, username:"testing", userpassword: "test", expected:"true"} //test if the known account is still there after the sql injection attempt
  ]
  for(var i = 0; i < loginCredentials.length; i++){
    $.ajax({
      url:"loginVerify.php",
      data: loginCredentials[i],
      method: "POST",
      success: function(html){
        var newRow = $('<tr>');
        var testPassed = "success";
        if(html.test_passed == "false"){
          testPassed = "danger";
        }
        newRow.append($('<td>').html(html.test_passed))
          .append($('<td>').html(html.login_success))
          .append($('<td>').html(html.login_expected))
          .append($('<td>').html(html.username))
          .append($('<td>').html(html.isadmin))
          .append($('<td>').html(html.error))
          .addClass(testPassed);
        $('#results').append(newRow);
      },
      error: function(jqxhr, errortext, errornum){
        console.log("ajax error: " + errortext);
      }
    });
  }
</script>
<head> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<table id="results" class="table table-bordered table-hover table-striped">
  <thead>
    <th>Test Passed</th>
    <th>Login Success</th>
    <th>Expected Success?</th>
    <th>Username</th>
    <th>Admin?</th>
    <th>DB Errors</th>
  </thead>
</table>
