<?php
	$title = "Test Report";
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php");
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
					<div class="panel-heading"><?=$lang['index-test-report'];?></div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
										<div class="row">
											<div class="col-offset-md-12 col-md-12">
												<div class="form-group">
													<label for="test_name">Test Name</label>
													<select name="test_name" id="test_name"class="form-control" required>
														<option value="">Select Test</option>
														<option value="bloodtest" id="">Blood Test</option>
														<option value="Cholesterol" id="">Cholesterol</option>
														<option value="BMD" id="">BMD Test</option>
														<option value="bloodpressure" id="">Blood pressure </option>
														<option value="kidneyfunctiontest" id="">Kidney Function Test</option>
														<option value="cancer_detection" id="">Cancer Detection</option>
													</select>
												</div>
											</div>
										</div>
										<button type="button" name="submit" id="submit" class="btn btn-primary btn-margin btn-width">Search</button>
										<a href="/ProjectSem/user/dashboard" class="btn btn-danger btn-margin btn-width">Clear</a>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="update-section" class="col-md-12"></div>
		</div>
	</div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/footer.php");
?>
<script>
	$("#submit").click(function(){
		var test_name = $("#test_name").val();
		$.ajax({
			type: 'post',
			url	: 'fetchTestReportDetails.php?test_name=' + test_name,
			success:function(response){
				$("#update-section").html(response);
			}
		});
	});
</script>  