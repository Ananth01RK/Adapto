<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	
	if(isset($_GET["sysu_id"]) && in_array("admin",$_SESSION["sysu_role"]))
	{
		$sysu_disabled_flag='1';
		$sql = "UPDATE system_users SET sysu_disabled_flag=:sysu_disabled_flag WHERE sysu_id=:sysu_id";
		$stmt=$db->prepare($sql);
		$stmt->bindParam(":sysu_id",$_GET['sysu_id']);
		$stmt->bindParam(":sysu_disabled_flag",$sysu_disabled_flag);
		if($stmt->execute())
		{
			$_SESSION["success_message"][] = "Account Disabled";
		}
		else
		{
			$_SESSION["error_message"][] = "Failed to disable.";
		}
		$stmt->debugDumpParams();
		header("Location: /adapto/admin/user/lab_staff/list_lab_staff");
		exit(0);
	}
?>