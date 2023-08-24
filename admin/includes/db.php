<?php
	if(session_status() == PHP_SESSION_NONE){

		session_start();
	}
	$dbhost = "localhost";
	$dbname = "adapto_db";
	$dbuser = "root";
	$dbpass = "";

	try {
		$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	}
	catch(Exception $error) {
		echo "Database Error";
		die();
	}
?>