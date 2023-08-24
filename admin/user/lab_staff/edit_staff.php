<?php
	$title = "Personal Details";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	
	if(!isset($_SESSION["user_id"]) || !is_numeric($_SESSION["user_id"]))
	{
		redirect_label:
		echo "<script>window.location='/adapto/admin/user/dashboard';</script>";
		exit(0);
	}
	if(isset($_POST["submit"]))
	{
		$sysu_id = trim($_SESSION["user_id"]);
		$modified_by = trim($_SESSION["user_id"]);
		$_POST = array_map("trim", $_POST);
        $_POST = array_map("htmlspecialchars", $_POST);
        extract($_POST);
		$error_flag = false;	
		$img = "";
		$img_dir = "/adapto/admin/assets/img/staff/";					
		if($error_flag === false)
		{
			if(!empty($_FILES['img']['tmp_name']))
			{
				$file_name = $_FILES['img']['name'];
				$tmp_name = $_FILES['img']['tmp_name'];
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
						$img = $img_dir.$uniqueValue.$file_name;
					}
					else
					{
						$_SESSION['error_message'][] = "Failed to upload the file";
					}
				}
			}
			
			$old_img = getFilePath("staffs", "img", "sysu_id", $sysu_id);
			if($img === "") {
				$img = $old_img;
			}
			else {
				if(file_exists($_SERVER['DOCUMENT_ROOT'].$old_img)) {
					unlink($_SERVER['DOCUMENT_ROOT'].$old_img);
				}	
			}
			$staff_status = '0';
			$sql = "UPDATE staffs SET fname=:fname,lname=:lname,mname=:mname,phoneno=:phoneno,email=:email,gender=:gender,staff_address=:staff_address,staff_status=:staff_status,img=:img,modified_by=:modified_by,modification_timestamp = NOW() WHERE sysu_id=:sysu_id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":sysu_id", $sysu_id);			
			$stmt->bindParam(":fname", $fname);
			$stmt->bindParam(":mname", $mname);
			$stmt->bindParam(":lname", $lname);
			$stmt->bindParam(":phoneno", $phoneno);
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":gender", $gender);
			$stmt->bindParam(":staff_address", $staff_address);
			$stmt->bindParam(":staff_status", $staff_status);
			$stmt->bindParam(":img", $img);
			$stmt->bindParam(":modified_by", $modified_by);
		
			if($stmt->execute())
			{
				$_SESSION["success_message"][] = "Submitted successfully.";
			}
			else
			{
				$_SESSION["error_message"][] = "Failed to submit.";
			}
			//$stmt->debugDumpParams();
		}
		else
		{
			$_SESSION["error_message"][] = "Failed to submit.";
		}
		echo "<script>window.location='".$_SERVER["PHP_SELF"]."?id=".$_SESSION["user_id"]."';</script>";
		exit(0);
	}
?>

<div class="container">
	<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
	<div class="container col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$_SESSION["user_id"]; ?>" method="post" enctype="multipart/form-data">
							<?php $staffs = fetchData(array("table" => "staffs", "condition" => "WHERE sysu_id =".$_SESSION["user_id"])); $staff = $staffs !== false ? $staffs[0] : array(); ?>
								<?php //print_r($staff); ?>
								<div class="row">
									<div class="col-md-12">
										<h4>Personal Details:</h4>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="fname" class="highlight">First Name</label>
											<input type="text" id="fname" name="fname" class="form-control" value="<?php echo $staff["fname"]; ?>" required autocomplete="off" placeholder="First Name">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="mname">Middle Name</label>
											<input type="text" id="mname" name="mname" class="form-control" value="<?php echo $staff["mname"]; ?>" autocomplete="off" placeholder="Middle Name">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="lname" class="highlight">Last Name</label>
											<input type="text" id="lname" name="lname" class="form-control" value="<?php echo $staff["lname"]; ?>" required autocomplete="off" placeholder="Last Name">
										</div>
									</div>
								</div>
								<div class="row">	
									<!-- <div class="col-md-4">
										<div class="form-group">
											<label for="lname" class="highlight">D.O.B.</label>
											<input type="date" id="staffs_date_of_birth" name="staffs_date_of_birth" class="form-control" value="<?php //echo $staff["staffs_date_of_birth"]; ?>" required>
										</div>
									</div> -->
									<div class="col-md-4">
										<label for="gender"  class="highlight">Gender</label>
										<div>
											<label class="radio-inline"><input type="radio" id="gender" name="gender" value="male" <?php if($staff["gender"] == "male"){ echo 'checked';} ?> >Male</label>&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" id="gender" name="gender" value="female" <?php if($staff["gender"] == "female"){ echo 'checked';} ?>>Female</label>
											<label class="radio-inline"><input type="radio" id="gender" name="gender" value="trans" <?php if($staff["gender"] == "trans"){ echo 'checked';} ?>>Trans</label>
										</div>
									</div>
								</div><hr>
								<div class="row">
									<div class="col-md-12">
										<h4>Contact Details</h4>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="phoneno" class="highlight">Contact No.</label>
											<input type="text" id="phoneno" name="phoneno" class="form-control" value="<?php echo $staff["phoneno"]; ?>"placeholder="Contact No." required autocomplete="off">
											<code></code>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="email" class="highlight">Email Address</label>
											<input type="text" id="email" name="email" class="form-control" value="<?php echo $staff["email"]; ?>" required autocomplete="off" placeholder="Email Address">
											<code></code>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="staff_address" class="highlight">Address</label>
											<textarea id="staff_address"  rows="6" name="test_message" class="form-control" autocomplete="off" placeholder="Address" value="<?php echo $staff["staff_address"]; ?>"></textarea>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<h4>Document Details</h4>
									</div>
								</div>
								 <div class="row">
									<div class="col-md-12">
										<label for="img" class="highlight">Photo</label>
										<?php if(($staff['img'])!=NULL): ?>
											<a href="<?php echo $staff['img']; ?>" class="btn btn-primary" target="_blank"><i class="fa fa-eye"></i></a>
										<?php endif; ?>
										<input type="file" id="img" name="img" class="form-control" accept="image/jpg, image/jpeg, image/png" >
									</div>
								</div>
								<button type="submit" name="submit" id="submit" class="btn btn-primary btn-margin btn-width">Submit</button>
								<a href="/adapto/admin/user/dashboard" class="btn btn-danger btn-margin btn-width">Cancel</a>
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
	$("#email").on("input",function(){
		if($("#email").val().length > 0){
			$.ajax({
				url:'checkStaffsEmail.php?email='+ $("#email").val(),
				type:'GET',
				success:function(response){
					if(response == "true"){
						$("#email + code").html("This email already exists.");
						$("#email + code").show();
					}
					else{
						$("#email + code").html("");	
						$("#email + code").hide();
					}
				}
			});
		}
		else{
			$("#email + code").html("");	
			$("#email + code").hide();		
		}	
	});
	$("#email + code").hide();
	
	$("#phoneno").on("input",function(){
		if($("#phoneno").val().length > 0){
			$.ajax({
				url:'checkStaffsPhone.php?phone='+ $("#phoneno").val(),
				type:'GET',
				success:function(response){
					if(response == "true"){
						$("#phoneno + code").html("This mobile no. already exists.");
						$("#phoneno + code").show();
					}
					else{
						$("#phoneno + code").html("");	
						$("#phoneno + code").hide();
					}
				}
			});
		}
		else{
			$("#phoneno + code").html("");	
			$("#phoneno + code").hide();		
		}	
	});
	$("#phoneno + code").hide();
</script> 