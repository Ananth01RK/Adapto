<?php 
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php");
	if(!isset($_GET["id"]))
	{
		exit(0);
	}
header('Content-type: application/excel');
$filename = $_GET["id"].' - Report'.date("d-m-Y h-i-s").'.xls';
header('Content-Disposition: attachment; filename='.$filename);
	$sql = "SELECT * FROM testing LEFT JOIN staffs ON staffs.staffs_sys_id = testing.test_created_by WHERE staffs.staffs_staffs_no='".$_GET["id"]."'";
	$result_set = $db->query($sql); 
	if($result_set->rowCount()):
		$datas = $result_set->fetchAll(PDO::FETCH_ASSOC); 

			$result = $result.
			'<html xmlns:x="urn:schemas-microsoft-com:office:excel">
				<head>
					<xml>
						<x:ExcelWorkbook>
							<x:ExcelWorksheets>
								<x:ExcelWorksheet>
									<x:Name>Sheet 1</x:Name>
									<x:WorksheetOptions>
										<x:Print>
											<x:ValidPrinterInfo/>
										</x:Print>
									</x:WorksheetOptions>
								</x:ExcelWorksheet>
							</x:ExcelWorksheets>
						</x:ExcelWorkbook>
					</xml>
				</head>

				<body>
					<table>
						<thead>
							<tr>
								<th>Sr.No.</th>
								<th>Patient ID</th>
								<th>Test No.</th>
								<th>Test name</th>
								<th>Message</th>
								<th>Date</th>
								<th>Time</th>
							</tr>
						</thead>
						<tbody>';
							$count = 1; foreach($datas as $data): 
							$result = $result.'
								<tr>
									<td>'.$count.'</td>
									<td>'.strtoupper($data['test_pat_application_id']).'</td>
									<td>'.strtoupper($data['test_test_no']).'</td>';
										$test_name_array = array(
											"bloodtest"=>"Blood Test",
											"Cholesterol"=>"Cholesterol",
											"bloodpressure"=>"Blood Pressure",
											"kidneyfunctiontest"=>"Kidney Function Test",
											"BMD"=>"BMD Test",
											"cancer_detection"=>"Breast Cancer Detection"
										);
									$result = $result.'
									<td>'.$test_name_array[$data['test_name']].'</td>
									<td>'.$data['test_message'].'</td>
									<td>'.date("d-m-Y",strtotime($data["test_creation_timestamp"])).'</td>
									<td>'.date("h-m-s A",strtotime($data["test_creation_timestamp"])).'</td>
								</tr>';
							$count = $count +1; endforeach;	
						$result = $result.'
						</tbody>
					</table>
				</body>
			</html>';
	 endif;
	echo $result;
?>