<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");
	
	if(isset($_GET["sysu_id"]) && in_array("admin",$_SESSION["sysu_role"]))
	{
		$sysu_retired_flag='1';
		$sql = "UPDATE system_users SET sysu_retired_flag=:sysu_retired_flag WHERE sysu_id=:sysu_id";
		$stmt=$db->prepare($sql);
		$stmt->bindParam(":sysu_id",$_GET['sysu_id']);
		$stmt->bindParam(":sysu_retired_flag",$sysu_retired_flag);
		if($stmt->execute())
		{
			$_SESSION["success_message"][] = "Retired";
		}
		else
		{
			$_SESSION["error_message"][] = "Failed to retire.";
		}
		header("Location: /adapto/admin/user/system users/list_system_users.php");
		exit(0);
	}
?>