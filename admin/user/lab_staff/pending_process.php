<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	
	if(isset($_GET["id"]) && in_array("admin",$_SESSION["sysu_role"]))
	{
		$staff_status='1';
		$sql = "UPDATE staffs SET staff_status=:staff_status WHERE id=:id";
		$stmt=$db->prepare($sql);
		$stmt->bindParam(":id",$_GET['id']);
		$stmt->bindParam(":staff_status",$staff_status);
		if($stmt->execute())
		{
			$_SESSION["success_message"][] = "Approved";
		}
		else
		{
			$_SESSION["error_message"][] = "Failed to approve.";
		}
		// $stmt->debugDumpParams();
		header("Location: /adapto/admin/user/lab_staff/list_pending_accounts.php");
		exit(0);
	}
?>