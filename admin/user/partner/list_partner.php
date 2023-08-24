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
					<div class="panel-heading">List Partners</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered js-basic-example dataTable myTable">
								<thead class="thead-dark">
									<tr>
										<th>Sr.No.</th>
										<th>Name</th>
										<th>Address</th>
										<th>Image</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php if($datas = fetchData(array("table" =>"partner","condition" =>""))):  
												$count = 1; foreach($datas as $data):
									 ?>
										<tr>
											<th><?php echo $count; ?></th>
											<td><?php echo $data["pname"]; ?></td>
											<td><?php echo $data["paddress"]; ?></td>
											<td>
												<a href="<?php echo $data["pimage"]; ?>" class="btn btn-primary btn-width">
													<i class="fa fa-eye"></i>
												</a>
											</td>
											<td>
												<a href="/adapto/admin/user/partner/edit_partner.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-width">
													<i class="fa fa-pen"></i>
												</a>
											</td>
											<td>
												<button type="button" class="btn btn-danger btn-width" data-toggle="modal" data-target="#deleteModal" onclick="getRow(<?php echo $data['id']; ?>, '<?php echo sha1('system_users'); ?>', '<?php echo $_SERVER['PHP_SELF']; ?>')"><i class="fa fa-trash"></i></button>
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