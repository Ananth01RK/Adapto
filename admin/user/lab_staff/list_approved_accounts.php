<?php
	$title = "List Approved Lab Staffs";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
?>
<div class="container" >
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
	</div>
	<div class="container">
        <div class="row">
            <div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">List of Approved Accounts <i class="fa fa-smile-o" aria-hidden="true"></i>
</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered js-basic-example dataTable myTable">
								<thead class="thead-dark">
									<tr>
										<th>Sr.No.</th>
										<th>Username</th>
										<th>Firstname</th>
										<th>Email Address</th>
										<th>Contact No.</th>
										<th>View</th>
									</tr>
								</thead>
								<tbody>
									<?php if($datas = fetchData(array("table" =>"staffs","condition" =>"WHERE staff_status='1'"))):?>
										<?php $count = 1; foreach($datas as $data): ?>
										<?php if($sys_users = fetchData(array("table" =>"system_users","condition" =>"WHERE sysu_id=".$data['sysu_id']))){ $sys_user =$sys_users[0]; if($sys_user["sysu_role"] =='admin'){continue;} } 
										?>
										<tr>
											<th><?php echo $count; ?></th>
											<td>
												<?php echo $sys_user['sysu_username']; ?>
											</td>
											<td><?php echo $data["fname"]; ?></td>
											<td><?php echo $data["email"]; ?></td>
											<td><?php echo $data["phoneno"]; ?></td>
											<td>
												<a href="/adapto/admin/user/system users/view_profile.php?id=<?php echo $data["id"]; ?>" class="btn btn-primary btn-width"><i class="fa fa-eye"></i></a>
											</td>
										</tr>
										<?php $count = $count + 1; endforeach; ?>
									<?php endif; ?>
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
?>