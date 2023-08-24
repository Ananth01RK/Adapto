<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="color:#000;">Delete Confirmation</h4>
			</div>
			<div class="modal-body">
				<p style="color:#000;">Are you sure you want to delete?</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-danger" id="deleteLink">Confirm</a>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
			</div>
		</div>      
    </div>
</div>
<script>
	function getRow(id, table, calling_script)
	{
		$("#deleteLink").attr("href", "/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/delete_row.php?id=" + id + "&from=" + table + "&calling_script=" + calling_script);
	}
</script>