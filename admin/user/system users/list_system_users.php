<?php
	$title = "List Staff Accounts";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
?>
<div class="container" >
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
	</div>
	<div class="container col-md-12">
        <div class="row">
            <div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">List System Users</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered js-basic-example dataTable myTable">
								<thead class="thead-dark">
									<tr>
										<th>Sr.No.</th>
										<th>Username</th>
										<th>Last Login</th>
										<th>Retired</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php if($datas = fetchData(array("table" =>"system_users","condition" =>"WHERE sysu_retired_flag!='1' AND sysu_role!='admin'"))):  
												$count = 1; foreach($datas as $data):
									 ?>
										<tr>
											<th><?php echo $count; ?></th>
											<td><?php echo $data["sysu_username"]; ?></td>
											<td><?php echo date("d-m-Y h:i:s A",strtotime($data["sysu_last_login_timestamp"])); ?></td>
											<td>
												<a href="/adapto/admin/user/system users/retire_proocess.php?sysu_id=<?php echo $data["sysu_id"]; ?>" class="btn btn-success btn-width">
													<i class="fa fa-check"></i>
												</a>
											</td>
											<td>
												<button type="button" class="btn btn-danger btn-width" data-toggle="modal" data-target="#deleteModal" onclick="getRow(<?php echo $data["sysu_id"]; ?>, '<?php echo sha1('system_users'); ?>', '<?php echo $_SERVER['PHP_SELF']; ?>')"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									<?php $count = $count + 1; endforeach;  ?>
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
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_delete_modal.php");
?>