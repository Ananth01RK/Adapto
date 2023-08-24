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
$sql ="SELECT * FROM testing testing LEFT JOIN patient patient on testing.test_pat_application_id =patient.pat_application_id WHERE testing.test_pat_application_id='".$_GET['id']."' OR testing.test_name='".$_GET['id']."'";
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
							<th>Sr No.</th>
							<th>Patient Id</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Last Name</th>
							<th>Gender</th>
							<th>Blood Group</th>
							<th>Height</th>
							<th>Weight</th>
							<th>Age</th>
							<th>Test Name</th>
							<th>CBC</th>
							<th>WBC</th>
							<th>RBC</th>
							<th>HDL</th>
							<th>LDL</th>
							<th>Sodium</th>
							<th> Total Cholesterol</th>
							<th>HDL</th>
							<th>LDL</th>
							<th>Triglycerides</th>
							<th>Osteoclast Coefficient</th>
							<th>Amount of Calcium Loss</th>
							<th>Degree of Osteoporosis</th>
							<th>Degree of Bone Hyperplasia</th>
							<th>None Mineral Density</th>
							<th>SBP</th>
							<th>DBP</th>
							<th>MAP(Mean Arterial Pressure)</th>
							<th>Blood Urea Nitrogen</th>
							<th>Serum Uric Acid</th>
							<th>Serum Sodium</th>
							<th>Serum Potassium</th>
							<th>Chloride</th>
							<th>Total Protein</th>
							<th>Breast Cancer Result</th>
						</thead>
						<tbody>';
							$count = 1; foreach($datas as $data): 
							$result = $result.'
								<tr>
									<td>'.$count.'</td>
									<td>'.strtoupper($data['pat_application_id']).'</td>
									<td>'.strtoupper($data['pat_firstname']).'</td>
									<td>'.strtoupper($data['pat_middlename']).'</td>
									<td>'.strtoupper('<b>'.$data['pat_lastname']).'</td>
									<td>'.strtoupper('<b>'.$data['pat_gender']).'</td>
									<td>'.$data['pat_blood_group'].'</td>
									<td>'.$data['pat_height']."cm".'</td>
									<td>'.$data['pat_weight']."kg".'</td>
									<td>'. getAge(date("Y", strtotime($data['pat_date_of_birth'])), date("m", strtotime($data['pat_date_of_birth'])), date("d", strtotime($data['pat_date_of_birth']))).'</td>';
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
									<td>'.$data['test_cbc'].'</td>
									<td>'.$data['test_wbc'].'</td>
									<td>'.$data['test_rbc'].'</td>
									<td>'.$data['test_hdl'].'</td>
									<td>'.$data['test_ldl'].'</td>
									<td>'.$data['test_sodium'].'</td>
									<td>'.$data['test_total_cholesterol'].'</td>
									<td>'.$data['test_cholesterol_hdl'].'</td>
									<td>'.$data['test_cholesterol_ldl'].'</td>
									<td>'.$data['test_cholesterol_triglycerides'].'</td>
									<td>'.$data['test_osteoclast_coeff'].'</td>
									<td>'.$data['test_calcium'].'</td>
									<td>'.$data['test_ostero'].'</td>
									<td>'.$data['test_bone_hyper'].'</td>
									<td>'.$data['test_mineral_den'].'</td>
									<td>'.$data['test_sbp'].'</td>
									<td>'.$data['test_dbp'].'</td>
									<td>'.$data['test_map'].'</td>
									<td>'.$data['test_urea_nitro'].'</td>
									<td>'.$data['test_ser_uric'].'</td>
									<td>'.$data['test_ser_sodium'].'</td>
									<td>'.$data['test_ser_potassium'].'</td>
									<td>'.$data['test_chloride'].'</td>
									<td>'.$data['test_protein'].'</td>
									<td>'.$data['test_result'].'</td>
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