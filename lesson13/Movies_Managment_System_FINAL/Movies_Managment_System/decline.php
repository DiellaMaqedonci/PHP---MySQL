<?php 
	/* 
	 We will include config.php for connection with database.
	 We will get the booking id and update the database based on that booking id
	*/
	session_start();

	include_once('config.php');

	//Only logged in admins can decline bookings
	if (empty($_SESSION['username'])) {
		header("Location: login.php");
		exit;
	}
	if (empty($_SESSION['is_admin'])) {
		header("Location: dashboard.php");
		exit;
	}

	$id = (int)($_GET['id'] ?? 0);

	if ($id > 0) {
		$sql = "UPDATE `bookings` SET `is_approved` = 'false' WHERE id=:id";
		$prep = $conn->prepare($sql);
		$prep->bindParam(':id',$id, PDO::PARAM_INT);
		$prep->execute();
	}

	header("Location: list_movies.php");
	exit;