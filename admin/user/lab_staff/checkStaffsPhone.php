<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].'/adapto/admin/includes/db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/adapto/admin/includes/functions.php');
	
	if(isset($_GET["phone"]))
	{
		if(fetchData(array("table" => "staffs","condition" => "WHERE staffs_mobile_number='".$_GET["phone"]."'")))
		{
			exit("true");
		}
	}
	exit("false");
?>