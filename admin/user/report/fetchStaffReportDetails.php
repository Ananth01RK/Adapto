<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php");
	
	function get_test_count($test_name) {
		global $db;
		$sql = "SELECT COUNT(1) as 'total_count' FROM testing WHERE test_name ='$test_name'";
		$result = $db->query($sql); 
		return $result->fetch()['total_count'];
	}
	$html_content = "";
	
	if(isset($_REQUEST["staffs_staffs_no"])) 
	{
		$staffs_staffs_no = trim($_REQUEST["staffs_staffs_no"]);
		$sql = "SELECT * FROM testing LEFT JOIN staffs ON staffs.staffs_sys_id = testing.test_created_by WHERE staffs.staffs_staffs_no='$staffs_staffs_no'";
		$result_set = $db->query($sql);
		if($result_set->rowCount()>0)
		{
					
			$html_content = $html_content."
				<div class='panel panel-default'>
					<div class='panel-body'>
						
						<div class='container-fluid'>
							<a href='/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/user/report/make_lab_staff_report_excel?id=$staffs_staffs_no' class='btn btn-success btn-block'>Export to Excel&nbsp;<i class='fa fa-file-excel-o'></i></a>
						</div><br>
						<div class='col-md-3'>
							<div class='panel panel-default'>
								<div class='panel-body'>
									<div class='test-details'>
										<h3>Tests</h3>
										<ul class='list-group'>
											<li class='list'>Blood Test<span class='badge'>".get_test_count("bloodtest")."</span>
											</li>
											<li class='list'>Cholesterol<span class='badge'>".get_test_count("Cholesterol")."</span>
											</li>
											<li class='list'>BMD Test<span class='badge'>".get_test_count("BMD")."</span>
											</li>
											<li class='list'>Blood pressure<span class='badge'>".get_test_count("bloodpressure")."</span>
											</li> 
											<li class='list'>Kidney Function Test<span class='badge'>".get_test_count("kidneyfunctiontest")."</span>
											</li>
											<li class='list'>Breast Cancer Detection<span class='badge'>".get_test_count("cancer_detection")."</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class='col-md-9'>
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
