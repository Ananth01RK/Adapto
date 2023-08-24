<?php
	$title = "Create Test";
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php");
	
	if(isset($_POST["submit"]))
	{
		$test_created_by = trim($_SESSION["user_id"]);
		$test_pat_application_id = $_POST["test_pat_application_id"];
		extract($_POST);
		$error_flag = false;
		
		if(strlen($test_pat_application_id)== 0 || strlen($test_name)== 0)
		{
			$error_flag = true;
			$_SESSION["error_message"][] = "Please fill in all mandatory fields.";
		}
		// if(fetchData(array("table" => "testing", "condition" => "WHERE test_pat_application_id != '$test_pat_application_id'")))
		// {
			// $error_flag = true;
			// $_SESSION["error_message"][] = "Sorry there's no such Patient ID.";	
		// }
		if($error_flag === false)
		{
			$sql = "INSERT INTO testing (test_pat_application_id,test_name,test_cbc,test_wbc,test_rbc,test_hdl,test_ldl,test_sodium,test_total_cholesterol,test_cholesterol_hdl,test_cholesterol_ldl,test_cholesterol_triglycerides,test_osteoclast_coeff,test_calcium,test_bone_hyper,test_ostero,test_mineral_den,test_sbp,test_dbp,test_map,test_urea_nitro,test_ser_creatinine,test_ser_uric,test_ser_sodium,test_ser_potassium,test_chloride,test_protein,test_created_by,test_creation_timestamp) VALUES (:test_pat_application_id,:test_name,:test_cbc,:test_wbc,:test_rbc,:test_hdl,:test_ldl,:test_sodium,:test_total_cholesterol,:test_cholesterol_hdl,:test_cholesterol_ldl,:test_cholesterol_triglycerides,:test_osteoclast_coeff,:test_calcium,:test_bone_hyper,:test_ostero,:test_mineral_den,:test_sbp,:test_dbp,:test_map,:test_urea_nitro,:test_ser_creatinine,:test_ser_uric,:test_ser_sodium,:test_ser_potassium,:test_chloride,:test_protein,:test_created_by,NOW())";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":test_pat_application_id",$test_pat_application_id);
			$stmt->bindParam(":test_name",$test_name);
			$stmt->bindParam(":test_cbc",$test_cbc);
			$stmt->bindParam(":test_wbc",$test_wbc);
			$stmt->bindParam(":test_rbc",$test_rbc);
			$stmt->bindParam(":test_hdl",$test_hdl);
			$stmt->bindParam(":test_ldl",$test_ldl);
			$stmt->bindParam(":test_sodium",$test_sodium);
			$stmt->bindParam(":test_total_cholesterol",$test_total_cholesterol);
			$stmt->bindParam(":test_cholesterol_hdl",$test_cholesterol_hdl);
			$stmt->bindParam(":test_cholesterol_ldl",$test_cholesterol_ldl);
			$stmt->bindParam(":test_cholesterol_triglycerides",$test_cholesterol_triglycerides);
			$stmt->bindParam(":test_osteoclast_coeff",$test_osteoclast_coeff);
			$stmt->bindParam(":test_calcium",$test_calcium);
			$stmt->bindParam(":test_bone_hyper",$test_bone_hyper);
			$stmt->bindParam(":test_ostero",$test_ostero);
			$stmt->bindParam(":test_mineral_den",$test_mineral_den);
			$stmt->bindParam(":test_sbp",$test_sbp);
			$stmt->bindParam(":test_dbp",$test_dbp);
			$stmt->bindParam(":test_map",$test_map);
			$stmt->bindParam(":test_urea_nitro",$test_urea_nitro);
			$stmt->bindParam(":test_ser_creatinine",$test_ser_creatinine);
			$stmt->bindParam(":test_ser_uric",$test_ser_uric);
			$stmt->bindParam(":test_ser_sodium",$test_ser_sodium);
			$stmt->bindParam(":test_ser_potassium",$test_ser_potassium);
			$stmt->bindParam(":test_chloride",$test_chloride);
			$stmt->bindParam(":test_protein",$test_protein);
			$stmt->bindParam(":test_created_by",$test_created_by);
			
			if($stmt->execute())
			{	
				$sql = "SELECT test_id FROM testing WHERE test_pat_application_id=:test_pat_application_id ORDER BY test_id DESC";
				$data = $db->prepare($sql);
				$data->bindParam(":test_pat_application_id", $test_pat_application_id);
				if($data->execute())
				{
					$test_id = $data->fetchColumn();
					$_SESSION["success_message"][] = "Successfully Added";
					
					$test_test_no="TES".$test_id;
					$sql="UPDATE testing SET test_test_no=:test_test_no WHERE test_id=:test_id";
					$stmt=$db->prepare($sql);
					$stmt->bindParam(":test_id", $test_id);
					$stmt->bindParam(":test_test_no", $test_test_no);
					$stmt->execute();
					echo "<script>window.location='/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/user/test/view_details?id=".$test_id."';</script>";
				}
			}
			else
			{
				$_SESSION["error_message"][] = "Failed to create.";
			}
		}
		else
		{
			$_SESSION["error_message"][] = "Failed to create.";
		}
		echo "<script>window.location='".$_SERVER["PHP_SELF"]."';</script>";
		exit(0);
	}
