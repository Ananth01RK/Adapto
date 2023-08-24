<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
    if(isset($_POST["submit"]))
	{
		$_POST = array_map("trim", $_POST);
        $_POST = array_map("htmlspecialchars", $_POST);
        extract($_POST);
		$error_flag = false;
		
		if($error_flag === false)
		{
			$sql = "INSERT INTO contact(full_name, email, umessage, creation_timestamp) VALUES (:full_name, :email, :umessage, NOW())";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":full_name",$full_name);
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":umessage", $umessage);
			
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
		echo "<script>window.location='".$_SERVER["PHP_SELF"]."';</script>";
		exit(0);
	}
?>
    <div class="container mt-80">
        <div class="row">
            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
        </div>
        <div class="row">
            <div class="col-lg-5 bg-light p-40">
                <h3 class="heading font-bold mb-40">Get in Touch</h3>
                <div class="contact-icon">
                    <div class="con-icon">
                        <i class="ion-location-outline"></i>
                    </div>
                    <div class="con-body">
                        <h5 class="heading font-bold d-flex align-items-center mb-10">Address</h5>
                        <p class="mb-0 h6">Vihighar,New Panvel,Maharashtra</p>
                    </div>
                </div>
                <hr>
                <div class="contact-icon">
                    <div class="con-icon">
                        <i class="ion-call-outline"></i>
                    </div>
                    <div class="con-body">
                        <h5 class="heading font-bold d-flex align-items-center mb-10">Helpline</h5>
                        <p class="mb-0 h6">+91 8695455782</p>
                    </div>
                </div>
                <hr>
                <div class="contact-icon">
                    <div class="con-icon">
                        <i class="ion-mail-outline"></i>
                    </div>
                    <div class="con-body">
                        <h5 class="heading font-bold d-flex align-items-center mb-10">Email</h5>
                        <p class="mb-0 h6">tech-adapto@gmail.com</p>
                    </div>
                </div>
                <!--p class="mb-0 h6 mt-50 text-muted">For online appointment and hassle free consultation, <br> <a href="">book your appointment now</a></p-->
            </div>
            <div class="col-lg-7 p-40 border border-lg-left-0" style="background-image: url(images/world-map-1.png); background-repeat: no-repeat; background-position: 95% 4%">
                <h3 class="heading font-bold mb-20">Contact Form</h3>
                <p class="h6 mb-50 text-muted">Drop your feedback & suggestions</p>
                <form id="main-contact-form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Full name" id="full_name" name="full_name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Email address" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" placeholder="Please enter your message" id="umessage" name="umessage"></textarea>
                    </div>
                    <p id="status"></p>
                    <button class="btn btn-primary" type="submit" name="submit">Submit Query</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-80 p-0">
        <div class="row no-gutters">
            <div class="col-lg-12">
                <!-- Replace Latitude, Logitude and Info Window as per your place -->
                <div class="gmap">
                    <div class='info-window'>
                        <div class='info-head'>
                            <img src='/adapto/assets/images/map.png' class='img-fluid'>
                        </div>
                        <!-- <div class='info-body'>
                            <h5 class='font-bold heading'>Medwise Hospital</h5>
                            <p class='info-text normal mb-0 d-flex align-items-top'>
                                <i class='ion-location text-muted icon-left'></i>5th Floor, Times Square, <br/> New York - 12435
                            </p>
                            <p class='mb-0 info-text d-flex align-items-center normal'><i class='ion-call text-muted icon-left'></i>1800-456-2433</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/footer.php");
?>