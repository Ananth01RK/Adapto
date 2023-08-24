<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php");
	
	if(isset($_POST["excel"]))
	{
		echo "<script>window.location='/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/user/report/make_report_excel?id=".$test_id."';</script>";
		exit(0);
	}
	function get_test_count($test_name) {
		global $db;
		$sql = "SELECT COUNT(1) as 'total_count' FROM testing WHERE test_name ='$test_name'";
		$result = $db->query($sql); 
		return $result->fetch()['total_count'];
	}
	$html_content = "";
	if(isset($_REQUEST["test_name"])) 
	{
		$test_name = trim($_REQUEST["test_name"]);
		$sql = "SELECT * FROM testing WHERE test_name='$test_name'";
		$result_set = $db->query($sql);
		$test_pat_application_id = "";
		if($result_set->rowCount()>0)
		{
					
			$html_content = $html_content."
				<div class='panel panel-default'>
					<div class='panel-body'>
						
						<div class='container-fluid'>";
						$html_content = $html_content."
							<a href='/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/user/report/make_report_excel?id=$test_name' id='excel' name='excel' class='btn btn-success btn-block'>Export to Excel&nbsp;<i class='fa fa-file-excel-o'></i></a>
						</div><br>
						<div class='col-md-12'>
							<div class='panel panel-default'>
								<div class='panel-body'>
									<div class='table-responsive'>
										<table id='myTable' class='table table-bordered js-basic-example dataTable myTable'>
											<thead class='thead-dark'>
												<tr>
													<th>Sr.No.</th>
													<th>Patient ID</th>
													<th>Test No.</th>
													<th>Test name</th>
													<th>Message</th>
													<th>Date</th>
													<th>Time</th>
													<th>View</th>
													<th>Print</th>
												</tr>
											</thead>
											<tbody>";
			$test_name_array = array(
				"bloodtest"=>"Blood Test",
				"Cholesterol"=>"Cholesterol",
				"bloodpressure"=>"Blood Pressure",
				"kidneyfunctiontest"=>"Kidney Function Test",
				"BMD"=>"BMD Test",
				"cancer_detection"=>"Breast Cancer Detection"
			);
			$count = 1; foreach($result_set as $data):
			$html_content = $html_content."
											<tr>
												<th>".$count."</th>
												<th>".strtoupper($data["test_pat_application_id"])."</th>
												<td>".strtoupper($data["test_test_no"])."</td>
												<td>".$test_name_array[$data["test_name"]]."</td>
												<td>".$data["test_message"]."</td>
												<td>".date("d-m-Y",strtotime($data["test_creation_timestamp"]))."</td>
												<td>".date("h:i:s A",strtotime($data["test_creation_timestamp"]))."</td>
												<td>
													<a href='/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/user/report/view_report?id=".$data["test_id"]."' class='btn btn-primary btn-width'><i class='fa fa-eye'></i></a>
												</td>
												<td>
													<a href='/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/user/test/view_pdf?id=".$data['test_id']."' class='btn btn-info btn-width' target='_blank'><i class='fa fa-print'></i></a>
												</td>
														
											</tr>";
			$count = $count + 1; endforeach;
			$html_content = $html_content."
											</tbody>
										</table>
									</div>	
								</div>
							</div>
						</div>";
		}
		else
		{
			$html_content = $html_content."	
				<div class='panel panel-default'>
					<div class='panel-body'>
						<h4 style='text-align:center;'>No Record(s)</h4>
					</div>
				</div>";
		}
				
	}
	echo $html_content;
?>
