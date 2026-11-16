<?php 
	/*
	We will include config.php for connection with database.
	Delete a user based on his id.
	*/
	session_start();

	include_once('config.php');

	//Only logged in admins can delete users
	if (empty($_SESSION['username'])) {
		header("Location: login.php");
		exit;
	}
	if (empty($_SESSION['is_admin'])) {
		header("Location: dashboard.php");
		exit;
	}

	$id = (int)($_GET['id'] ?? 0);

	//An admin must not delete his own account (he would be locked out)
	if ($id === (int)($_SESSION['id'] ?? 0)) {
		die("You cannot delete your own account. <a href='dashboard.php'>Go back</a>");
	}

	if ($id > 0) {
		$sql = "DELETE FROM users WHERE id=:id";
		$prep = $conn->prepare($sql);
		$prep->bindParam(':id',$id, PDO::PARAM_INT);

		try {
			$prep->execute();
		} catch (PDOException $e) {
			//23000 = the user is still referenced by other rows (for example bookings)
			if ($e->getCode() == 23000) {
				die("This user cannot be deleted because other records depend on it. <a href='dashboard.php'>Go back</a>");
			}
			error_log($e->getMessage());
			die("Delete failed. Please try again.");
		}
	}

	header("Location: dashboard.php");
	exit;