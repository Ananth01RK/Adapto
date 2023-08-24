<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	
	if(isset($_POST["login"]))
	{
		$_POST = array_map("trim", $_POST);
		$_POST = array_map("addslashes", $_POST);
		$sysu_username = $_POST["sysu_username"];
		$sysu_password = sha1($_POST["sysu_password"]);
		$error_flag = false;
		if(strlen($sysu_username)== 0 || strlen($sysu_password) == 0)
		{
			$error_flag = true;
			$_SESSION["error_message"][] = "Please fill all details";
		}
		
		if($error_flag === false)
		{
			$sql = "SELECT * FROM system_users WHERE sysu_username=:sysu_username AND sysu_password=:sysu_password";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":sysu_username", $sysu_username, PDO::PARAM_STR);
			$stmt->bindParam(":sysu_password", $sysu_password, PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount())
			{
				$result_set = $stmt->fetch(PDO::FETCH_ASSOC);
				if($result_set["sysu_disabled_flag"] == '1' || $result_set["sysu_retired_flag"] == '1')
				{
					$_SESSION["error_message"][] = "There's some error.Please contact with admin";
				}
				else if($result_set["sysu_first_time_flag"] == '0')
				{
					$result_set = array_map("trim", $result_set);
					$_SESSION["user_id"] = $result_set["sysu_id"];
					$_SESSION["sysu_role"] = explode("|", strtolower($result_set["sysu_role"]));
					$staff_status = '0';
					$sql_new = "INSERT INTO staffs (sysu_id,staff_status,created_by,creation_timestamp) VALUES (:sysu_id,:staff_status,:created_by,NOW())";
					$stmt_new = $db->prepare($sql_new);
					$stmt_new->bindParam(":sysu_id", $result_set["sysu_id"]);
					$stmt_new->bindParam(":staff_status",$staff_status);
					$stmt_new->bindParam(":created_by", $result_set["sysu_id"]);
					$stmt_new->execute();
					$sysu_first_time_flag = '1';
					$sql_up = "UPDATE system_users SET sysu_first_time_flag=:sysu_first_time_flag WHERE sysu_id=:sysu_id";
					$stmt_up = $db->prepare($sql_up);
					$stmt_up->bindParam(":sysu_first_time_flag", $sysu_first_time_flag);
					$stmt_up->bindParam(":sysu_id", $result_set["sysu_id"]);
					$stmt_up->execute();
					echo "<script>window.location='/adapto/admin/user/system users/progress.php';</script>";
					exit(0);
				}
				else if($result_set["sysu_first_time_flag"] == '1')
				{
					$sql="UPDATE system_users SET sysu_last_login_timestamp=NOW() WHERE sysu_id=:sysu_id";
					$stmt = $db->prepare($sql);
					$stmt->bindParam(":sysu_id", $result_set["sysu_id"], PDO::PARAM_STR);
					$stmt->execute();
					$result_set = array_map("trim", $result_set);
					$_SESSION["user_id"] = $result_set["sysu_id"];
					$_SESSION["sysu_role"] = explode("|", strtolower($result_set["sysu_role"]));
					echo "<script>window.location='/adapto/admin/user/dashboard.php';</script>";
					exit(0);
				}
				else
				{
					$_SESSION["error_message"][] = "Invalid username or password.";
				}
			}
			else
			{
				$_SESSION["error_message"][] = "Invalid username or password.";
			}
		}
		else
		{
			$_SESSION["error_message"][] = "Invalid username or password.";
		}
		echo "<script>window.location='".$_SERVER["PHP_SELF"]."';</script>";
		exit(0);
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Adapto | Admin </title>
		<!--CSS--->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/adapto/admin/assets/css/style.css">
		<style>
			#index-container{
				margin-top:16%;
			}
			.btn-block{
				width:200px;				
			}
			.btn-login{
				font-size:18px;
				background-color: #007bff;
				border-color: #007bff;
			}
			.btn-login:hover{
				background-color: #0079d9;
				border-color: #0079d9;
			}
		</style>
	</head>
	<body>
		<div class="container" id="index-container">
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">Login</div>
						<div class="panel-body">
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<div class="col-md-12">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<input type="text" class="form-control" id="sysu_username" required name="sysu_username"  placeholder="Enter Username" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
											<input type="password" class="form-control" id="sysu_password" required name="sysu_password"  placeholder="Enter Password" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="submit" class="btn btn-primary btn-block btn-login" id="login" name="login" value="Login">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<img class="img-responsive" src="/adapto/assets/images/undraw_secure_login_pdn4.svg">
				</div>
			</div>
		</div>
		<script type="text/javascript" src="/adapto/admin/assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="/adapto/admin/assets/js/popper.min.js"></script>
		<script type="text/javascript" src="/adapto/admin/assets/js/bootstrap.min.js"></script>
	</body>
</html>