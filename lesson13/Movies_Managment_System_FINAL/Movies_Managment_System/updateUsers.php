<?php 
/*
We will get the changed data from editUsers.php file and update them into database
*/
	session_start();

	include_once('config.php');

	//Only logged in admins can update users
	if (empty($_SESSION['username'])) {
		header("Location: login.php");
		exit;
	}
	if (empty($_SESSION['is_admin'])) {
		header("Location: dashboard.php");
		exit;
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$id = (int)($_POST['id'] ?? 0);
		$emri = trim($_POST['emri'] ?? '');
		$username = trim($_POST['username'] ?? '');
		$email = trim($_POST['email'] ?? '');

		if ($id <= 0 || $emri === '' || $username === '' || $email === '') {
			die("You have not filled in all the fields. <a href='editUsers.php?id=" . $id . "'>Go back</a>");
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			die("Please enter a valid email address. <a href='editUsers.php?id=" . $id . "'>Go back</a>");
		}

		//The id is only used in WHERE; changing a primary key in SET makes no sense
		$sql = "UPDATE users SET emri=:emri, username=:username, email=:email WHERE id=:id";

		$prep = $conn->prepare($sql);
		$prep->bindParam(':id',$id, PDO::PARAM_INT);
		$prep->bindParam(':emri',$emri);
		$prep->bindParam(':username',$username);
		$prep->bindParam(':email',$email);

		try {
			$prep->execute();
		} catch (PDOException $e) {
			//23000 = duplicate key: another user already has this username or email
			if ($e->getCode() == 23000) {
				die("Username or email is already in use. <a href='editUsers.php?id=" . $id . "'>Go back</a>");
			}
			error_log($e->getMessage());
			die("Update failed. Please try again.");
		}
	}

	header("Location: dashboard.php");
	exit;