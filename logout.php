<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	$_SESSION = array();
	session_destroy();
	header("Location: /adapto/index.php");
	exit(0);
?>