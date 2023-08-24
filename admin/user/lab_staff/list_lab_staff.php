<?php
	$title = "List Lab Staff";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
?>
<style>
</style>
<div class="container">
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
	</div>
	<div class="container">
        <div class="row">
            <div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?=$lang['index-lab-staff'];?></div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered js-basic-example dataTable myTable">
								<thead class="thead-dark">
									<tr>
										<th>Sr.No.</th>
										<th>Title</th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Last Name</th>
										<th>Mobile No.</th>
										<th>Email Address</th>
										<th>Enable/Disable</th>
										<th>View</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php $sql ="SELECT sysu_id,sysu_role,staffs_id,staffs_sys_id,staffs_title,staffs_firstname,staffs_middlename,staffs_lastname,staffs_mobile_number,staffs_email_address,sysu_disabled_flag FROM system_users system_users LEFT JOIN staffs staffs on system_users.sysu_id = staffs.staffs_sys_id WHERE system_users.sysu_role = 'lab staff' && staffs_status='1' && system_users.sysu_retired_flag='0' ORDER BY staffs.staffs_id ASC";
											$result_set = $db->query($sql); 
											if($result_set->rowCount()){
												$datas = $result_set->fetchAll(PDO::FETCH_ASSOC); 
												$count = 1; foreach($datas as $data):
									 ?>
										<tr>
											<th><?php echo $count; ?></th>
											<td><?php echo $data["staffs_title"]; ?></td>
											<td><?php echo $data["staffs_firstname"]; ?></td>
											<td><?php echo $data["staffs_middlename"]; ?></td>
											<td><?php echo $data["staffs_lastname"]; ?></td>
											<td><?php echo $data["staffs_mobile_number"]; ?></td>
											<td><?php echo $data["staffs_email_address"]; ?></td>
											<td>
											<?php if($data["sysu_disabled_flag"] == '1'): ?>
												<a href="/adapto/admin/user/lab_staff/enable_process?sysu_id=<?php echo $data["sysu_id"]; ?>" class="btn btn-danger btn-width" id="unlock">
													<i class="fa fa-lock"></i>
												</a>
											<?php else: ?>
												<a href="/adapto/admin/user/lab_staff/disable_process?sysu_id=<?php echo $data["sysu_id"]; ?>" class="btn btn-success btn-width" id="unlock">
													<i class="fa fa-unlock"></i>
												</a>
											<?php endif; ?>
											</td>
											<td>
												<a href="/adapto/admin/user/system users/view_profile?id=<?php echo $data["staffs_id"]; ?>" class="btn btn-info btn-width"><i class="fa fa-eye"></i></a>
											</td>
											<td>
												<button type="button" class="btn btn-danger btn-width" data-toggle="modal" data-target="#deleteModal" onclick="getRow(<?php echo $data["staffs_id"]; ?>, '<?php echo sha1('staffs'); ?>', '<?php echo $_SERVER['PHP_SELF']; ?>')"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									<?php $count = $count + 1; endforeach;} ?>
								</tbody>
							</table>
						</div>					
					</div>					
				</div>
			</div>
        </div>
    </div>
</div>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/footer.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_delete_modal.php");
?>
<script>
$('#unlock').click(function(){
    $(this).find('i').toggleClass('fa-unlock fa-lock')
});
</script>