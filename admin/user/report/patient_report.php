<?php
	$title = "Patient Report";
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php");
?>
<div class="container">
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/view_error_message.php"); ?>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?=$lang['index-patient-report'];?></div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
										<div class="row">
											<div class="col-offset-md-12 col-md-12">
												<div class="form-group">
													<label for="test_pat_application_id">Patient ID</label>
													<input type="text" id="test_pat_application_id" name="test_pat_application_id" class="form-control" placeholder="Patient ID" autocomplete="off" >
													<code></code>
												</div>
											</div>
										</div>
										<button type="button" name="submit" id="submit" class="btn btn-primary btn-margin btn-width" disabled>Search</button>
										<a href="/ProjectSem/user/dashboard" class="btn btn-danger btn-margin btn-width">Clear</a>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="update-section" class="col-md-12">
			</div>
		</div>
	</div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/footer.php");
?>
<script>
	$("#test_pat_application_id").on("input",function(){
		if($("#test_pat_application_id").val().length > 0){
			$.ajax({
				url:'/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/user/test/checkPatientID.php?id='+ $("#test_pat_application_id").val(),
				type:'GET',
				success:function(response){
					if(response == "true"){
						$("#submit").attr("disabled",false);
						$("#test_pat_application_id + code").html("");
						$("#test_pat_application_id + code").hide();
					}
					else{
						$("#submit").attr("disabled",true);
						$("#test_pat_application_id + code").html("Invalid patient ID.");
						$("#test_pat_application_id + code").show();
					}
				}
			});
		}
		else{
			$("#submit").attr("disabled",true);
			$("#test_pat_application_id + code").html("");	
			$("#test_pat_application_id + code").hide();		
		}	
	});
	$("#test_pat_application_id + code").hide();

	$("#submit").click(function(){
		var test_pat_application_id = $("#test_pat_application_id").val();
		$.ajax({
			type: 'post',
			url	: 'fetchPatientReportDetails.php?test_pat_application_id=' + test_pat_application_id,
			success:function(response){
				$("#update-section").html(response);
			}
		});
	});
</script>  