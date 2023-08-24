<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/header.php");
	
	if(isset($_POST["login"]))
	{
		$_POST = array_map("trim", $_POST);
		$_POST = array_map("addslashes", $_POST);
		$uemail = $_POST["uemail"];
		$upassword = sha1($_POST["upassword"]);
		$error_flag = false;
		if(strlen($uemail)== 0 || strlen($upassword) == 0)
		{
			$error_flag = true;
			$_SESSION["error_message"][] = "Please fill all details";
		}
		
		if($error_flag === false)
		{
			$sql = "SELECT * FROM user WHERE uemail=:uemail AND upassword=:upassword";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":uemail", $uemail, PDO::PARAM_STR);
			$stmt->bindParam(":upassword", $upassword, PDO::PARAM_STR);
			$stmt->execute();
            $result_set = $stmt->fetch(PDO::FETCH_ASSOC);
			if(($stmt->rowCount())==0)
			{
                $_SESSION["login_error_message"][] = "Looks like you are not registered..";
            }
            else{
                $_SESSION["user_web_id"] = $result_set["id"];
                echo "<script>window.location='/adapto/index.php';</script>";
				exit(0);
            }
        }
		//echo "<script>window.location='".$_SERVER["PHP_SELF"]."';</script>";
		//exit(0);
	}
?>
    <section class="pt-100 pb-100" style="background-image: url(https://picfiles.alphacoders.com/267/267601.jpg); background-size: cover; background-position: center center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 p-20 p-lg-60 bg-white rounded bs-dark-lg">
                    <?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
                    <h2 class="heading font-bold mb-20" style="text-align:center;">Login</h2>
                    <p class="h5 mb-30"  style="text-align:center;" >Let’s make a friend and go longer miles....</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <input type="email" class="form-control" id="uemail" name="uemail" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="upassword" name="upassword" placeholder="Password" required>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit" id="login" name="login">Login</button>
                    </form>
                    <hr>
                    <p style="text-align:center;">Create an Account <a href="register.php" class="text-primary" style="text-align:center;"  id="register" name="register">Register</a></p>
                </div>
            </div>
        </div>
    </section>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/footer.php");
?>