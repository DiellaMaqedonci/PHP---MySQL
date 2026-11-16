<?php
//Initialization of some variables for maintaining database data
$user = "root";
$pass = "";
$server = "localhost";
$dbname = "movies";

try {
	//Creating a PDO to connect with database
	$conn = new PDO(
		"mysql:host=$server;dbname=$dbname;charset=utf8mb4",
		$user,
		$pass,
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		]
	);
} catch (PDOException $e) {
	//Log the real error, show a generic message to the user
	error_log($e->getMessage());
	die("Database connection failed.");
}