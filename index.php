<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
?>
    <section class="pt-100 pb-100" >
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pb-60">
                    <h5 class="heading h4 mb-10 font-bold text-primary">Best Care For Dog</h5>
                    <h4 class="heading font-bold font-16 mb-20">Pets are happy when they are cared for.</h4>
                    <p class="h5 text-lh-7 mb-0">Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <a href="login.php" class="btn btn-primary mt-40">Adopt one today</a>
                </div>
                <div class="col-lg-6">
                    <img class="img-responsive" src="./assets/images/undraw_good_doggy_-4-wfq.svg" style="width:500px;">
                </div>
            </div>
        </div>
    </section>

    

    <div class="container mt-80">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="heading-block">
                    <h3 class="heading font-bold">Benefits & Features</h3>
                    <p class="sub-heading">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-3 mt-20">
                <div class="feature-box pr-lg-10">
                    <div class="text">
                        <h5 class="heading font-bold mb-10"><i class="ion-golf-outline text-primary icon-left"></i>Highly Experienced</h5>
                        <p class="mb-0">Excepteur sint occaecat cupidatat non proident</p>
                    </div>
                </div>
                <div class="feature-box pr-lg-10 mt-40">
                    <div class="text">
                        <h5 class="heading font-bold mb-10"><i class="ion-medkit-outline text-primary icon-left"></i> Advanced Equipment</h5>
                        <p class="mb-0">Excepteur sint occaecat cupidatat non proident</p>
                    </div>
                </div>
                <div class="feature-box pr-lg-10 mt-40">
                    <div class="text">
                        <h5 class="heading font-bold mb-10"><i class="ion-people-outline text-primary icon-left"></i> Excepteur</h5>
                        <p class="mb-0">Excepteur sint occaecat cupidatat non proident.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pl-40 pr-40 mt-20 d-none d-lg-block">
                <img src="./assets/images/fb-adoption.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-3 mt-20">
                <div class="feature-box pl-lg-10">
                    <div class="text">
                        <h5 class="heading font-bold mb-10"><i class="ion-library-outline text-primary icon-left"></i> Large Network</h5>
                        <p class="mb-0">Excepteur sint occaecat cupidatat non proident.</p>
                    </div>
                </div>
                <div class="feature-box pl-lg-10 mt-40">
                    <div class="text">
                        <h5 class="heading font-bold mb-10"><i class="ion-flask-outline text-primary icon-left"></i> Excepteur </h5>
                        <p class="mb-0">Excepteur sint occaecat cupidatat non proident.</p>
                    </div>
                </div>
                <div class="feature-box pl-lg-10 mt-40">
                    <div class="text">
                        <h5 class="heading font-bold mb-10"><i class="ion-medal-outline text-primary icon-left"></i> Excepteur</h5>
                        <p class="mb-0">Excepteur sint occaecat cupidatat non proident.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="pt-80 pb-80 mt-80 bg-grey-9" style="background-image: url(images/bg-pattern-3.png);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="heading-block">
                        <h3 class="heading text-white font-bold">Popular Services</h3>
                        <p class="sub-heading text-white opacity-07">There live the blind texts separated they right at the coast of the Semantics.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-20">
                <div class="col-lg-12">
                    <div class="flexible-slider" data-items="3" data-items-992="2" data-items-768="1" data-arrows="true" data-dots="false">
                        <div class="slider-items">
                            <div class="item">
                                <div class="department-box-5">
                                    <div class="head">
                                        <h4 class="heading font-5 font-bold mb-0">Teeth Cleaning</h4>
                                    </div>
                                    <div class="body">
                                        <p class="mb-20 font-2 text-muted">Behind the word mountains far from the Vokalia.</p>
                                        <h6 class="heading font-bold">Includes:</h6>
                                        <ul class="list-styled mb-0">
                                            <li><i class="ion-paw list-icon"></i>Overall health checkup</li>
                                            <li><i class="ion-paw list-icon"></i>Appetite & food habits</li>
                                            <li><i class="ion-paw list-icon"></i>Stool check & diagnosis</li>
                                        </ul>
                                        <div class="price mt-20">
                                            <strike class="text-muted">$99</strike>
                                            <ins class="new-price">$89</ins>
                                            <span class="badge badge-primary">10% Off</span>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="item">
                                <div class="department-box-5">
                                    <div class="head">
                                        <h4 class="heading font-5 font-bold mb-0">Potty Training</h4>
                                    </div>
                                    <div class="body">
                                        <p class="mb-20 font-2 text-muted">Behind the word mountains far from the Vokalia.</p>
                                        <h6 class="heading font-bold">Includes:</h6>
                                        <ul class="list-styled mb-0">
                                            <li><i class="ion-paw list-icon"></i>Overall health checkup</li>
                                            <li><i class="ion-paw list-icon"></i>Appetite & food habits</li>
                                            <li><i class="ion-paw list-icon"></i>Stool check & diagnosis</li>
                                        </ul>
                                        <div class="price mt-20">
                                            <strike class="text-muted">$75</strike>
                                            <ins class="new-price">$50</ins>
                                            <span class="badge badge-primary">22% Off</span>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="item">
                                <div class="department-box-5">
                                    <div class="head">
                                        <h4 class="heading font-5 font-bold mb-0">Grooming</h4>
                                    </div>
                                    <div class="body">
                                        <p class="mb-20 font-2 text-muted">Behind the word mountains far from the Vokalia.</p>
                                        <h6 class="heading font-bold">Includes:</h6>
                                        <ul class="list-styled mb-0">
                                            <li><i class="ion-paw list-icon"></i>Overall health checkup</li>
                                            <li><i class="ion-paw list-icon"></i>Appetite & food habits</li>
                                            <li><i class="ion-paw list-icon"></i>Stool check & diagnosis</li>
                                        </ul>
                                        <div class="price mt-20">
                                            <strike class="text-muted">$120</strike>
                                            <ins class="new-price">$90</ins>
                                            <span class="badge badge-primary">30% Off</span>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="item">
                                <div class="department-box-5">
                                    <div class="head">
                                        <h4 class="heading font-5 font-bold mb-0">Health Checkup</h4>
                                    </div>
                                    <div class="body">
                                        <p class="mb-20 font-2 text-muted">Behind the word mountains far from the Vokalia.</p>
                                        <h6 class="heading font-bold">Includes:</h6>
                                        <ul class="list-styled mb-0">
                                            <li><i class="ion-paw list-icon"></i>Overall health checkup</li>
                                            <li><i class="ion-paw list-icon"></i>Appetite & food habits</li>
                                            <li><i class="ion-paw list-icon"></i>Stool check & diagnosis</li>
                                        </ul>
                                        <div class="price mt-20">
                                            <strike class="text-muted">$99</strike>
                                            <ins class="new-price">$89</ins>
                                            <span class="badge badge-primary">10% Off</span>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="item">
                                <div class="department-box-5">
                                    <div class="head">
                                        <h4 class="heading font-5 font-bold mb-0">Ultrasound</h4>
                                    </div>
                                    <div class="body">
                                        <p class="mb-20 font-2 text-muted">Behind the word mountains far from the Vokalia.</p>
                                        <h6 class="heading font-bold">Includes:</h6>
                                        <ul class="list-styled mb-0">
                                            <li><i class="ion-paw list-icon"></i>Overall health checkup</li>
                                            <li><i class="ion-paw list-icon"></i>Appetite & food habits</li>
                                            <li><i class="ion-paw list-icon"></i>Stool check & diagnosis</li>
                                        </ul>
                                        <div class="price mt-20">
                                            <strike class="text-muted">$50</strike>
                                            <ins class="new-price">$40</ins>
                                            <span class="badge badge-primary">5% Off</span>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="slider-nav-outer">
                            <div class="slider-nav nav-light">
                                <div class="slider-arrows">
                                    <div class="icon-prev"><i class="ion-arrow-back-sharp"></i></div>
                                    <div class="icon-next"><i class="ion-arrow-forward-sharp"></i></div>
                                </div>
                                <div class="slider-dots">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="pt-80 pb-80 mt-80" style="background-image: url(images/1920-520-1.jpg); background-position: center center; background-size: cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="heading font-bold text-lh-6 text-primary mb-10">Found a pet that needs urgent help?</h3>
                    <h5 class="text-lh-7 mb-30">Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h5>
                    <a href="contact-3.html" class="btn btn-outline-primary">Report a Case</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-80 mb-60">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-block">
                    <h3 class="heading font-bold">We're Professionals</h3>
                    <p class="sub-heading">Separated live in Bookmarksgrove right at the coast of the Semantics</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-20">
                <div class="doctor-box-3">
                    <div class="doctor-img">    
                        <img src="images/350-350-2.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="doctor-detail">
                        <h6 class="heading font-bold">Joyce Wood</h6>
                        <span class="doctor-desig">Sr. Veterinary</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-20">
                <div class="doctor-box-3">
                    <div class="doctor-img">    
                        <img src="images/350-350-6.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="doctor-detail">
                        <h6 class="heading font-bold">Chad Jensen</h6>
                        <span class="doctor-desig">Associate</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-20">
                <div class="doctor-box-3">
                    <div class="doctor-img">
                        <img src="images/350-350-3.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="doctor-detail">
                        <h6 class="heading font-bold">Billie Love</h6>
                        <span class="doctor-desig">Surgeon</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-20">
                <div class="doctor-box-3">
                    <div class="doctor-img">    
                        <img src="images/350-350-4.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="doctor-detail">
                        <h6 class="heading font-bold">Victoria Estep</h6>
                        <span class="doctor-desig">Helper</span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

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
                                            <h5 class="heading bold"><?php echo $users[0]['fname']." &nbsp;".$users[0]['lname']; ?></h5>
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
    <div class="container mt-80 mb-40">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="heading font-bold">Partners & Sponsors</h3>
            </div>
        </div>
        <div class="row mt-20">
            <div class="col-lg-12">
                <div class="flexible-slider" data-items="5" data-items-992="3" data-items-768="1" data-arrows="false" data-dots="true">
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
                    <div class="slider-nav-outer">
                        <div class="slider-nav">
                            <div class="slider-arrows">
                            </div>
                            <div class="slider-dots">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container mt-80 mb-40">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-block">
                    <h3 class="heading font-bold">Read New Stories</h3>
                    <p class="sub-heading">Behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
            <div class="col-lg-4 mt-20">
                <div class="blog-grid">
                    <div class="blog-header">
                        <img src="images/550-291-1.jpg" class="img-fluid rounded mb-30" alt="">
                        <div class="blog-meta mb-10">
                            <ul class="meta-list">
                                <li class="posted-on">
                                    <a href="">
                                        <span class="date">23</span>
                                        <span class="month">Sep</span>
                                    </a>
                                </li>
                                <li class="posted-in"><a href="">Technology</a></li>
                            </ul>
                        </div>  
                        <h4 class="heading font-bold text-lh-5 mb-10">Technology can help you become healthy</h4>
                    </div>
                    <div class="blog-excerpt">
                        <p>Behind the word mountains, far from the countries Vokalia, there live the texts</p>
                        <a href="blog-single.html" class="link-primary">Read More..</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-20">
                <div class="blog-grid">
                    <div class="blog-header">
                        <img src="images/550-291-2.jpg" class="img-fluid rounded mb-30" alt="">
                        <div class="blog-meta mb-10">
                            <ul class="meta-list">
                                <li class="posted-on">
                                    <a href="">
                                        <span class="date">10</span>
                                        <span class="month">Oct</span>
                                    </a>
                                </li>
                                <li class="posted-in"><a href="">Food</a></li>
                            </ul>
                        </div>  
                        <h4 class="heading font-bold text-lh-5 mb-10">Healthier options for those hunger-pangs</h4>
                    </div>
                    <div class="blog-excerpt">
                        <p>Behind the word mountains, far from the countries Vokalia, there live the texts</p>
                        <a href="blog-single.html" class="link-primary">Read More..</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-20">
                <div class="blog-grid">
                    <div class="blog-header">
                        <img src="images/550-291-3.jpg" class="img-fluid rounded mb-30" alt="">
                        <div class="blog-meta mb-10">
                            <ul class="meta-list">
                                <li class="posted-on">
                                    <a href="">
                                        <span class="date">25</span>
                                        <span class="month">Nov</span>
                                    </a>
                                </li>
                                <li class="posted-in"><a href="">Health Care</a></li>
                            </ul>
                        </div>  
                        <h4 class="heading font-bold text-lh-5 mb-10">Complete guide to shoulder &amp; neck pain</h4>
                    </div>
                    <div class="blog-excerpt">
                        <p>Behind the word mountains, far from the countries Vokalia, there live the texts</p>
                        <a href="blog-single.html" class="link-primary">Read More..</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="pt-60 pb-80 mt-80 overflow-hidden" style="background-image:url('images/1920-450-1.jpg'); background-size: cover; background-position: center center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-20 pr-lg-30">
                    <h3 class="heading font-bold text-white">Get in Touch</h3>
                    <p class="h6 text-white mb-30">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p class="h6 d-flex align-items-top text-white"><i class="ion-location-outline icon-left text-light"></i>5th Floor, Ameritrunk Building,<br> Times Square, USA-12435</p>
                    <p class="h6 d-flex align-items-center text-white"><i class="ion-call-outline icon-left text-light"></i>213-562-5625</p>
                    <ul class="social social-2x d-inline-flex mt-20">
                        <li><a class="facebook" href=""><i class="ion-logo-facebook"></i></a></li>
                        <li><a class="twitter" href=""><i class="ion-logo-twitter"></i></a></li>
                        <li><a class="google" href=""><i class="ion-logo-google"></i></a></li>
                        <li><a class="whatsapp" href=""><i class="ion-logo-whatsapp"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-6 mt-20 pl-lg-30">
                    <h3 class="heading text-white font-bold">Send Message</h3>
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control style-2" name="" placeholder="Your name">
                        </div>
                        <div class="input-group mt-20">
                            <input type="text" class="form-control style-2" name="" placeholder="Phone No.">
                        </div>
                        <div class="input-group mt-20">
                            <textarea class="form-control style-2" style="height: 70px" placeholder="Your message"></textarea>
                        </div>
                        <button class="btn btn-outline-light mt-30">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Adapto/includes/footer.php");
?>
 