<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/db.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/includes/functions.php');
	
	if(isset($_GET['id']) && is_numeric($_GET['id']) && $_SESSION['sysu_role'][0] == 'admin')
	{
		$key = $_GET['from'];
		$callingScript = $_GET['calling_script'];
		$column_name = "";

		$allowedTables = array(
            sha1("system_users") => "system_users",
            sha1("staffs") => "staffs",
            sha1("user") => "user",
            sha1("testimonials") => "testimonials",
            sha1("post") => "post",
            sha1("partner") => "partner",
            sha1("dog_food") => "dog_food",
            sha1("dog_breed") => "dog_breed",
            sha1("doctor") => "doctor",
            sha1("comment") => "comment",
            sha1("dog_details") => "dog_details",
            sha1("contact") => "contact",
            sha1("subscriber") => "subscriber"
        );
		
		if(array_key_exists($key, $allowedTables))
		{	
			if($allowedTables[$key]  == "system_users")
            {
                $column_name = "sysu_id";
            }
			else if($allowedTables[$key]  == "staffs")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "user")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "testimonials")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "post")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "partner")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "dog_food")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "dog_breed")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "dog_details")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "doctor")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "comment")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "contact")
            {
                $column_name = "id";
            }
			else if($allowedTables[$key]  == "subscriber")
            {
                $column_name = "id";
            }
            
			if(deleteRow($column_name, $_GET['id'], $allowedTables[$key]))
			{
				$_SESSION["success_message"][] = "Deleted Successfully.";
			}
			else
			{
				$_SESSION["error_message"][] = "Failed to delete.";
			}
		}
		header("Location: $callingScript");
		exit(0);
	}
	else
	{
		header("Location: /Medical-Laboratory-Application-and-Breast-Cancer-Detection-using-Deep-Learning-Approach/user/dashboard.php");
		exit(0);
	}
 ?>