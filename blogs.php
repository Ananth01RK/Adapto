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

    function get_breed_count($breed_id) {
        global $db;
        $sql = "SELECT COUNT(1) as 'total_count' FROM post WHERE  breed_id=$breed_id";
        $result = $db->query($sql); 
        return $result->fetch()['total_count'];
    }
?>
<div class="container mt-80 mb-60">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="breed">Sort By</label>
                <select id="breed" name="breed" class="form-control selectpicker" data-role="select-dropdown"  data-actions-box="true" data-live-search="true">
                    <option value="nearest">Nearest</option>
                    <option value="best_match">Best Match</option>
                    <option value="furthest">Furthest</option>
                    <option value="randomize">Randomize</option>
                </select>
            </div>
        </div> 
        <div class="col-md-4">
            <div class="form-group">
                <label for="breed">Select Breed</label>
                <select id="breed" name="breed" class="form-control selectpicker" data-role="select-dropdown"  data-actions-box="true" data-live-search="true">
                    <option value="">Select Dog Breed</option>
                    <?php if($datas = fetchData(array("table" =>"dog_breed","condition" =>""))):  
                        $count = 1; foreach($datas as $data):
                    ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['breed_name']; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="gender">Select Gender</label>
                <select id="gender" name="gender" class="form-control selectpicker" data-role="select-dropdown"  data-actions-box="true" data-live-search="true">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
    </div>
</div>

    <div class="container mt-80 mb-60">
        <div class="row">
            <div class="col-lg-8">
                <?php if($datas = fetchData(array("table" =>"post","condition" =>""))):  
                    $count = 1; foreach($datas as $data):
                ?>
                        <div class="blog-box">
                            <div class="blog-header row">
                                <div class="col-md-3">
                                    <img src='<?php echo $data["pimage"]; ?>' class="img-fluid rounded" alt="">
                                </div>
                                <div class="col-md-9">
                                    <h3 class="heading font-bold post-title"><a href="blog-single.php?id=<?php echo $data['id']; ?>"><?php echo $data["title"]; ?></a></h3>
                                    <p class=""><?php echo substr($data["pdescription"],0,100); ?></p>
                                        <?php if($users = fetchData(array("table" =>"user","condition" =>"where id=".$data["created_by"]))): ?>
                                            <div class="blog-meta">
                                                <ul class="meta-list">
                                                    <!-- <li class="posted-on">Posted On : 
                                                        <a href="">
                                                            <span class="date"><?php date("h:i:s A",strtotime($data["created_timestamp"])) ?></span>
                                                        </a>
                                                    </li> -->
                                                    <li class="posted-by">Posted By : <a href=""><?php echo $users[0]['fname']." &nbsp;".$users[0]['lname']; ?></a></li>
                                                </ul>
                                            </div>  
                                    <?php endif;  ?>  
                                </div>                        
                            </div>
                            <!-- <div class="blog-excerpt">
                                <p><?php //echo $data["pdescription"]; ?></p>
                            </div>
                            <a href="blog-single.html" class="btn btn-light mt-10">Read Article</a> -->
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <!-- <nav>
                    <ul class="pagination mt-50 justify-content-center">
                        <li>
                            <a href="#" aria-label="Previous">
                                <i class="ion-chevron-back-sharp"></i>
                            </a>
                        </li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <i class="ion-chevron-forward-sharp"></i>
                            </a>
                        </li>
                    </ul>
                </nav> -->
            </div>
            
            <div class="col-lg-4 mt-lg-0 mt-40">
                <aside class="sidebar pl-lg-20">
                    <div class="widget widget-search pt-0">
                        <?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
                        <h5 class="heading d-flex align-items-center"><i class="ion-mail-open-outline icon-left"></i>Subscribe to Blog</h5>
                        <p class="">Subscribe to our newsletter for dog related posts!</p>
                        <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   <!-- Search Form -->
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Id" name="email" id="email">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit" name="submit" id="submit">Go</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="widget widget-categories">
                        <h5 class="heading d-flex align-items-center"><i class="ion-list-outline icon-left"></i>Categories</h5>
                        <ul class="widget-list">
                            <?php if($datas = fetchData(array("table" =>"dog_breed","condition" =>""))): foreach($datas as $data): ?>
                                <li><a href="/adapto/"><?php echo $data['breed_name']; ?><span class="badge badge-light"><?php echo get_breed_count($data["id"]); ?></span></a></li>
                            <?php endforeach; endif; ?>
                        </ul>
                    </div>
                    <!-- <div class="widget widget-social">
                        <h5 class="heading d-flex align-items-center"><i class="ion-share-social-outline icon-left"></i>We're Social</h5>
                        <p class="mb-20">Care for your loved ones by sharing our blogs with your friends & family</p>
                        <ul class="social social-2x">
                            <li><a class="facebook" href=""><i class="ion-logo-facebook"></i></a></li>
                            <li><a class="twitter" href=""><i class="ion-logo-twitter"></i></a></li>
                            <li><a class="skype" href=""><i class="ion-logo-skype"></i></a></li>
                            <li><a class="pinterest" href=""><i class="ion-logo-pinterest"></i></a></li>
                            <li><a class="instagram" href=""><i class="ion-logo-instagram"></i></a></li>
                            <li><a class="youtube" href=""><i class="ion-logo-youtube"></i></a></li>
                        </ul>
                    </div> -->
                    <div class="widget widget-testimonial">
                        <h5 class="heading d-flex align-items-center"><i class="ion-chatbox-outline icon-left"></i>People Say</h5>
                        <div class="flexible-slider" data-items="1" data-arrows="false" data-dots="false">
                            <div class="slider-items">
                                <?php if($datas = fetchData(array("table" =>"testimonials","condition" =>""))):  
                                    $count = 1; foreach($datas as $data):
                                ?>
                                    <div class="item">
                                        <div class="testi-text"><?php echo $data['text']; ?></div>
                                        <div class="testi-footer">
                                            <?php if($users = fetchData(array("table" =>"user","condition" =>"where id=".$data["uid"]))): ?>
                                                <img src="<?php echo $users[0]['uimage'];?>" class="testi-img">
                                                <h6 class="said-by"><?php echo $users[0]['fname']." &nbsp;".$users[0]['lname']; ?></h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
<div class="modal zoom-in fade" id="modal-welcome" data-open-onload="flase" data-open-delay="3000" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="background-image:url('images/850-478-1.jpg'); background-size:cover; background-position: center center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ion-close-sharp"></i></button>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="breed">Select Breed</label>
                                <select id="breed" name="breed" class="form-control selectpicker" data-role="select-dropdown"  data-actions-box="true" data-live-search="true">
                                    <option value="">Select Dog Breed</option>
                                    <?php if($datas = fetchData(array("table" =>"dog_breed","condition" =>""))):  
                                        $count = 1; foreach($datas as $data):
                                    ?>
                                            <option value="<?php echo $data['id']; ?>"><?php echo $data['breed_name']; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Select Gender</label>
                                <select id="gender" name="gender" class="form-control selectpicker" data-role="select-dropdown"  data-actions-box="true" data-live-search="true">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="color" class="highlight">Color</label>
                                <input id = "color" type = "text" class="form-control" value="#8f3596" />
                                <div class="validation"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/footer.php");
?>