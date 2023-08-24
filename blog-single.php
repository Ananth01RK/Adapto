<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
    if(isset($_POST["sub"]))
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

    if(isset($_POST["comment"]))
	{
		$_POST = array_map("trim", $_POST);
        $_POST = array_map("htmlspecialchars", $_POST);
        extract($_POST);
		$error_flag = false;
		$user_id = $_SESSION["user_web_id"];
        $post_id = $_GET['id'];
        $comment = $_POST['message'];
		if($error_flag === false)
		{
			$sql = "INSERT INTO comment(user_id,post_id,cmessage,created_by, creation_timestamp) VALUES (:user_id, :post_id, :cmessage,:created_by, NOW())";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":user_id",$user_id);
			$stmt->bindParam(":post_id",$post_id);
			$stmt->bindParam(":cmessage", $message);
			$stmt->bindParam(":created_by",$user_id);
			
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
		echo "<script>window.location='".$_SERVER["PHP_SELF"]."?id=".$_GET["id"]."';</script>";
		exit(0);
	}
?>

    <div class="container mt-80 mb-80">
        <div class="row">
            <div class="col-lg-8">
                <?php if($posts = fetchData(array("table" => "post", "condition" => "WHERE id =".$_GET['id']))): $post = $posts[0]; ?>
                    <div class="blog-single-box">
                        <div class="blog-header">
                            <img src='<?php echo $post["pimage"]; ?>' class="img-fluid rounded" alt="">
                            <h2 class="heading font-bold post-title"><?php echo $post["title"]; ?></h2>
                            <!-- <div class="blog-meta">
                                <ul class="meta-list">
                                    <li class="posted-on">Posted On : 
                                        <a href="">
                                            <span class="date">10</span>
                                            <span class="month">Oct</span>
                                            <span class="year">2021</span>
                                        </a>
                                    </li>
                                    <li class="posted-by">By : <a href="">Joy Mathew</a></li>
                                    <li class="posted-in">In <a href="">Health Care</a></li>
                                </ul>
                            </div>                             -->
                        </div>
                        <div class="blog-excerpt">
                            <p><?php echo $post["pdescription"]; ?></p>
                            <h4 class="heading font-bold mt-40">Features & Characteristics</h4>
                            <?php if($datas = fetchData(array("table" =>"dog_details","condition" =>" where breed_id=".$post['breed_id']))):  $data = $datas[0]; ?>
                                <p><?php echo $data['characteristics']; ?></p>
                                <p><?php echo nl2br($data['details']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($posts = fetchData(array("table" => "post", "condition" => "WHERE id =".$_GET['id']))): $post = $posts[0]; ?>
                    <?php if($users = fetchData(array("table" =>"user","condition" =>"where id=".$post["created_by"]))): ?>
                        <div class="blog-author">
                            <div class="author-media">
                                <img src="<?php echo $users[0]['uimage'];?>" class="author-img" alt="">
                            </div>
                            <div class="author-meta">
                                <h4 class="heading font-bold mb-0"><?php echo $users[0]['fname']." &nbsp;".$users[0]['lname']; ?></h4>
                                <div class="row"><p class="text-muted margin"><i class="ion-call-outline"></i>&nbsp; +91 <?php echo $users[0]['phoneno']; ?></p></div>
                                <div class="row"><p class="text-muted"><i class="ion-location-outline"></i>&nbsp;<?php echo $users[0]['uaddress']; ?></p></div>
                            </div>
                        </div>
                <?php endif; endif; ?>
                <div id="display-comments">        
                    <div class="blog-comments">
                        <h4 class="heading font-bold"><?php $sql ="SELECT COUNT(post_id) FROM comment where post_id=".$_GET['id'];
							$result = $db->query($sql); 
							$count = $result->fetch()[0];
                            if($count<=1){echo $count.' Comment';}
                            else{echo $count.' Comments';}
							
						?></h4>
                        <ul class="comment-list">
                            <?php if($comments = fetchData(array("table" => "comment", "condition" => "WHERE post_id =".$_GET['id']))): 
                                foreach($comments as $comment): ?>
                                    <?php if($users = fetchData(array("table" =>"user","condition" =>"where id=".$comment["user_id"]))): ?>
                                        <li class="comment">
                                            <div class="comment-media">
                                                <img src="<?php echo $users[0]['uimage'];?>" class="comment-img" alt="">
                                            </div>
                                            <div class="comment-body">
                                                <div class="who-said"><?php echo $users[0]['fname']; ?> said : <span class="comment-date"><?php echo $users[0]['phoneno']; ?></span></div>
                                                <div class="what-said"><?php echo $comment['cmessage']; ?></div>
                                            </div>
                                        </li>
                            <?php endif; endforeach; endif; ?>
                        </ul>
                    </div>

                    <div class="write-comment">
                        <h4 class="heading font-bold mb-10">Share your views</h4>
                        <p class="mb-30">We respect the views of our readers, please be polite while commenting.</p>
                        <form action="#" method="POST" enctype="multipart/form-data" id="commentBox">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="comment-text" name="message" rows="5" placeholder="Write your message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="comment"  id="save" class="btn btn-primary"><i class="ion-pencil-sharp icon-left"></i> Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                                    <button class="btn btn-secondary" type="submit" name="sub" id="sub">Go</button>
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

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/footer.php");
?>
<!-- <script>
        $(document).ready(function(){
            $('#save').click(function(){
                $.ajax({
                    type:"post",
                    url: '/adapto/ajax-add-comment.php',
                    data: $("#commentBox").serialize(),
                    success:function(data) {
                        $("#commentBox").trigger("reset");
                        $("#display-comments").load(" #display-comments > *");
                    }
                });
            });
            $("#display-comments").load(" #display-comments > *");
        });
</script> -->