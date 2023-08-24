<script type="text/javascript" src="/adapto/admin/assets/js/chart.min.js"></script>
<script type="text/javascript" src="/adapto/admin/assets/js/googleData.js"></script>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");

	if(!isset($_SESSION["user_id"]) || !is_numeric($_SESSION["user_id"]))
	{
		redirect_label:
		echo "<script>window.location='/adapto/admin/index.php';</script>";
		exit(0);
	}
	
	if(in_array("staff", $_SESSION["sysu_role"]))
	{
		$sysu_id =$_SESSION["user_id"];
		$sql = "SELECT * FROM staffs WHERE sysu_id='$sysu_id' && staff_status='0'";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		if($stmt->rowCount())
		{
			echo "<script>window.location='/adapto/admin/user/lab_staff/edit_staff.php';</script>";
			exit(0);
		}
	}
	
?>
<div class="container-fluid" id="container">
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
	</div>
	<div class="row">
		
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Total Dogs Adopted <i class="fa fa-dog-leashed" aria-hidden="true"></i></div>
				<div class="panel-body">
					<h5 class="count-text">
						<?php $sql ="SELECT COUNT(flag) FROM post where flag='adopted'";
							$result = $db->query($sql); 
							$count = $result->fetch()[0];
							echo $count;
						?>
					</h5>
					<p class="count-sm-text">Dogs Adopted</p>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Total Dogs Breed <i class="fa fa-dog" aria-hidden="true"></i></div>
				<div class="panel-body">
					<h5 class="count-text">
						<?php $sql ="SELECT COUNT(id) FROM dog_breed";
							$result = $db->query($sql); 
							$count = $result->fetch()[0];
							echo $count;
						?>
					</h5>
					<p class="count-sm-text">Dogs Breed</p>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Total Staffs <i class="fa fa-group" aria-hidden="true"></i></div>
				<div class="panel-body">
					<h5 class="count-text">
						<?php $sql ="SELECT COUNT(id) FROM staffs";
							$result = $db->query($sql); 
							$count = $result->fetch()[0];
							echo $count;
						?>
					</h5>
					<p class="count-sm-text">Members</p>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Total Partners <i class="fa fa-handshake-alt" aria-hidden="true"></i></div>
				<div class="panel-body">
					<h5 class="count-text">
						<?php $sql ="SELECT COUNT(id) FROM partner";
							$result = $db->query($sql); 
							$count = $result->fetch()[0];
							echo $count;
						?>
					</h5>
					<p class="count-sm-text">Partners</p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Yearly Report <i class="fa fa-area-chart" aria-hidden="true"></i></div>
				<div class="panel-body">
					<canvas id="chart1"></canvas>
					<script>
						var ctx = document.getElementById('chart1').getContext("2d");
						var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
						gradientStroke.addColorStop(0, 'rgba(173,77,250)');
						gradientStroke.addColorStop(1, 'rgba(112,107,233)');

						var gradientFill = ctx.createLinearGradient(500, 0, 100, 0);
						gradientFill.addColorStop(0, "rgba(173,77,250,0.15)");
						gradientFill.addColorStop(1, "rgba(112,107,233,0.15)");

						var myChart = new Chart(ctx, {
							type: 'line',
							data: {
								labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL","AUG","SEP","OCT","NOV","DEC"],
								datasets: [{
									label: "Data",
									borderColor: gradientStroke,
									pointBorderColor: gradientStroke,
									pointBackgroundColor: gradientStroke,
									pointHoverBackgroundColor: gradientStroke,
									pointHoverBorderColor: gradientStroke,
									pointBorderWidth: 2,
									pointHoverRadius: 10,
									pointHoverBorderWidth: 1,
									pointRadius: 3,
									fill: true,
									backgroundColor: gradientFill,
									borderWidth: 4,
									data: [100, 120, 150, 170, 180, 170, 160,10,50,90,150,20]
								}]
							},
							options: {
								legend: {
									position: "bottom"
								},
								scales: {
									yAxes: [{
										ticks: {
											fontColor: "rgba(0,0,0,0.5)",
											fontStyle: "bold",
											beginAtZero: true,
											maxTicksLimit: 5,
											padding: 20
										},
										gridLines: {
											drawTicks: false,
											display: false
										}

									}],
									xAxes: [{
										gridLines: {
											zeroLineColor: "transparent"
										},
										ticks: {
											padding: 20,
											fontColor: "rgba(0,0,0,0.5)",
											fontStyle: "bold"
										}
									}]
								}
							}
						});
					</script>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Monthly Report <i class="fa fa-area-chart" aria-hidden="true"></i></div>
				<div class="panel-body">
					<canvas id="chart2"></canvas>
					<script>
						var ctx = document.getElementById('chart2').getContext("2d");
						var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
						gradientStroke.addColorStop(0, 'rgba(173,77,250)');
						gradientStroke.addColorStop(1, 'rgba(112,107,233)');

						var gradientFill = ctx.createLinearGradient(500, 0, 100, 0);
						gradientFill.addColorStop(0, "rgba(173,77,250,0.15)");
						gradientFill.addColorStop(1, "rgba(112,107,233,0.15)");

						var myChart = new Chart(ctx, {
							type: 'line',
							data: {
								labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],
								datasets: [{
									label: "Data",
									borderColor: gradientStroke,
									pointBorderColor: gradientStroke,
									pointBackgroundColor: gradientStroke,
									pointHoverBackgroundColor: gradientStroke,
									pointHoverBorderColor: gradientStroke,
									pointBorderWidth: 2,
									pointHoverRadius: 10,
									pointHoverBorderWidth: 1,
									pointRadius: 3,
									fill: true,
									backgroundColor: gradientFill,
									borderWidth: 4,
									data: [100, 120, 150, 170, 180, 170, 160,10,50,90,150,20,100,100, 120, 150, 170, 180, 170, 160,10,50,90,150,20, 120, 150, 170, 180, 170, 160,10,50,90,150,20]
								}]
							},
							options: {
								legend: {
									position: "bottom"
								},
								scales: {
									yAxes: [{
										ticks: {
											fontColor: "rgba(0,0,0,0.5)",
											fontStyle: "bold",
											beginAtZero: true,
											maxTicksLimit: 5,
											padding: 20
										},
										gridLines: {
											drawTicks: false,
											display: false
										}

									}],
									xAxes: [{
										gridLines: {
											zeroLineColor: "transparent"
										},
										ticks: {
											padding: 20,
											fontColor: "rgba(0,0,0,0.5)",
											fontStyle: "bold"
										}
									}]
								}
							}
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/footer.php");
?>
<script type="text/javascript">
	$.growl.notice({ title: "Adapto", message: "Welcome to your control panel" });
</script>