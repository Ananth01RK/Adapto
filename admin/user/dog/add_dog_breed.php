<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	if(isset($_POST["submit"]))
	{
		$created_by = trim($_SESSION["user_id"]);
		$_POST = array_map("trim", $_POST);
        $_POST = array_map("htmlspecialchars", $_POST);
        extract($_POST);
		$error_flag = false;
		
        if($error_flag === false)
		{
			$sql = "INSERT INTO dog_breed (breed_name,created_by) VALUES (:breed_name, :created_by)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":breed_name", $breed_name);
			$stmt->bindParam(":created_by", $created_by);
		
			if($stmt->execute())
			{
				$_SESSION["success_message"][] = "Successfully created.";
			}
			else
			{
				$_SESSION["error_message"][] = "Failed to create.";
			}
			$stmt->debugDumpParams();
		}
		// echo "<script>window.location='".$_SERVER["PHP_SELF"]."';</script>";
		// exit(0);
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
					<div class="panel-heading">Create Post</div>
					<div class="panel-body">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="breed_name" class="highlight">breed_name</label>
										<input type="text" id="breed_name" name="breed_name" class="form-control" placeholder="breed_name" required autocomplete="off">
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