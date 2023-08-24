<?php
	$title = "Create Staff Accounts";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	if(isset($_POST["submit"]))
	{
		$created_by = trim($_SESSION["user_id"]);
		$id =$_GET['id'];
		$_POST = array_map("trim", $_POST);
        $_POST = array_map("htmlspecialchars", $_POST);
        extract($_POST);
		$error_flag = false;
        if($error_flag === false)
		{
			$pimage = "";
			$img_dir = "/adapto/admin/assets/img/post/";
			if(!empty($_FILES['pimage']['tmp_name']))
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
			
			$old_img = getFilePath("post", "pimage", "id", $id);
			if($pimage === "") {
				$pimage = $old_img;
			}
			else {
				if(file_exists($_SERVER['DOCUMENT_ROOT'].$old_img)) {
					unlink($_SERVER['DOCUMENT_ROOT'].$old_img);
				}	
			}
			$sql = "UPDATE post set title=:title, pdescription=:pdescription, pimage=:pimage, breed_id=:breed_id, gender=:gender where id=:id ";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $_GET['id']);	
			$stmt->bindParam(":title", $title);			
			$stmt->bindParam(":pdescription", $pdescription);
			$stmt->bindParam(":pimage", $pimage);
			$stmt->bindParam(":breed_id", $breed_id);
			$stmt->bindParam(":gender", $gender);
		
			if($stmt->execute())
			{
				$_SESSION["success_message"][] = "Updated Successfully.";
			}
			else
			{
				$_SESSION["error_message"][] = "Failed to update.";
			}
			//$stmt->debugDumpParams();
		}
		echo "<script>window.location='".$_SERVER["PHP_SELF"]."?id=".$_GET["id"]."';</script>";
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
					<div class="panel-heading">Edit Post</div>
					<div class="panel-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$_GET["id"]; ?>" method="post" enctype="multipart/form-data">
							<?php if($posts = fetchData(array("table" => "post", "condition" => "WHERE id =".$_GET['id']))): $post = $posts[0]; ?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="title" class="highlight">Title</label>
										<input type="text" id="title" name="title" class="form-control" placeholder="Title" value="<?php echo $post["title"]; ?>"  required autocomplete="off">
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
                                                    <option value="<?php echo $data["id"]; ?>" <?php if($post["breed_id"] == $data["id"]){ echo 'selected';} ?>><?php echo $data['breed_name']; ?></option>
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
										<label class="radio-inline"><input type="radio" id="gender" name="gender" value="Male" <?php if($post["gender"] == "Male"){ echo 'checked';} ?> >Male</label>&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" id="gender" name="gender" value="Female" <?php if($post["gender"] == "Female"){ echo 'checked';} ?>>Female</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pimage" class="highlight">Photo</label>
										<?php if(($post['pimage'])!=NULL): ?>
											<a href="<?php echo $post['pimage']; ?>" class="btn btn-primary" target="_blank"><i class="fa fa-eye"></i></a>
										<?php endif; ?>
										<input type="file" id="pimage" name="pimage" class="form-control" accept="image/jpg, image/jpeg, image/png" >
                                    </div>
                                </div>
							</div>
							<div class="row">
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pdescription">Description</label>
                                        <textarea id="pdescription"  rows="6" name="pdescription" class="form-control" autocomplete="off" placeholder="Description"><?php echo $post["pdescription"]; ?></textarea>
                                    </div>
                                </div>
							</div>
							<?php if($users = fetchData(array("table" =>"user","condition" =>"where id=".$data["created_by"]))): ?>
								<p>Posted By : <?php echo $users[0]['fname']." &nbsp;".$users[0]['lname']; ?></p>
							<?php endif; ?>
							<button type="submit" name="submit" id="submit" class="btn btn-primary btn-margin btn-width">Edit</button>
							<a href="/adapto/admin/user/dashboard" class="btn btn-danger btn-margin btn-width">Clear</a>
                            <?php endif; ?>
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