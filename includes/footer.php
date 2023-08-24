<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
    if(isset($_POST["submit"]))
	{
		$_POST = array_map("trim", $_POST);
        $_POST = array_map("htmlspecialchars", $_POST);
        extract($_POST);
		$error_flag = false;
		
		if($error_flag === false)
		{
			$sql = "INSERT INTO subscriber(email, creation_timestamp) VALUES (:email, NOW())";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":email", $email);
			
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
<footer class="footer-1">           <!-- Footer Style 2 -->
        <div class="footer-pri">            <!-- Primary Footer -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget widget-about">           <!-- Widget -->
                            <a href="#">
                                <img src="./assets/images/adapto-logo.png" class="logo-footer" alt="">
                            </a>
                            <p class="mt-20 footer-text">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                            <hr class="mt-30 mb-30" />
                            <h5 class="heading font-bold">Reach Out</h5>
                            <ul class="contact footer-text">
                                <li>
                                    <i class="ion-location-outline"></i>
                                    <div>
                                        <strong>Adapto</strong>
                                        <br>
                                        Vihighar,New Panvel,Maharashtra
                                    </div>
                                </li>
                                <li><i class="ion-call-outline"></i> +91 8695455782</li>
                                <li><i class="ion-mail-outline"></i> tech-adapto@gmail.com</li>
                            </ul>
                            <hr class="mt-30 mb-30" />
                            <h5 class="heading font-bold mb-20">Social Connect</h5>
                            <ul class="social social-round social-2x">
                                <li><a class="facebook" href=""><i class="ion-logo-facebook"></i></a></li>
                                <li><a class="twitter" href=""><i class="ion-logo-twitter"></i></a></li>
                                <li><a class="google" href=""><i class="ion-logo-google"></i></a></li>
                                <li><a class="youtube" href=""><i class="ion-logo-youtube"></i></a></li>
                                <li><a class="whatsapp" href=""><i class="ion-logo-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4">
                        <hr class="mt-30 mb-30 d-lg-none" />
                        <div class="widget widget-links">           Widget
                            <h5 class="heading font-bold">Useful Links</h5>
                            <ul>
                                <li><a href="book-appointment-form.html">Book Appoitment</a></li>
                                <li><a href="departments-style-1.html">View Departments</a></li>
                                <li><a href="contact-1.html">Our Locations</a></li>
                                <li><a href="doctors-style-2.html">Doctors On Panel</a></li>
                                <li><a href="why-us-1.html">Facilities Available</a></li>
                                <li><a href="about-us-1.html">About Hospital</a></li>
                                <li><a href="policies.html">Hospital Rules</a></li>
                            </ul>
                        </div>
                        <hr class="mt-30 mb-30" />
                        <div class="widget widget-twitter">          
                            <h5 class="heading font-bold">Latest Tweet</h5>
                            <div class="tweets">
                                <ul class="carousel-items">
                                    <li class="tweet-item">
                                        <p>How to tell if the hand sanitizer you’re buying is safe and actually works? <a href="">#askDoctor</a></p>
                                    </li>
                                    <li class="tweet-item">
                                        <p>Screen time doesn’t hurt kids’ social skills, says harvard university <a href="">#healthcare #dailyTips</a></p>
                                    </li>
                                    <li class="tweet-item">
                                        <p>Can clothes and shoes track infection into your house? What to Know <a href="">Read blog here</a></p>
                                    </li>
                                </ul>
                            </div>
                            <a href="" class="btn btn-outline-light curved btn-sm mt-10">Follow Us</a>
                        </div>
                    </div> -->
                    <div class="col-lg-4">
                        <div class="row">
                            <?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
                        </div>
                        <div class="widget widget-subscribe mt-40 mb-30">           <!-- Widget -->
                            <h5 class="heading font-bold">Subscribe Newsletter</h5>
                            <p class="footer-text">Subscribe to our newsletter for dog related posts!</p>
                            <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   <!-- Search Form -->
                                <div class="input-group">
                                    <input type="text" class="form-control curved border-secondary bg-transparent" placeholder="Your Email Id" name="email" id="email">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary curved" type="submit" name="submit" id="name">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-sec">            <!-- Secondary Footer -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mt-10 mb-10">
                        <ul class="misc-links">
                            <li>
                                <a href="">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="">Terms & Conditions</a>
                            </li>
                            <li>
                                <a href="">Usage Rights</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 mt-10 mb-10 text-right">
                        <p class="mb-0 footer-text text-lg-right text-center">&copy; 2021 All Rights Reserved.
                            <a href="/adapto/index.php" class="font-semi-bold">Adapto</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div id="back"><i class="ion-chevron-up-sharp"></i></div>
    <script src="./assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="./assets/js/jquery.appear.min.js" type="text/javascript"></script>
    <script src="./assets/js/jquery.countTo.min.js" type="text/javascript"></script>
    <script src="./assets/js/slick.min.js" type="text/javascript"></script>
    <script src="./assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="./assets/js/script.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://unpkg.com/bootstrap-colorpicker@3.4.0/dist/js/bootstrap-colorpicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script>
        $(function () {
            $('.color-picker1').colorpicker();
        });
    </script>
</body>

</html>