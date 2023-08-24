<?php
	$title = "Profile";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	
	if(!isset($_GET['id']) || !is_numeric($_GET['id']))
	{
		redirect_label:
		echo "<script>window.location='/adapto/admin/user/dashboard.php';</script>";
		exit(0);
	}
?>
<div class="container">
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
	</div>
	<div class="container">
		<div class="row">
			<?php if($datas = fetchData(array("table" => "staffs","condition" => "WHERE id=".$_GET["id"]))): $data = $datas[0]; ?>
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading"><?php echo $title; ?></div>
						<div class="panel-body">
							<div class="profile-details">
								<div class="text-center">
									<?php if($data['img'] != null){ ?>
										<img src="<?php echo $data['img'];?>" class="circle" style="">
									<?php } else{?>
										<img src="/adapto/admin/assets/img/user.png" class="circle" style="">
									<?php } ?>
									<div class="title">
										<h4 class="text-center"><?php echo $data['fname']." ".$data['lname'];?></strong></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="col-md-12">
								<ul class="nav nav-tabs nav-justified">
									<li class="active"><a data-toggle="tab" href="#personal_details">Personal Details</a></li>
									<li><a data-toggle="tab" href="#contact_details">Contact Details</a></li>
								</ul>
									<div class="tab-content">
										<div id="personal_details" class="tab-pane fade in active">
											<div class="container col-md-12 well">
												<div class="row">
													<div class="col-md-3">
														<p class="small-text">Firstname:</p>
														<p class="title-text"><?php echo $data['fname']; ?></p>
													</div>
													<div class="col-md-3">
														<p class="small-text">Middlename:</p>
														<p class="title-text"><?php echo $data['mname']; ?></p>
													</div>
													<div class="col-md-3">
														<p class="small-text">Lastname:</p>
														<p class="title-text"><?php echo $data['lname']; ?></p>
													</div>
													<div class="col-md-3">
														<p class="small-text">Gender:</p>
														<p class="title-text"><?php echo $data['gender']; ?></p>
													</div>
												</div>
											</div>
										</div>
										<div id="contact_details" class="tab-pane fade well">
											<div class="row">
												<div class="col-md-6">
													<p class="small-text">Mobile No. :</p>
													<p class="title-text"><?php echo $data['phoneno']; ?></p>
												</div>
												<div class="col-md-6">
													<p class="small-text">Email Address:</p>
													<p class="title-text"><?php echo $data['email']; ?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<p class="small-text">Address:</p>
													<p class="title-text"><?php echo $data['staff_address']; ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/footer.php");
?>