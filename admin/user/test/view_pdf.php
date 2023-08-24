<?php
	$title = "";
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php");
	
	if(!isset($_GET['id']) || !is_numeric($_GET['id']))
	{
		redirect_label:
		echo "<script>window.location='/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/user/test/create_test';</script>";
		exit(0);
	}
?>
<style>
	th{
		text-align:left;
		padding:15px 0 0 10px;
	}
	td p{
		margin-bottom:1px;
	}
	td{
		padding: 5px 0 5px 8px;

	}
</style>

<?php $sql ="SELECT * FROM testing testing LEFT JOIN patient patient on testing.test_pat_application_id =patient.pat_application_id  WHERE testing.test_id=".$_GET['id'];
	$result_set = $db->query($sql); 
	if($result_set->rowCount()){
		$datas = $result_set->fetchAll(PDO::FETCH_ASSOC); 
		foreach($datas as $data):
?>
	<body onload="window.print();setTimeout(function(){window.close();}, 1);">
	<div style="text-align:center;font-size:23px;">
		<img src="/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/assets/img/logo.png" alt="No Image" height="100" width="280">
		<p><strong>REPORT</strong></p>
	</div>
	<div style="margin:0 0 -24px 478px;">
		<p style="line-height:0;">Date:<?php echo '<b>'.date("m-d-Y", strtotime($data['test_creation_timestamp'])).'</b>'; ?></p>
	</div>
	<div style="margin:0 0 0 590px;">
		<p style="line-height:1;">Time:<?php echo '<b>'.date("h:m:s a", strtotime($data['test_creation_timestamp'])).'</b>'; ?></p>
	</div>
	<table cellspacing="0" style="width:100%;" border=1>
		<tbody>
			<tr>
				<th colspan="5">
					<h3><strong>Personal Details:</h3></strong>
				</th>
			</tr>
			<tr>
				<td rowspan="3"><center><img src="<?php echo $data['pat_profile_photo_path']; ?>" class="" alt="No Image" height="100" width="100"></center></td>
				<td>
					<p>Patient Id:</p>
					<?php if($data['pat_application_id']!= null): ?>
						<?php echo strtoupper('<b>'.$data['pat_application_id'].'</b>'); ?>
					<?php endif; ?>
				</td>
				<td>
					<p>First Name:</p>
					<?php if($data['pat_firstname']!= null): ?>
						<?php echo strtoupper('<b>'.$data['pat_firstname'].'</b>'); ?>
					<?php endif; ?>
				</td>
				<td>
					<p>Middle Name:</p>
					<?php if($data['pat_middlename']!= null): ?>
						<?php echo strtoupper('<b>'.$data['pat_middlename'].'</b>'); ?>
					<?php endif; ?>
				</td>
				<td>
					<p>Last Name:</p>
					<?php if($data['pat_lastname']!= null): ?>
						<?php echo strtoupper('<b>'.$data['pat_lastname'].'</b>'); ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td>
					<p>Gender:</p>
					<?php if($data['pat_gender']!= null): ?>
						<?php echo strtoupper('<b>'.$data['pat_gender'].'</b>'); ?>
					<?php endif; ?>
				</td>
				<td>
					<p>Blood Group:</p>
					<?php if($data['pat_blood_group']!= null): ?>
						<?php echo '<b>'.$data['pat_blood_group'].'</b>'; ?>
					<?php endif; ?>
				</td>
				<td>
					<p>Height:</p>
					<?php if($data['pat_height']!= null): ?>
						<?php echo '<b>'.$data['pat_height']."cm".'</b>'; ?>
					<?php endif; ?>
				</td>
				<td>
					<p>Weight:</p>
					<?php if($data['pat_weight']!= null): ?>
						<?php echo '<b>'.$data['pat_weight']."kg".'</b>'; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<p>Age:</p>
					<?php if($data['pat_date_of_birth']!= null): ?>
						<?php 
							echo '<b>'.getAge(date("Y", strtotime($data['pat_date_of_birth'])), date("m", strtotime($data['pat_date_of_birth'])), date("d", strtotime($data['pat_date_of_birth']))).'</b>'; 
						?>
					<?php endif; ?>
				</td>			
			</tr>
		</tbody>
	</table><br>
	<table cellspacing="0" style="width:100%;" border=1>
		<thead>
			<th colspan="3">
				<h3><strong>Test Details:</strong></h3>
			</th>
			<tr>
				<?php 
					$test_name_array = array(
						"bloodtest"=>"Blood Test",
						"Cholesterol"=>"Cholesterol",
						"bloodpressure"=>"Blood Pressure",
						"kidneyfunctiontest"=>"Kidney Function Test",
						"BMD"=>"BMD Test",
						"cancer_detection"=>"Breast Cancer Detection"
					);
				?>
				<td colspan="3">
					<p>Test Name:</p>
					<?php if($data['test_name']!= null): ?>
						<?php echo '<b>'.$test_name_array[$data['test_name']].'</b>'; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th>Name</th>
				<th>Result</th>
			</tr>
		</thead>
		<tbody>
			<?php if($data['test_name'] == "bloodtest"): ?>
				<tr>
					<td><p>CBC:</p></td>
					<td >	
						<?php if($data['test_cbc']!= null): ?>
							<?php echo '<b>'.$data['test_cbc'].'</b>'; ?>
						<?php endif; ?>
					</td>
					
				</tr>
				<tr>
					<td ><p>WBC:</p></td>
					<td >
						<?php if($data['test_wbc']!= null): ?>
							<?php echo '<b>'.$data['test_wbc'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td ><p>RBC:</p></td>
					<td >
						<?php if($data['test_rbc']!= null): ?>
							<?php echo '<b>'.$data['test_rbc'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td ><p>HDL:</p></td>
					<td ><?php if($data['test_hdl']!= null): ?>
							<?php echo '<b>'.$data['test_hdl'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>LDL:</p>
					</td>
					<td><?php if($data['test_ldl']!= null): ?>
							<?php echo '<b>'.$data['test_ldl'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
			<?php endif; ?>
			<?php if($data['test_name'] == "Cholesterol"): ?>	
				<tr>
					<td>
						<p>Sodium:</p>
					</td>
					<td>
						<?php if($data['test_sodium']!= null): ?>
							<?php echo '<b>'.$data['test_sodium'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p> Total Cholesterol:</p>
					</td>
					<td>
						<?php if($data['test_total_cholesterol']!= null): ?>
							<?php echo '<b>'.$data['test_total_cholesterol'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>HDL:</p>
					</td>
					<td>
						<?php if($data['test_cholesterol_hdl']!= null): ?>
							<?php echo '<b>'.$data['test_cholesterol_hdl'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>LDL:</p>
					</td>
					<td>
						<?php if($data['test_cholesterol_ldl']!= null): ?>
							<?php echo '<b>'.$data['test_cholesterol_ldl'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>Triglycerides:</p>
					</td>
					<td>
						<?php if($data['test_cholesterol_triglycerides']!= null): ?>
							<?php echo '<b>'.$data['test_cholesterol_triglycerides'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
			<?php endif; ?>
			<?php if($data['test_name'] == "BMD"): ?>
				<tr>
					<td>
						<p>Osteoclast Coefficient:</p>
					</td>
					<td>
						<?php if($data['test_osteoclast_coeff']!= null): ?>
							<?php echo '<b>'.$data['test_osteoclast_coeff'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>Amount of Calcium Loss:</p>
					</td>
					<td>
						<?php if($data['test_calcium']!= null): ?>
							<?php echo '<b>'.$data['test_calcium'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>Degree of Osteoporosis:</p>
					</td>
					<td>
						<?php if($data['test_ostero']!= null): ?>
							<?php echo '<b>'.$data['test_ostero'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>Degree of Bone Hyperplasia:</p>
					</td>
					<td>
						<?php if($data['test_bone_hyper']!= null): ?>
							<?php echo '<b>'.$data['test_bone_hyper'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>None Mineral Density:</p>
					</td>
					<td>
						<?php if($data['test_mineral_den']!= null): ?>
							<?php echo '<b>'.$data['test_mineral_den'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
			<?php endif; ?>
			<?php if($data['test_name'] == "bloodpressure"): ?>
				<tr>
					<td>
						<p>SBP:</p>
					</td>
					<td>
						<?php if($data['test_sbp']!= null): ?>
							<?php echo '<b>'.$data['test_sbp'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>DBP:</p>
					</td>
					<td>
						<?php if($data['test_dbp']!= null): ?>
							<?php echo '<b>'.$data['test_dbp'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>MAP(Mean Arterial Pressure):</p>
					</td>
					<td>
						<?php if($data['test_map']!= null): ?>
							<?php echo '<b>'.$data['test_map'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
			<?php endif; ?>
			<?php if($data['test_name'] == "kidneyfunctiontest"): ?>
				<tr>
					<td>
						<p>Blood Urea Nitrogen:</p>
					</td>
					<td>
						<?php if($data['test_urea_nitro']!= null): ?>
							<?php echo '<b>'.$data['test_urea_nitro'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>Serum Creatinine:</p>
					</td>
					<td>
						<?php if($data['test_ser_creatinine']!= null): ?>
							<?php echo '<b>'.$data['test_ser_creatinine'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>Serum Uric Acid:</p>
					</td>
					<td>
						<?php if($data['test_ser_uric']!= null): ?>
							<?php echo '<b>'.$data['test_ser_uric'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>Serum Sodium:</p>
					</td>
					<td>
						<?php if($data['test_ser_sodium']!= null): ?>
							<?php echo '<b>'.$data['test_ser_sodium'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>Serum Potassium:</p>
					</td>
					<td>
						<?php if($data['test_ser_potassium']!= null): ?>
							<?php echo '<b>'.$data['test_ser_potassium'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>Chloride:</p>
					</td>
					<td>
						<?php if($data['test_chloride']!= null): ?>
							<?php echo '<b>'.$data['test_chloride'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>Total Protein:</p>
					</td>
					<td>
						<?php if($data['test_protein']!= null): ?>
							<?php echo '<b>'.$data['test_protein'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
			<?php endif; ?>
			<?php if($data["test_name"] == "cancer_detection"): ?>
				<tr>
					<td>
						<p>Output:</p>
					</td>
					<td>
						<?php if($data['test_result']!= null): ?>
							<?php echo '<b>'.$data['test_result'].'</b>'; ?>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<?php if($data['test_mammographic_image_path']!= null): ?>
							<center><img src="<?php echo $data['test_mammographic_image_path']; ?>" width="200" height="200"></center>
						<?php endif; ?>
					</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<div >
		<hr style="width:160px;height:1px;background-color:#000;margin:8% 0 0 2%;">
		<p style="font-weight: bold;font-size: 17px;margin:0.5% 0 0 2%;">Lab Staff's Signature</p>
	</div>
<?php endforeach; } ?>