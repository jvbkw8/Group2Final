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
<div id="error" class="alert alert-danger" style="display:hidden"></div>
<div id="success" class="alert alert-success" style="display:hidden"></div>
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
						<td><?php=$row['username']?></td>
						<td><?php if($row['activeuserflag']){echo $Yes;} else {echo $No;}?></td>
						<td><?php if($row['isadmin']){echo $Yes;} else {echo $No;}?></td>
						<td><div id="<?php=$row['id']?>_active" class="btn btn-info" onclick="toggleUserActive(<?php echo $row['id'];?>);"><?php if($row['activeuserflag']){echo "Deactivate";} else {echo "Activate";}?></div></td>
						<td><div class="btn btn-info"></div></td>
						<td><div clsss="btn btn-info">Reset Password</div></td>
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
	function toggleUserActive(id){
		if($('#'+id+'_active').is(":checked")){
			var action = "activateUser";	
		} else {
			var action = "deactivateUser";
		}
		editUser(id, action);
	}
	
	function resetPassword(id){
		editUser(id, "resetPassword");	
	}
	
	function editUser(id, action){
		$.ajax({
			url:"editUser.php",
			method:"POST",
			data:{id:id, action:action},
			success:function(html){
				JSON.parse(html);
				if(html.error){
					$("#error").html(html.error);
				}
				if(html.success){
					$('#success').html(html.success);
				}
			},
			error:function(){
				$('#error').html("Oops! Something went wrong.");
				console.log("ajax error when toggling user active");
			},
		});
		$("#error").hide(7000);
		$("#success").hide(7000);
	}
</script>
</body>
</html>
