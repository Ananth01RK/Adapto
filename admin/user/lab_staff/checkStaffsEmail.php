<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].'/adapto/admin/includes/db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/adapto/admin/includes/functions.php');
	
	if(isset($_GET["email"]))
	{
		if(fetchData(array("table" => "staffs","condition" => "WHERE staffs_email_address='".$_GET["email"]."'")))
		{
			exit("true");
		}
	}
	exit("false");
?>