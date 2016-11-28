<?php
include "security.php";
?>
<!DOCTYPE html>
<html lang="en">
<style>
	input[type=checkbox] + label {
  color: #ccc;
  font-style: italic;
} 
input[type=checkbox]:checked + label {
  color: #f00;
  font-style: normal;
}
#error, #success{
	position:fixed;
	top:15px;
	right:15px;
	z-index:60000;
}
</style>
<head>
  <title>RADs(Research Analysis and Database for Scientists)</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<?php
	include "header.php";
?>
<div id="error" class="alert alert-danger" style="display:none"><?php echo $_GET['error'];?></div>
<div id="success" class="alert alert-success" style="display:none"><?php echo $_GET['success'];?></div>
<div class="container">
<?php
	require_once "DBConn.php";
	$conn = new DBConn();
	if($conn->connectToDatabase()){
		$q = "SELECT id, username, isadmin, activeuserflag from db.user";
		$rows = $conn->select($q);
		$Yes = "<span style='color:green'>Yes</span>";
		$No = "<span style='color:red'>No</span>";
		if($rows){
			?>
			<table class="table">
				<thead>
					<th>Username</th>
					<th>Active User?</th>
					<th>Admin User?</th>
					<th>Activate/Deactivate</th>
					<th>Admin Control</th>
					<th>Reset Password</th>
				</thead>
				<tbody>
				<?php
				foreach($rows as $row){
				?>
					<tr>
						<td><?php echo $row['username'];?></td>
						<td><?php if($row['activeuserflag']){echo $Yes;} else {echo $No;}?></td>
						<td><?php if($row['isadmin']){echo $Yes;} else {echo $No;}?></td>
						<td><div id="<?php echo $row['id']?>_active" class="btn btn-info" onclick="toggleUserActive(<?php echo $row['id'];?>);"><?php if($row['activeuserflag']){echo "Deactivate";} else {echo "Activate";}?></div></td>
						<td><div id="<?php echo $row['id']?>_admin" class="btn btn-info" onclick="toggleUserAdmin(<?php echo $row['id'];?>);"><?php if($row['isadmin']){echo "De-adminify";} else {echo "Adminify";}?></div></td>
						<td><div id="<?php echo $row['id']?>_password" class="btn btn-info" onclick="resetPassword(<?php echo $row['id'];?>);">Reset Password</div></td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
			<?php
		}
	}
?>
</div>
<script>
	$(document).ready(function(){
		<?php
		if(isset($_GET['error'])){
			?>
			$('#error').show();
			setTimeout(function(){
				$("#error").fadeOut(1000);
			}, 7000);
			<?php
		}
		if(isset($_GET['success'])){
			?>
			$('#success').show();
			setTimeout(function(){
				$("#success").fadeOut(1000);
			}, 7000);
			<?php
		}
		?>
	});
	var timeout;
	function toggleUserActive(id){
		if($('#'+id+'_active').html() == "Activate"){
			var action = "activateUser";
		} else {
			var action = "deactivateUser";
		}
		editUser(id, action);
	}
	
	function resetPassword(id){
		editUser(id, "resetPassword");	
	}
	
	function toggleUserAdmin(id){
		if($('#'+id+"_admin").html() == "Adminify"){
			var action = "adminify";
		} else {
			var action = "deadminify";
		}
		editUser(id, action);
	}
	
	function editUser(id, action){
		$.ajax({
			url:"editUser.php",
			method:"POST",
			data:{id:id, action:action},
			success:function(html){
				if(html.error){
// 					$("#error").html(html.error);
// 					$('#error').show();
					locaton.replace("account.php?error="+html.error);
				}
				if(html.success){
// 					$('#success').html(html.success);
// 					$('#success').show();
					location.replace("account.php?success="+html.success);
				}
			},
			error:function(bla, error, errortext){
// 				$('#error').html("Oops! Something went wrong.");
// 				$('#error').show();
				location.replace("account.php?error=Oops! Something went wrong.");
// 				console.log("ajax error when toggling user active. " + error + " " + errortext);
			},
		});
	}
</script>
</body>
</html>
