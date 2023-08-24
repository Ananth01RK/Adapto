<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	
	if(isset($_POST["register"]))
	{
		$_POST = array_map("trim", $_POST);
        $_POST = array_map("htmlspecialchars", $_POST);
        extract($_POST);
		$error_flag = false;
		$fname = $_POST["fname"];
		$mname = $_POST["mname"];
		$lname = $_POST["lname"];
		$uemail = $_POST["uemail"];
		$upassword = sha1($_POST["upassword"]);
		$uaddress = $_POST["uaddress"];
        $phoneno = $_POST["phoneno"];

		$pimage = "";
		$img_dir = "/adapto/admin/assets/img/post/";
		
		if($error_flag === false)
		{
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
			$sql = "INSERT INTO user(fname, mname, lname, uemail, upassword, uaddress, uimage, phoneno, creation_timestamp) VALUES (:fname, :mname, :lname, :uemail, :upassword, :uaddress, :uimage, :phoneno, NOW())";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":fname",$fname);
			$stmt->bindParam(":mname",$mname);
			$stmt->bindParam(":lname",$lname);
			$stmt->bindParam(":uemail", $uemail, PDO::PARAM_STR);
			$stmt->bindParam(":upassword", $upassword, PDO::PARAM_STR);
			$stmt->bindParam(":uaddress",$uaddress);
			$stmt->bindParam(":uimage", $pimage);
			$stmt->bindParam(":phoneno", $phoneno);
			
			//$stmt->debugDumpParams();
            if($stmt->execute())
			{
				$_SESSION["success_message"][] = "Successfully created.";
			}
			else
			{
				$_SESSION["error_message"][] = "Failed to create.";
			}
		}
		// echo "<script>window.location='".$_SERVER["PHP_SELF"]."';</script>";
		// exit(0);
	}
?>
    <section class="pt-100 pb-100" style="background-image: url(https://picfiles.alphacoders.com/267/267601.jpg); background-size: cover; background-position: center center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 p-20 p-lg-60 bg-white rounded bs-dark-lg">
                <?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
                <h2 class="heading font-bold mb-20" style="text-align:center;">Register</h2>
                    <p class="h5 mb-30"  style="text-align:center;" >Let’s make a friend and go longer miles....</p>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="uemail" name="uemail" placeholder="Email Address"required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="upassword" name="upassword" placeholder="Password"required>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" id="phoneno" name="phoneno" placeholder="Phone Number"required>
                        </div>
                        <div class="form-group">
                            <label for="pimage" class="highlight">Photo</label>
                            <input type="file" id="pimage" name="pimage" class="form-control" accept="image/jpg, image/jpeg, image/png" required>
                        </div>
                        <div class="form-group">
                            <textarea id="uaddress"  rows="6" name="uaddress" class="form-control" autocomplete="off" placeholder="Address"></textarea>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit" id="register" name="register">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/footer.php");
?>
 