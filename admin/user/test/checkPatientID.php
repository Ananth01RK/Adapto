<?php
	require_once($_SERVER["DOCUMENT_ROOT"].'/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php');
	
	if(isset($_GET["id"]))
	{
		if(fetchData(array("table" => "patient","condition" => "WHERE pat_application_id ='".$_GET["id"]."'")))
		{
			exit("true");
		}
	}
	echo "false";
?>