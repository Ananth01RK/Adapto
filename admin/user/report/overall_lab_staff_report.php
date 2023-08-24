<script type="text/javascript" src="/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/assets/js/chart.min.js"></script>
<?php
	$title = "Lab Staff Report";
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php");
	
	function get_test_count($staff_id, $test_name) {
		global $db;
		$sql = "SELECT COUNT(1) as 'total_count' FROM testing WHERE  test_created_by=$staff_id && test_name ='$test_name'";
		$result = $db->query($sql); 
		return $result->fetch()['total_count'];
	}
?>
<div class="container-fluid" id="container">
	<?php require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/view_error_message.php"); ?>
	<?php
		$datas = array();
		$sql = "SELECT system_users.sysu_id,system_users.sysu_id,system_users.sysu_username,staffs.staffs_firstname,staffs.staffs_status FROM system_users system_users LEFT JOIN staffs staffs on system_users.sysu_id = staffs.staffs_sys_id WHERE staffs.staffs_status='1' ORDER BY system_users.sysu_id ASC";
		$stmt = $db->query($sql);
		if($stmt->rowCount()):
			$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($datas as $data):
	?>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading"><?php echo $data["staffs_firstname"]." (".$data["sysu_username"].")"; ?> - Overview <i class="fa fa-bar-chart" aria-hidden="true"></i></div>
						<div class="panel-body">
							<canvas id="myChart<?php echo $data['sysu_id']; ?>"></canvas>
							<script>
								var chart = document.getElementById("myChart<?php echo $data['sysu_id']; ?>").getContext('2d');
								var myChart = new Chart(chart,
								{
									type: 'bar',
									data:
									{
											labels: ['Blood Test','Cholesterol','BMD Test','Blood pressure','Kidney Function Test','Breast Cancer Detection'],
											datasets:
											[
												{
													label: "Overview",
													data: [
														<?php echo get_test_count($data['sysu_id'], "bloodtest"); ?>,
														<?php echo get_test_count($data['sysu_id'], "Cholesterol"); ?>,
														<?php echo get_test_count($data['sysu_id'], "bloodpressure"); ?>,
														<?php echo get_test_count($data['sysu_id'], "BMD"); ?>,
														<?php echo get_test_count($data['sysu_id'], "kidneyfunctiontest"); ?>,
														<?php echo get_test_count($data['sysu_id'], "cancer_detection"); ?>
													],
													backgroundColor: [
														'rgba(255, 99, 132, 0.2)',
														'rgba(54, 162, 235, 0.2)',
														'rgba(255, 206, 86, 0.2)',
														'rgba(75, 192, 192, 0.2)',
														'rgba(153, 102, 255, 0.2)',
														'rgba(255, 159, 64, 0.2)'
													],
													borderColor: [
														'rgba(255, 99, 132, 1)',
														'rgba(54, 162, 235, 1)',
														'rgba(255, 206, 86, 1)',
														'rgba(75, 192, 192, 1)',
														'rgba(153, 102, 255, 1)',
														'rgba(255, 159, 64, 1)'
													],
													borderWidth: 1
												}
											],				
									},
									options: 
									{
										scales: 
										{
											yAxes:
											[
												{
													ticks: {
														beginAtZero: true,
														fontColor: '#fff'
														
													},
													gridLines:{
														color:'#a5a5a5'
													}
												}
											],
											xAxes:
											[
												{
													ticks: {
														fontColor: '#fff'
														
													},
													gridLines:{
														color:'#a5a5a5'
													}
												}
											]
											
										},
										legend: {
											display: false
										}
									}
								});
							</script>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/footer.php");
?>