<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/functions.php");

	if(isset($_SESSION["user_web_id"]))
	{
		$sysu_disabled_flag='0';
		$sql = "INSERT into comment(user_id,post_id,cmessage,created_by,creation_timestamp) values(:user_id,:post_id,:cmessage,:created_by,NOW())";
		$stmt=$db->prepare($sql);
		$stmt->bindParam(":user_id",$_SESSION['user_web_id']);
		$stmt->bindParam(":Post_id",$_GET['id']);
		$stmt->bindParam(":cmessage",$_POST['comment-text']);
		$stmt->bindParam(":created_by",$_SESSION['user_web_id']);

		if($stmt->execute())
		{
			exit("true");
		}
		else
		{
			exit("false");
		}
		//$stmt->debugDumpParams();
		header("Location: /adapto/blog-single.php?id=".$data['id']);
		exit(0);
	}
?>