?>
<div class="container" >
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/view_error_message.php"); ?>
	</div>
	<div class="container col-md-12">
        <div class="row">
            <div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?=$lang['index-create-test'];?></div>
					<div class="panel-body">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="test_pat_application_id" class="highlight">Patient ID</label>
										<input type="text" id="test_pat_application_id" name="test_pat_application_id" class="form-control" autocomplete="off" placeholder="Patient ID" required>
										<code></code>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="test_name" class="highlight">Test</label>
										<select name="test_name" id="test_name"class="form-control" required>
											<option value="">Select Test</option>
											<option value="bloodtest" id="">Blood Test</option>
											<option value="Cholesterol" id="">Cholesterol</option>
											<option value="BMD" id="">BMD Test</option>
											<option value="bloodpressure" id="">Blood pressure </option>
											<option value="kidneyfunctiontest" id="">Kidney Function Test</option>
										</select>
									</div>
								</div>
								<div id="update_test_section" class="col-md-12">
									<div class="bloodtest box">
										<div class="col-md-2">
											<label for="test_cbc">CBC</label>
											<input type="text" id="test_cbc" name="test_cbc" class="form-control"  autocomplete="off" placeholder="CBC">
										</div>
										<div class="col-md-2">
											<label for="test_wbc">WBC</label>
											<input type="text" id="test_wbc" name="test_wbc" class="form-control"  autocomplete="off" placeholder="WBC">
										</div>
										<div class="col-md-2">
											<label for="">RBC</label>
											<input type="text" id="test_rbc" name="test_rbc" class="form-control"  autocomplete="off" placeholder="RBC">
										</div>
										<div class="col-md-2">
											<label for="">HDL</label>
											<input type="text" id="test_hdl" name="test_hdl" class="form-control"  autocomplete="off" placeholder="HDL">
										</div>
										<div class="col-md-2">
											<label for="">LDL</label>
											<input type="text" id="test_ldl" name="test_ldl" class="form-control"  autocomplete="off" placeholder="LDL">
										</div>
										<div class="col-md-2">
											<label for="">Sodium</label>
											<input type="text" id="test_sodium" name="test_sodium" class="form-control"  autocomplete="off" placeholder="Sodium">
										</div>
									</div>
									<div class="Cholesterol box">
										<div class="col-md-3">
											<label for=""> Total Cholesterol</label>
											<input type="text" id="test_total_cholesterol" name="test_total_cholesterol" class="form-control"  autocomplete="off" placeholder=" Total Cholesterol">
										</div>
										<div class="col-md-3">
											<label for="">HDL</label>
											<input type="text" id="test_cholesterol_hdl" name="test_cholesterol_hdl" class="form-control"  autocomplete="off" placeholder="HDL">
										</div>
										<div class="col-md-3">
											<label for="">LDL</label>
											<input type="text" id="test_cholesterol_ldl" name="test_cholesterol_ldl" class="form-control"  autocomplete="off" placeholder="LDL">
										</div>
										<div class="col-md-3">
											<label for="">Triglycerides</label>
											<input type="text" id="test_cholesterol_triglycerides" name="test_cholesterol_triglycerides" class="form-control"  autocomplete="off" placeholder="Triglycerides">
										</div>
									</div>
									<div class="BMD box">
										<div class="col-md-2">
											<label for="test_osteoclast_coeff">Osteoclast Coefficient</label>
											<input type="text" id="test_osteoclast_coeff" name="test_osteoclast_coeff" class="form-control"  autocomplete="off" placeholder="Osteoclast Coefficient">
										</div>
										<div class="col-md-2">
											<label for="test_calcium">Amount of Calcium Loss</label>
											<input type="text" id="test_calcium" name="test_calcium" class="form-control"  autocomplete="off" placeholder="Amount of Calcium Loss">
										</div>
										<div class="col-md-2">
											<label for="test_bone_hyper">Degree of Bone Hyperplasia</label>
											<input type="text" id="test_bone_hyper" name="test_bone_hyper" class="form-control"  autocomplete="off" placeholder="Degree of Bone Hyperplasia">
										</div>
										<div class="col-md-3">
											<label for="test_ostero">Degree of Osteoporosis</label>
											<input type="text" id="test_ostero" name="test_ostero" class="form-control"  autocomplete="off" placeholder="SBP">
										</div>
										<div class="col-md-3">
											<label for="test_mineral_den">None Mineral Density</label>
											<input type="text" id="test_mineral_den" name="test_mineral_den" class="form-control"  autocomplete="off" placeholder="None Mineral Density">
										</div>
									</div>
									<div class="bloodpressure box">
										<div class="col-md-4">
											<label for="test_sbp">SBP</label>
											<input type="text" id="test_sbp" name="test_sbp" class="form-control"  autocomplete="off" placeholder="SBP">
										</div>
										<div class="col-md-4">
											<label for="test_dbp">DBP</label>
											<input type="text" id="test_dbp" name="test_dbp" class="form-control"  autocomplete="off" placeholder="DBP">
										</div>
										<div class="col-md-4">
											<label for="test_map">MAP(Mean Arterial Pressure)</label>
											<input type="text" id="test_map" name="test_map" class="form-control"  autocomplete="off" placeholder="MAP(Mean Arterial Pressure)">
										</div>
								   </div>	
									<div class="kidneyfunctiontest box">
										<div class="col-md-3">
											<label for="test_urea_nitro">Blood Urea Nitrogen</label>
											<input type="text" id="test_urea_nitro" name="test_urea_nitro" class="form-control"  autocomplete="off" placeholder="Blood Urea Nitrogen ">
										</div>
										<div class="col-md-3">
											<label for="test_ser_creatinine">Serum Creatinine</label>
											<input type="text" id="test_ser_creatinine" name="test_ser_creatinine" class="form-control"  autocomplete="off" placeholder="Serum Creatinine">
										</div>
										<div class="col-md-3">
											<label for="test_ser_uric">Serum Uric Acid</label>
											<input type="text" id="test_ser_uric" name="test_ser_uric" class="form-control"  autocomplete="off" placeholder="Serum Uric Acid">
										</div>
										<div class="col-md-3">
											<label for="test_ser_sodium">Serum Sodium</label>
											<input type="text" id="test_ser_sodium" name="test_ser_sodium" class="form-control"  autocomplete="off" placeholder="Serum Sodium">
										</div>
										<div class="col-md-4">
											<label for="test_ser_potassium">Serum Potassium</label>
											<input type="text" id="test_ser_potassium" name="test_ser_potassium" class="form-control"  autocomplete="off" placeholder="Serum Potassium">
										</div>
										<div class="col-md-4">
											<label for="test_chloride">Chloride</label>
											<input type="text" id="test_chloride" name="test_chloride" class="form-control"  autocomplete="off" placeholder="Chloride">
										</div>
										<div class="col-md-4">
											<label for="test_protein">Total Protein</label>
											<input type="text" id="test_protein" name="test_protein" class="form-control"  autocomplete="off" placeholder="Total Protein">
										</div>
								   </div>							   
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="test_message">Message</label>
										<textarea id="test_message"  rows="6" name="test_message" class="form-control" autocomplete="off" placeholder="Message"></textarea>
									</div>
								</div>
							</div>
							<button type="submit" name="submit" id="submit" class="btn btn-primary btn-margin btn-width" disabled>Create</button>
							<a href="/ProjectSem/user/dashboard" class="btn btn-danger btn-margin btn-width">Clear</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/footer.php");
?>
<script>
	$("#test_pat_application_id").on("input",function(){
		if($("#test_pat_application_id").val().length >0){
			$.ajax({
				type:'GET',
				url:'checkPatientID?id=' + $("#test_pat_application_id").val(),
				success:function(response){
					if(response == "true"){
						$("#submit").attr("disabled",false);
						$("#test_pat_application_id + code").html("");
						$("#test_pat_application_id + code").hide("");
					}
					else{
						$("#submit").attr("disabled",true);
						$("#test_pat_application_id + code").html("Invalid Patient ID.");
						$("#test_pat_application_id + code").show("");
					}
				}
			});
		}
		else{
			$("#submit").attr("disabled",false);
			$("#test_pat_application_id + code").html("");
			$("#test_pat_application_id + code").hide("");
		}
	});
	$("#test_pat_application_id + code").hide("");

	$(document).ready(function(){
		$('select').change(function() {
			$(this).find("option:selected").each(function(){
				var option = $(this).attr("value");
				if(option){
					$(".box").not("." + option).hide();
					$("."+ option).show();
				}
				else{
					$(".box").hide();
				}
			});
		}).change();    
	});
</script>       