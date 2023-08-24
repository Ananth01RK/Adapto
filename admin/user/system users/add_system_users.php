<?php
	$title = "Create Staff Accounts";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	if(isset($_POST["submit"]))
	{
		$sysu_created_by = trim($_SESSION["user_id"]);
		extract($_POST);
		$sysu_username = htmlspecialchars(trim($sysu_username));
		$sysu_role = "staff";
		$error_flag = false;

		if( strlen($sysu_username)== 0 || strlen($sysu_created_by)== 0)
		{
			$error_flag = true;
			$_SESSION["error_message"][] = "Please fill in all mandatory fields.";
		}
		if(fetchData(array("table" => "system_users", "condition" => "WHERE sysu_username = '$sysu_username'")))
		{
			$error_flag = true;
			$_SESSION["error_message"][] = "This username already exists, please pick another username.";	
		}
		
				
		if($error_flag === false)
		{
			$sysu_password = sha1("12345678");
			$sql = "INSERT INTO system_users (sysu_username,sysu_password,sysu_role,sysu_created_by,sysu_creation_timestamp) VALUES (:sysu_username,:sysu_password,:sysu_role,:sysu_created_by,NOW())";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":sysu_username", $sysu_username, PDO::PARAM_STR);
			$stmt->bindParam(":sysu_password", $sysu_password, PDO::PARAM_STR);
			$stmt->bindParam(":sysu_role",$sysu_role);
			$stmt->bindParam(":sysu_created_by", $sysu_created_by);
			
			if($stmt->execute())
			{
				$_SESSION["success_message"][] = "Successfully created.";
			}
			else
			{
				$_SESSION["error_message"][] = "Failed to create.";
			}
			//$stmt->debugDumpParams();
		}
		echo "<script>window.location='".$_SERVER["PHP_SELF"]."';</script>";
		exit(0);
	}
?>
<div class="container">
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
	</div>
	<div class="container col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Create System Users</div>
					<div class="panel-body">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="sysu_username" class="highlight">Username</label>
										<input type="text" id="sysu_username" name="sysu_username" class="form-control" placeholder="Username" required autocomplete="off">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="sysu_password" class="highlight">Password</label>
										<input type="text" id="sysu_password" name="sysu_password" class="form-control" placeholder="Password" value="12345678" disabled autocomplete="off">
									</div>
								</div>
							</div>
							<button type="submit" name="submit" id="submit" class="btn btn-primary btn-margin btn-width">Add</button>
							<a href="/adapto/admin/user/dashboard" class="btn btn-danger btn-margin btn-width">Clear</a>
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