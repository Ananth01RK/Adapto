<?php

function generateVerificationCode()
{
	return md5(uniqid(rand(), true));
}

function fetchData($parameters)
{
	global $db;
	$tables = array(
		"system_users",
		"staffs",
		"user",
		"dog_details",
		"dog_breed",
		"dog_food",
		"post",
		"comment",
		"partner",
		"doctor",
		"testimonials",
		"contact",
		"subscriber"
	);

	$table = isset($parameters['table']) ? $parameters['table'] : "";
	$condition = isset($parameters['condition']) ? $parameters['condition'] : "";
	$column_name = (isset($parameters['column_name']) && strlen(trim($parameters["column_name"]))) ? trim($parameters['column_name'], ", ") : "*";

	if(!empty($table) && in_array($table, $tables))
	{
		$sql = "SELECT $column_name FROM $table $condition";
		
		$result_set = $db->query($sql);
		if($result_set->rowCount())
		{
			return $result_set->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

function deleteRow($column_name='', $rowId='', $table='')
{
	$allowedTables = array(
		"system_users",
		"staffs",
		"user",
		"dog_details",
		"dog_breed",
		"dog_food",
		"post",
		"comment",
		"partner",
		"doctor",
		"testimonials",
		"contact",
		"subscriber"
	);

	if(!empty($rowId) && is_numeric($rowId) && !empty($table) && in_array($table, $allowedTables))
	{	
		global $db;
		
		$sql = "DELETE FROM $table WHERE $column_name=:id LIMIT 1";
		// echo $sql;
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $rowId, PDO::PARAM_INT);

		if($stmt->execute())
		{
			if($stmt->rowCount() == 1)
			{
				return true;
			}
			else
			{
				return $stmt->ErrorInfo();
			}

		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

function getFilePath($tableName='', $fileColumnName='', $idColumnName='', $idColumnValue='')
{
	global $db;
	$sql = "SELECT $fileColumnName FROM $tableName WHERE $idColumnName=$idColumnValue LIMIT 1";
	$result = $db->query($sql);
	if($result->rowCount()) {
		$url = $result->fetchObject();
		$result->closeCursor();
		if($url->$fileColumnName != null && trim($url->$fileColumnName) != "") {
			return $url->$fileColumnName;
		} 
		else {
			return "";
		}
	}
	else {
		return "";
	}
}
function personalDetailsStatus($id){
	global $db;
	$sql = "SELECT staff_status FROM staffs WHERE sysu_id=$id";
	$result = $db->query($sql);
	if($result->rowCount()) {
		$url = $result->fetchObject();
		$result->closeCursor();
		if($url->staff_status != null && trim($url->staff_status) == '1') {
			return true;
		}
	}
	return false;
}
function getAge($year, $month, $day){
	$date = "$year-$month-$day";
	if($date){
		$dob = new DateTime($date);
		$now = new DateTime();
		return $now->diff($dob)->y;
	}
	$difference = time() - strtotime($date);
	//1 year = 365.2425 days = (365.2425 days) × (24 hours/day) × (3600 seconds/hour) = 31556952 seconds.
	return floor($difference / 31556926);
}

?>