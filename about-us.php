<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
?>
<div class="container mt-80">
    <div class="row justify-content-center">
        <div class="col-lg-10 text-center">
            <h3 class="heading font-bold">Our Journey</h3>
            <hr class="hr-1">
            <p class="font-4 text-lh-10 mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur.</p>
        </div>
    </div>
    <div class="row no-gutters mt-40">
        <div class="col-lg-4">
            <div class="process-box-1 first">
                <div class="process-box-header">
                    <i class="ion-download-outline icon"></i>
                </div>
                <div class="process-box-body">
                    <h5 class="heading font-bold">Founded</h5>
                    <p>Excepteur sint occaecat cupidatat non proident</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="process-box-1">
                <div class="process-box-header">
                    <i class="ion-calendar-outline icon"></i>
                </div>
                <div class="process-box-body">
                    <h5 class="heading font-bold">Small Team</h5>
                    <p>Excepteur sint occaecat cupidatat non proident</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="process-box-1">
                <div class="process-box-header">
                    <i class="ion-eyedrop-outline icon"></i>
                </div>
                <div class="process-box-body">
                    <h5 class="heading font-bold">Expansion</h5>
                    <p>Excepteur sint occaecat cupidatat non proident</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pt-60 pb-80 mt-80 bg-grey-1" style="background-image: url(images/world-map-3.png); background-repeat: no-repeat; background-position: right bottom; background-size: 38%;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 pr-30 mt-20">
                <img src="./assets/images/founder.jpg" class="img-fluid rounded-circle img-thumbnail">
            </div>
            <div class="col-lg-7 pl-30 mt-20">
                <h3 class="heading font-bold mb-10">Words from Our Founder</h3>
                <h5 class="text-primary font-semi-bold">Founder </h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <blockquote class="pr-80 mt-20 mb-30">
                    <img src="./assets/images/quote-light.svg" class="quotes">
                    <p class="font-style-3 font-italic mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
                </blockquote>
                <p class="h6 font-bold">- Ananth Radhakrishnan</p>
            </div>
        </div>
    </div>
</div>
<div class="pt-80 pb-80 mt-80 parallax" data-speed="2.3" style="background-image:url('./assets/images/Stray_dog_puppy.jpg'); background-size: cover; background-position: center center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="heading font-bold text-white mb-20">Happy Pets, Happy Owners</h3>
            </div>
        </div>
        <div class="row justify-content-center mt-20">
            <div class="col-lg-10">
                <div class="testimonial-1 slider-light">
                    <div class="slider-items">
                        <?php if($datas = fetchData(array("table" =>"testimonials","condition" =>""))):  
                            $count = 1; foreach($datas as $data):
                        ?>
                            <div class="testimonial-item">
                                <p class="testimonial-text font-style-3 font-italic text-lh-10"><?php echo $data['text']; ?></p>
                                <div class="testimonial-author">   
                                    <?php if($users = fetchData(array("table" =>"user","condition" =>"where id=".$data["uid"]))): ?>
                                        <h5 class="heading bold"><?php echo $users[0]['fname']; ?></h5>
                                        <p class="text-muted mb-0"><?php echo $users[0]['uaddress']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="slider-nav-outer">
                        <div class="slider-nav">
                            <?php if($datas = fetchData(array("table" =>"testimonials","condition" =>""))):  
                                $count = 1; foreach($datas as $data):
                            ?>
                                <div class="testimonial-author-img">
                                    <?php if($users = fetchData(array("table" =>"user","condition" =>"where id=".$data["uid"]))): ?>
                                        <img src="<?php echo $users[0]['uimage'];?>" class="img-fluid" alt="">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-80 mb-80">
    <div class="row align-items-center">
        <div class="col-lg-12">
            <div class="flexible-slider" data-items="5" data-items-992="3" data-items-768="2" data-arrows="false" data-dots="false">
                <div class="slider-items">
                    <?php if($datas = fetchData(array("table" =>"partner","condition" =>""))):  
                        $count = 1; foreach($datas as $data):
                    ?>
                            <div class="item">
                                <img src="<?php echo $data['pimage'];?>" class="img-fluid pl-30 pr-30" alt="">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/footer.php");
?>