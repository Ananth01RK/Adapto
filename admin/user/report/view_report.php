<?php
	$title = "View Report";
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php");
	
	if(!isset($_GET['id']) || !is_numeric($_GET['id']))
	{
		
	}
?>
<style>
</style>
<div class="container">
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/view_error_message.php"); ?>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 button">
				<a href="/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/user/test/view_pdf?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-info btn-width col-md-offset-11 col-md-12">Print <i class="fa fa-print"></i></a>
			</div>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo $title; ?>&nbsp;<i class="fa fa-eye"></i></div>
					<div class="panel-body">
						<?php if($datas = fetchData(array("table" => "testing","condition" => "WHERE test_id=".$_GET["id"]))): $data = $datas[0]; ?>
						<div class="row">
							<div class="col-md-3">
								<p class="small-text">Patient ID:</p>
								<p class="title-text">
									<?php if($data['test_pat_application_id']!= null): ?>
										<?php echo strtoupper($data['test_pat_application_id']); ?>
									<?php endif; ?>
								</p>
							</div>
							<div class="col-md-3">
								<p class="small-text">Test ID:</p>
								<p class="title-text">
									<?php if($data['test_test_no']!= null): ?>
										<?php echo strtoupper($data['test_test_no']); ?>
									<?php endif; ?>
								</p>
							</div>
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
							<div class="col-md-3">
								<p class="small-text">Test Name:</p>
								<p class="title-text"><?php echo $test_name_array[$data['test_name']]; ?></p>
							</div>
							<?php if($data['test_cbc']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">CBC:</p>
									<p class="title-text"><?php echo $data['test_cbc']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_wbc']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">WBC:</p>
									<p class="title-text"><?php echo $data['test_wbc']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_rbc']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">RBC:</p>
									<p class="title-text"><?php echo $data['test_rbc']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_hdl']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">HDL:</p>
									<p class="title-text"><?php echo $data['test_hdl']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_ldl']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">LDL:</p>
									<p class="title-text"><?php echo $data['test_ldl']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_sodium']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Sodium:</p>
									<p class="title-text"><?php echo $data['test_sodium']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_total_cholesterol']!= null): ?>
								<div class="col-md-3">
									<p class="small-text"> Total Cholesterol:</p>
									<p class="title-text"><?php echo $data['test_total_cholesterol']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_cholesterol_hdl']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">HDL:</p>
									<p class="title-text"><?php echo $data['test_cholesterol_hdl']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_cholesterol_ldl']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">LDL:</p>
									<p class="title-text"><?php echo $data['test_cholesterol_ldl']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_cholesterol_triglycerides']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Triglycerides:</p>
									<p class="title-text"><?php echo $data['test_cholesterol_triglycerides']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_osteoclast_coeff']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Osteoclast Coefficient:</p>
									<p class="title-text"><?php echo $data['test_osteoclast_coeff']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_calcium']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Amount of Calcium Loss:</p>
									<p class="title-text"><?php echo $data['test_calcium']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_ostero']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Degree of Osteoporosis:</p>
									<p class="title-text"><?php echo $data['test_ostero']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_bone_hyper']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Degree of Bone Hyperplasia:</p>
									<p class="title-text"><?php echo $data['test_bone_hyper']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_mineral_den']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">None Mineral Density:</p>
									<p class="title-text"><?php echo $data['test_mineral_den']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_sbp']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">SBP:</p>
									<p class="title-text"><?php echo $data['test_sbp']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_dbp']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">DBP:</p>
									<p class="title-text"><?php echo $data['test_dbp']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_map']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">MAP(Mean Arterial Pressure):</p>
									<p class="title-text"><?php echo $data['test_map']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_urea_nitro']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Blood Urea Nitrogen:</p>
									<p class="title-text"><?php echo $data['test_urea_nitro']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_ser_creatinine']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Serum Creatinine:</p>
									<p class="title-text"><?php echo $data['test_ser_creatinine']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_ser_uric']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Serum Uric Acid:</p>
									<p class="title-text"><?php echo $data['test_ser_uric']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_ser_sodium']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Serum Sodium:</p>
									<p class="title-text"><?php echo $data['test_ser_sodium']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_ser_potassium']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Serum Potassium:</p>
									<p class="title-text"><?php echo $data['test_ser_potassium']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_chloride']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Chloride:</p>
									<p class="title-text"><?php echo $data['test_chloride']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_protein']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Total Protein:</p>
									<p class="title-text"><?php echo $data['test_protein']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_result']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Result:</p>
									<p class="title-text"><?php echo $data['test_result']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_message']!= null): ?>
								<div class="col-md-3">
									<p class="small-text">Message:</p>
									<p class="title-text"><?php echo $data['test_message']; ?></p>
								</div>
							<?php endif; ?>
							<?php if($data['test_created_by']!= null): ?>
								<?php if($systems = fetchData(array("table" => "system_users","condition" => "WHERE sysu_id=".$data['test_created_by']))): $system = $systems[0]; ?>
									<div class="col-md-3">
										<p class="small-text">Test Created By:</p>
										<p class="title-text"><?php echo strtoupper($system['sysu_username']); ?></p>
									</div>
								<?php endif; ?>
							<?php endif; ?>
							<?php if($data['test_mammographic_image_path']!= null): ?>
								<div class="col-md-12">
									<p class="small-text">Breast Cancer Image:</p>
									<p class="title-text"><img src="<?php echo $data['test_mammographic_image_path']; ?>" class="cancer_image"></p>
								</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/footer.php");
?>