<?php
	$title = "List Retired Staff Accounts";
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/header.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
?>
<div class="container">
	<div class="row">
		<?php require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/view_error_message.php"); ?>
	</div>
	<div class="container">
        <div class="row">
            <div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">List Retired System Users </div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered js-basic-example dataTable myTable" id="myTable">
								<thead class="thead-dark">
									<tr>
										<th>Sr.No.</th>
										<th>Username</th>
										<th>Last Login</th>
										<th>View</th>
									</tr>
								</thead>
								<tbody>
									<?php if($datas = fetchData(array("table" =>"system_users","condition" =>"WHERE sysu_retired_flag='1'"))): ?>
										<?php $count = 1; foreach($datas as $data): ?>
										<tr>
											<th><?php echo $count; ?></th>
											<td><?php echo $data["sysu_username"]; ?></td>
											<td><?php echo date("d-m-Y h:i:s A",strtotime($data["sysu_last_login_timestamp"])); ?></td>
											<td>
												<a href="/adapto/admin/user/system users/view_profile.php?id=<?php echo $data["sysu_id"]; ?>" class="btn btn-primary btn-width"><i class="fa fa-eye"></i></a>
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