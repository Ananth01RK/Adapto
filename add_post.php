<?php
	$title = "Create Staff Accounts";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	if(isset($_POST["submit"]))
	{
		$created_by = trim($_SESSION["user_web_id"]);
		$_POST = array_map("trim", $_POST);
        $_POST = array_map("htmlspecialchars", $_POST);
        extract($_POST);
		$error_flag = false;
		$pimage = "";
		$img_dir = "/adapto/admin/assets/img/post/";
		if(!empty($_FILES['pimage']['tmp_name']) && $error_flag === false)
		{
			$file_name = $_FILES['pimage']['name'];
			$tmp_name = $_FILES['pimage']['tmp_name'];
			$extension = strtolower(pathinfo(basename($file_name), PATHINFO_EXTENSION));
			$allow_extensions = array('jpg','jpeg','png');
			if(!in_array($extension, $allow_extensions))
			{
				$_SESSION['error_message'][] = $extension;
				$_SESSION['error_message'][] = "This type of file is not allowed.";
			}
			else
			{
				$uniqueValue = generateVerificationCode();
				if(move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'].$img_dir.$uniqueValue.$file_name))
				{
					$pimage = $img_dir.$uniqueValue.$file_name;
				}
				else
				{
					$_SESSION['error_message'][] = "Failed to upload the file";
				}
			}
		}
        if($error_flag === false)
		{
			$sql = "INSERT INTO post(title, pdescription, pimage, breed_id, gender,created_by,created_timestamp) VALUES (:title, :pdescription, :pimage, :breed_id, :gender,:created_by,NOW())";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":title", $title);			
			$stmt->bindParam(":pdescription", $pdescription);
			$stmt->bindParam(":pimage", $pimage);
			$stmt->bindParam(":breed_id", $breed_id);
			$stmt->bindParam(":gender", $gender);
			$stmt->bindParam(":created_by", $created_by);
		
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
					<div class="panel-heading">Create Post</div>
					<div class="panel-body">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="title" class="highlight">Title</label>
										<input type="text" id="title" name="title" class="form-control" placeholder="Title" required autocomplete="off">
									</div>
								</div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="breed_id" class="highlight">Dog Breed</label>
                                        <select name="breed_id" id="breed_id"class="form-control" required>
                                            <option value="">Select Dog Breed</option>
                                            <?php if($datas = fetchData(array("table" =>"dog_breed","condition" =>""))):  
                                                $count = 1; foreach($datas as $data):
                                            ?>
                                                    <option value="<?php echo $data["id"]; ?>"><?php echo $data['breed_name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-6">
                                    <label for="gender" class="highlight">Gender</label>
                                    <div>
                                        <label class="radio-inline"><input type="radio" id="gender" name="gender" value="Male">Male</label>&nbsp;&nbsp;
                                        <label class="radio-inline"><input type="radio" id="gender" name="gender" value="Female">Female</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pimage" class="highlight">Photo</label>
                                        <input type="file" id="pimage" name="pimage" class="form-control" accept="image/jpg, image/jpeg, image/png" required>
                                    </div>
                                </div>
							</div>
							<div class="row">
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pdescription">Description</label>
                                        <textarea id="pdescription"  rows="6" name="pdescription" class="form-control" autocomplete="off" placeholder="Description"></textarea>
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
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/includes/footer.php");
?>