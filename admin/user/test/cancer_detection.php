<?php
	$title = "Breast Cancer Detection";
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php");

?>
<div class="container">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?=$lang['index-breast-cancer'];?></div>
					<div class="panel-body">
						<form action="/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/ml/test" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="test_pat_application_id" class="highlight">Patient ID</label>
										<input type="text" id="test_pat_application_id" name="test_pat_application_id" class="form-control"  autocomplete="off" required placeholder="Patient ID">
										<code></code>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-offset-4 col-md-4">
									<div class="image_preview_section">
										<div id="image_preview_border">
											<label id="image_placeholder_preview" for="image_button">upload image</label>
											<img id="image_preview" src="#">
										</div>
										<label for="image_button" class="btn btn-primary btn-block">upload image</label>
										<input type='file' id="image_button" name="image_preview" accept="image/jpg, image/png, image/jpeg">
									</div>
								</div>
							</div>
							<button type="submit" name="detect" id="detect" class="btn btn-primary btn-cancer" disabled>Detect</button>
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

<script type="text/javascript">
	function readURL(input) {
		if(input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#image_preview').attr('src', e.target.result);
				$('#image_preview').css('display', 'block');
				$('#image_placeholder_preview').html('');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#image_button").change(function() {
		readURL(this);
	});
	
	// $("#detect").click(function(){
		// var form = new FormData();
		// var file = $("#image_button")[0].files[0];
		// form.append('file',file);
		// form.append('pat_id',$("#test_pat_application_id").val());
		// $.ajax({
			// url:'mlProcess.php',
			// type:'POST',
			// data:form,
			// contentType:false,
			// processData:false,
			// success:function(response){
				// console.log(response);
			// }
		// });
	// });
	
	
	$("#test_pat_application_id").on("input",function(){
		if($("#test_pat_application_id").val().length > 0){
			$.ajax({
				url:'checkPatientID.php?id='+ $("#test_pat_application_id").val(),
				type:'GET',
				success:function(response){
					if(response == "true"){
						$("#detect").attr("disabled",false);
						$("#test_pat_application_id + code").html("");
						$("#test_pat_application_id + code").hide();
					}
					else{
						$("#detect").attr("disabled",true);
						$("#test_pat_application_id + code").html("Invalid patient ID.");
						$("#test_pat_application_id + code").show();
					}
				}
			});
		}
		else{
			$("#detect").attr("disabled",true);
			$("#test_pat_application_id + code").html("");	
			$("#test_pat_application_id + code").hide();		
		}	
	});
	$("#test_pat_application_id + code").hide();
</script>