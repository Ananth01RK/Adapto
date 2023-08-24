<?php
	$title = "Lab Staff Report";
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
					<div class="panel-heading"><?=$lang['index-staff-report'];?></div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
										<div class="row">
											<div class="col-offset-md-12 col-md-12">
												<div class="form-group">
													<label for="staffs_staffs_no">Lab Staff ID</label>
													<input type="text" id="staffs_staffs_no" name="staffs_staffs_no" class="form-control" placeholder="Lab Staff ID" autocomplete="off" required>
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
			<div id="update-section" class="col-md-12"></div>
		</div>
	</div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/footer.php");
?> 
<script>
	$("#staffs_staffs_no").on("input",function(){
		if($("#staffs_staffs_no").val().length >0){
			$.ajax({
				type:'GET',
				url:'checkLabStaffID?id=' + $("#staffs_staffs_no").val(),
				success:function(response){
					if(response == "true"){
						$("#submit").attr("disabled",false);
						$("#staffs_staffs_no + code").html("");
						$("#staffs_staffs_no +code").hide("");
					}
					else{
						$("#submit").attr("disabled",true);
						$("#staffs_staffs_no + code").html("Invalid lab staff ID.");
						$("#staffs_staffs_no +code").show("");
					}
				}
			});
		}
		else{
			$("#submit").attr("disabled",false);
			$("#staffs_staffs_no + code").html("");
			$("#staffs_staffs_no +code").hide("");
		}
	});
	$("#staffs_staffs_no +code").hide("");
	
	$("#submit").click(function(){
		var staffs_staffs_no = $("#staffs_staffs_no").val();
		$.ajax({
			type: 'post',
			url	: 'fetchStaffReportDetails.php?staffs_staffs_no=' + staffs_staffs_no,
			success:function(response){
				$("#update-section").html(response);
			}
		});
	});
</script>     