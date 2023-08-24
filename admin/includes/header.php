<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");


	if(!isset($_SESSION["user_id"]) || !is_numeric($_SESSION["user_id"]))
	{
		echo "<script>window.location='/adapto/admin/index';</script>";
		exit(0);
	}
	function get_pendingAccount_count() {
		global $db;
		$sql = "SELECT COUNT(1) as 'total_count' FROM staffs WHERE staff_status='0' AND fname!=''";
		$result = $db->query($sql); 
		return $result->fetch()['total_count'];
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Adapto | Admin Dashboard</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel='icon' type='image/ico' href='/adapto/assets/images/adapto-logo.png' />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/adapto/admin/assets/css/datatables.min.css">
		<link rel="stylesheet" type="text/css" href="/adapto/admin/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="/adapto/admin/assets/css/jquery.growl.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css" integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous"/>
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet">
	</head>
	<body class="no-skin">
		<div class="container">
			<div class="row">
				<div class="logo-div">
					<a href="/adapto/admin/user/dashboard.php"><img src="/adapto/assets/images/adapto-logo.png" class="img-responsive center-block"></a>
				</div>
			</div>
		</div>		
		<nav class="navbar navbar-default"data-spy="affix" data-offset-top="80">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="navbar-brand hidden-lg hidden-md hidden-sm">Menu</span>
				</div>
				<div class="collapse navbar-collapse  navbar-ex1-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<?php if(personalDetailsStatus($_SESSION["user_id"]) || in_array("admin", $_SESSION["sysu_role"])): ?>
							<li>
								<a href="/adapto/admin/user/dashboard.php">Dashboard</a>
							</li>
						<?php endif; ?>		
						<?php if(in_array("staff", $_SESSION["sysu_role"])): ?>
							<li>
								<a href="/adapto/admin/user/lab_staff/edit_staff.php">Profile</a>
							</li>
						<?php endif; ?>				
						<?php if(in_array("admin", $_SESSION["sysu_role"])): ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accounts &nbsp;<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li>
										<a href="/adapto/admin/user/system users/add_system_users.php">Create Staff Account</a>
									</li>
									<li>
										<a href="/adapto/admin/user/system users/list_system_users.php">List Staff Accounts</a>
									</li>
									<li>
										<a href="/adapto/admin/user/system users/list_retired_system_users.php">List Retired Users </a>
									</li>
								</ul>
							</li>
						<?php endif; ?>
						
						<?php if(in_array("admin", $_SESSION["sysu_role"])): ?>
							<li>
								<a href="/adapto/admin/user/lab_staff/list_pending_accounts.php">Pending Accounts &nbsp;<span class='badge' style="background-color:#23f155 !important;"><?php echo get_pendingAccount_count();?></span></a>
							</li>
							<li>
								<a href="/adapto/admin/user/lab_staff/list_approved_accounts.php">Approved Accounts </a>
							</li>
						<?php endif; ?>
						<?php if(personalDetailsStatus($_SESSION["user_id"]) || in_array("admin", $_SESSION["sysu_role"])): ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Post &nbsp;<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li>
										<a href="/adapto/admin/user/posts/add_post.php">Create Post</a>
									</li>
									<li>
										<a href="/adapto/admin/user/posts/list_post.php">List Posts </a>
									</li>
								</ul>
							</li>
						<?php endif; ?>
						<?php if(personalDetailsStatus($_SESSION["user_id"]) || in_array("admin", $_SESSION["sysu_role"])): ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dog Details &nbsp;<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li>
										<a href="/adapto/admin/user/dog/add_dog_breed.php">Add/List Dog Breed</a>
									</li>
									<li>
										<a href="/adapto/admin/user/dog/add_dog_food.php">Add/List Dog Food</a>
									</li>
								</ul>
							</li>
						<?php endif; ?>
						<?php if(personalDetailsStatus($_SESSION["user_id"]) || in_array("admin", $_SESSION["sysu_role"])): ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Partner &nbsp;<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li>
										<a href="/adapto/admin/user/partner/add_partner.php">Add Partner</a>
									</li>
									<li>
										<a href="/adapto/admin/user/partner/list_partner.php">List Partner</a>
									</li>
								</ul>
							</li>
						<?php endif; ?>
						<?php if(personalDetailsStatus($_SESSION["user_id"]) || in_array("admin", $_SESSION["sysu_role"])): ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports &nbsp;<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php if(in_array("admin", $_SESSION["sysu_role"])): ?>
										<li>
											<a href="/adapto/admin/user/system users/add_system_users.php">Overall Staff Report</a>
										</li>
										<li>
											<a href="/adapto/admin/user/system users/add_system_users.php">Staff Report</a>
										</li>
									<?php endif; ?>
									<li>
										<a href="/adapto/admin/user/system users/add_system_users.php">Adopted Dog Report</a>
									</li>
								</ul>
							</li>
						<?php endif; ?>
						<li>
							<a href="/adapto/admin/user/change_password.php">Change Password</a>
						</li>
						<li>
							<a href="/adapto/admin/logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div id="particles-js"></div> 
		<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
		<script >
			particlesJS("particles-js", {
			"particles": {
				"number": {
					"value": 60,
					"density": {
						"enable": true,
						"value_area": 900
					}
				},
				"color": {
					"value": "#ffffff"
				},
				"shape": {
					"type": "circle",
					"stroke": {
						"width": 0,
						"color": "#000000"
					},
					"polygon": {
						"nb_sides": 5
					},
					"image": {
						"src": "img/github.svg",
						"width": 100,
						"height": 100
					}
				},
				"opacity": {
					"value": 0.5,
					"random": false,
					"anim": {
						"enable": false,
						"speed": 1,
						"opacity_min": 0.1,
						"sync": false
					}
				},
				"size": {
					"value": 3,
					"random": true,
					"anim": {
						"enable": false,
						"speed": 40,
						"size_min": 0.1,
						"sync": false
					}
				},
				"line_linked": {
					"enable": true,
					"distance": 150,
					"color": "#ffffff",
					"opacity": 0.4,
					"width": 1
				},
				"move": {
					"enable": true,
					"speed": 6,
					"direction": "none",
					"random": false,
					"straight": false,
					"out_mode": "out",
					"bounce": false,
					"attract": {
						"enable": false,
						"rotateX": 600,
						"rotateY": 1200
					}
				}
			},
			"interactivity": {
				"detect_on": "canvas",
				"events": {
					"onhover": {
						"enable": true,
						"mode": "repulse"
					},
					"onclick": {
						"enable": true,
						"mode": "push"
					},
					"resize": true
				},
				"modes": {
					"grab": {
						"distance": 400,
						"line_linked": {
							"opacity": 1
						}
					},
					"bubble": {
						"distance": 400,
						"size": 40,
						"duration": 2,
						"opacity": 8,
						"speed": 3
					},
					"repulse": {
						"distance": 200,
						"duration": 0.4
					},
					"push": {
						"particles_nb": 4
					},
					"remove": {
						"particles_nb": 2
					}
				}
			},
			"retina_detect": true
		});
		</script>