<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].'/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php');
	
	if(isset($_GET["id"])){
		if(fetchData(array("table" => "staffs","condition" => "WHERE staffs_staffs_no='".$_GET["id"]."'")))
		{
			exit("true");
		}
	}
	exit("false");
?>