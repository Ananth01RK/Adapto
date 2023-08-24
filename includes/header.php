<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Adapto</title>
    <link rel='icon' type='image/ico' href='./assets/images/adapto-logo.png' />
    <link href="./assets/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="./assets/css/ionicons.css" type="text/css" rel="stylesheet">
    <!-- Stylesheets --> 
    <link href="./assets/css/vendors.min.css" type="text/css" rel="stylesheet">
    <link href="./assets/css/style.min.css" type="text/css" rel="stylesheet" id="style">
    <link href="./assets/css/components.min.css" type="text/css" rel="stylesheet" id="components">
    <!--Google Fonts--> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-colorpicker@3.4.0/dist/css/bootstrap-colorpicker.css">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Manrope:wght@300;400;600;800&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="loader-backdrop">           <!-- Loader -->
        <div class="loader">
            <i class="ion-heart-outline"></i>
        </div>
    </div>
    <header class="header-1">           <!-- Header -->
        <div class="topbar">            <!-- Topbar -->
            <div class="container-lg">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="topbar-items">
                            <ul class="widgets">
                                <li class="region-widget d-none d-lg-inline-flex"><i class="ion-call-outline"></i> +91 8695455782</li>
                            </ul>
                            <ul class="widgets">
                                <li class="region-widget d-none d-lg-inline-flex"><i class="ion-earth"></i> India</li>
                                <li class="email-widget d-none d-lg-inline-flex"><i class="ion-mail-outline"></i> tech-adapto@gmail.com</li>
                                
                                <?php if(!isset($_SESSION["user_web_id"]) || !is_numeric($_SESSION["user_web_id"]))
	                                { ?>
                                        <li class="emergency-widget">
                                            <a class="btn btn-primary" href="login.php">           
                                                <span class="sub-text">Login</span>
                                            </a>
                                        </li>
                                    <?php
                                    }else{
                                        if(isset($_SESSION["user_web_id"]) || is_numeric($_SESSION["user_web_id"]))
                                        { ?>
                                            <li class="emergency-widget">
                                                <a class="btn btn-primary" href="logout.php">           
                                                    <span class="sub-text">Logout</span>
                                                </a>
                                            </li>
                                        <?php 
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg sticky-nav">         <!-- Navigation Bar -->
            <div class="container">            
                <a class="navbar-brand" href="index">
                    <img src="./assets/images/adapto-logo.png" alt="" class="logo">         <!-- Replace with your Logo -->
                </a>

                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#main-navigation">
                    <span class="navbar-toggler-icon">          <!-- Mobile Menu Toggle -->
                        <span class="one"></span>
                        <span class="two"></span>
                        <span class="three"></span>
                    </span>
                </button>

                <div class="navbar-collapse collapse" id="main-navigation">         <!-- Main Menu -->
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="/adapto/index.php">Home</a></li>
                        <li class="nav-item"><a href="/adapto/about-us.php">About</a></li>
                        <li class="nav-item"><a href="/adapto/blogs.php">Blog</a></li>
                        <li class="nav-item has-menu"><a href="/adapto/contact-us.php">Contact</a></li>
                        <?php
                            if(!isset($_SESSION["user_web_id"]) || !is_numeric($_SESSION["user_web_id"]))
                            {  }
                            else{
                                if(isset($_SESSION["user_web_id"]) || is_numeric($_SESSION["user_web_id"]))
                                { ?>
                                    <li class="nav-item has-menu"><a href="add_post.php">Add Post </a></li>
                                <?php 
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>          
        </nav>
    </header>