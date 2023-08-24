<?php
	$title = "Change Password";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	
	if(isset($_POST["submit"]))
	{
		$sysu_id = $_SESSION['user_id'];
		$error_flag = false; 
		
		if(empty($_POST['new_password']) || empty($_POST['confirm_password']) || empty($_POST['current_password']))
		{
			$_SESSION["error_message"][] = "Please fill in all mandatory fields.";
		}
		if($data = "SELECT * system_users WHERE sysu_id='$sysu_id'")
		{
			$result_set = $db->prepare($data);
			$datas = array();
			if($result_set->rowCount()){
				$datas = $result_set->fetchAll(PDO::FETCH_ASSOC);
				if(sha1($_POST['current_password']) != $datas[0]['sysu_password'])
				{
					$error_flag = true;
					$_SESSION["error_message"][] = "Old password isn't matching.";
				}
				if(sha1($_POST['new_password']) == $datas[0]['sysu_password'])
				{
					$error_flag = true;
					$_SESSION["error_message"][] = "Old password and new password can't be same.";
				}
			}
		}
		if(strlen($_POST['new_password']) <= 7)
		{
			$error_flag = true;
			$_SESSION["error_message"][] = "Password must be of at least 8 characters.";
		}
		if($_POST['current_password'] == $_POST['new_password'])
		{
			$error_flag = true;
			$_SESSION["error_message"][] = "The old password and new password cannot be same.";
		}
		if($_POST['new_password'] != $_POST['confirm_password'])
		{
			$error_flag = true;
			$_SESSION["error_message"][] = "The new password and confirmation password aren't matching.";
		}
		if($error_flag === false)
		{
			$new_password = sha1($_POST['new_password']);
			$sql = "UPDATE system_users SET sysu_password = '$new_password' WHERE sysu_id= '$sysu_id'";
			$stmt = $db->prepare($sql);

			if($stmt->execute())
			{
				$_SESSION["success_message"][] = "Password changed successfully.";
			}
			else
			{
				$_SESSION["error_message"][] = "Failed to change.";
			}
		}
		echo "<script>window.location='".$_SERVER["PHP_SELF"]."';</script>";
		exit(0);
	}
?>
<div class="container">
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Change Password <i class="fa fa-key" aria-hidden="true"></i></div>
					<div class="panel-body">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="form-group">
								<label for="current_password">Old Password</label>
								<input type="password" id="current_password" name="current_password" class="form-control" required placeholder="Old Password" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="new_password">New Password</label>
								<input type="password" id="new_password" name="new_password" class="form-control" required placeholder="New Password" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="confirm_password">Confirm Password</label>
								<input type="password" id="confirm_password" name="confirm_password" class="form-control" required placeholder="Confirm Password" autocomplete="off">
							</div>
							<div>
								<label class="checkbox-block" for="show-passwords">
									<input type="checkbox" name="show-passwords" id="show-passwords">
									Show passwords
								</label>
							</div>
							<button type="submit" name="submit" id="submit" class="btn btn-primary btn-margin">Change</button>
							<a href="/adapto/admin/user/dashboard.php" class="btn btn-danger btn-margin">Cancel</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/footer.php");
?>
<script>
const showPass = document.querySelector('#show-passwords');

const allPass = Array.prototype.slice.call(document.querySelectorAll('[type=password]'));

function toggleInputType(checkbox, inputField) {
  inputField.type = checkbox.checked ? 'text' : 'password';
}
function toggleAllPasswords() {
  
  allPass.forEach(eachPass => {    
    toggleInputType(this, eachPass);
  });
  
}
showPass.addEventListener('change', toggleAllPasswords);
</script>