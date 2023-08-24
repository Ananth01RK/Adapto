<?php
	$name = "Edit Partner";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	if(isset($_POST["submit"]))
	{
		$created_by = trim($_SESSION["user_id"]);
        $id = $_GET['id'];
		$_POST = array_map("trim", $_POST);
        $_POST = array_map("htmlspecialchars", $_POST);
        extract($_POST);
		$error_flag = false;
	
        if($error_flag === false)
		{
            $pimage = "";
            $img_dir = "/adapto/admin/assets/img/partner/";
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
            
            $old_img = getFilePath("partner", "pimage", "id", $id);
            if($pimage === "") {
                $pimage = $old_img;
            }
            else {
                if(file_exists($_SERVER['DOCUMENT_ROOT'].$old_img)) {
                    unlink($_SERVER['DOCUMENT_ROOT'].$old_img);
                }	
            }
			$sql = "UPDATE partner SET pname=:pname, paddress=:paddress, pimage=:pimage WHERE id=:id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":id", $_GET['id']);	
			$stmt->bindParam(":pname", $pname);			
			$stmt->bindParam(":paddress", $paddress);
			$stmt->bindParam(":pimage", $pimage);
		
			if($stmt->execute())
			{
				$_SESSION["success_message"][] = "Updated Successfully.";
			}
			else
			{
				$_SESSION["error_message"][] = "Failed to create.";
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
					<div class="panel-heading">Edit Partner</div>
					<div class="panel-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$_GET["id"]; ?>" method="post" enctype="multipart/form-data">
							<?php if($partners = fetchData(array("table" => "partner", "condition" => "WHERE id =".$_GET['id']))): $partner = $partners[0]; ?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="pname" class="highlight">Partner Name</label>
										<input type="text" id="pname" name="pname" class="form-control" placeholder="Partner Name" required autocomplete="off" value="<?php echo $partner["pname"]; ?>">
									</div>
								</div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pimage" class="highlight">Photo</label>
										<?php if(($partner['pimage'])!=NULL): ?>
											<a href="<?php echo $partner['pimage']; ?>" class="btn btn-primary" target="_blank"><i class="fa fa-eye"></i></a>
										<?php endif; ?>
										<input type="file" id="pimage" name="pimage" class="form-control" accept="image/jpg, image/jpeg, image/png" >
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="paddress">Address</label>
                                        <textarea id="paddress"  rows="6" name="paddress" class="form-control" autocomplete="off" placeholder="Address"><?php echo $partner["paddress"]; ?></textarea>
                                    </div>
                                </div>
							</div>
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