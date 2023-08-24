<?php
	$title = "Income Report";
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
					<div class="panel-heading"><?=$lang['index-payment-report'];?></div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
										<div class="row">
											<div class="col-offset-md-12 col-md-6">
												<div class="form-group">
													<label for="year" class="highlight">Year</label>
													<select name="year" id="year"class="form-control" required>
														<option value="">Select year</option>
														<option value="2021" >2021</option>
														<option value="2020" >2020</option>
														<option value="2019" >2019</option>
														<option value="2018" >2018</option>
														<option value="2017" >2017</option>
														<option value="2016" >2016</option>
														<option value="2015" >2015</option>
														<option value="2014" >2014</option>
														<option value="2013" >2013</option>
														<option value="2012" >2012</option>
														<option value="2011" >2011</option>
														<option value="2010" >2010</option>
														<option value="2009" >2009</option>
														<option value="2008" >2008</option>
														<option value="2007" >2007</option>
														<option value="2006" >2006</option>
														<option value="2005" >2005</option>
														<option value="2004" >2004</option>
														<option value="2003" >2003</option>
														<option value="2002" >2002</option>							
														<option value="2001" >2001</option>
														<option value="2000" >2000</option>
													</select>
												</div>
											</div>
											<div class="col-offset-md-12 col-md-6">
												<div class="form-group">
													<label for="month" class="highlight">Month</label>
													<select name="month" id="month"class="form-control" required>
														<option value="">Select Month</option>
														<option value="01" >January</option>
														<option value="02" >February</option>
														<option value="03" >March</option>
														<option value="04" >April</option>
														<option value="05" >May</option>
														<option value="06" >June</option>
														<option value="07" >July</option>
														<option value="08" >August</option>
														<option value="09" >September</option>
														<option value="10" >October</option>
														<option value="11" >November</option>
														<option value="12" >December</option>
													</select>
												</div>
											</div>
											<!--div class="col-offset-md-12 col-md-4">
												<div class="form-group">
													<label for="year" class="highlight">Date</label>
													<select name="year" id="year"class="form-control" required>
														<option value="">Select Date</option>
														<option value="01" >01</option>
														<option value="02" >02</option>
														<option value="03" >03</option>
														<option value="04" >04</option>
														<option value="05" >05</option>
														<option value="06" >06</option>
														<option value="07" >07</option>
														<option value="08" >08</option>
														<option value="09" >09</option>
														<option value="10" >10</option>
														<option value="11" >11</option>
														<option value="12" >12</option>
														<option value="13" >13</option>
														<option value="14" >14</option>
														<option value="15" >15</option>
														<option value="16" >16</option>
														<option value="17" >17</option>
														<option value="18" >18</option>
														<option value="19" >19</option>
														<option value="21" >21</option>
														<option value="22" >22</option>
														<option value="23" >23</option>
														<option value="24" >24</option>
														<option value="25" >25</option>
														<option value="26" >26</option>
														<option value="27" >27</option>
														<option value="28" >28</option>
														<option value="29" >29</option>
														<option value="30" >30</option>
														<option value="31" >31</option>
													</select>
												</div>
											</div>
											    <div class="form-group">
									                <div class='input-group date' id='datepicker'>
									                    <input type='text' class="form-control" />
									                    <span class="input-group-addon">
									                        <span class="glyphicon glyphicon-calendar"></span>
									                    </span>
									                </div>
									            </div-->										   
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script >
	    $(function () {
	        $('#datepicker').datepicker({
	            format: "dd-mm-yyyy",
	            autoclose: true,
	            todayHighlight: true,
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        autoclose: true,
		        changeMonth: true,
		        changeYear: true,
		        orientation: "button"
	        });
	    });
	</script>