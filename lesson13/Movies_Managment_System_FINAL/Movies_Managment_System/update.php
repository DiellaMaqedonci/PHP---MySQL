<?php 
/*
We will get the changed data from edit.php file and update them into database
*/
	session_start();

	include_once('config.php');

	//Only logged in admins can update movies
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
		$movie_name = trim($_POST['movie_name'] ?? '');
		$movie_desc = trim($_POST['movie_desc'] ?? '');
		$movie_quality = trim($_POST['movie_quality'] ?? '');
		$movie_rating = $_POST['movie_rating'] ?? '';

		if ($id <= 0 || $movie_name === '' || $movie_desc === '' || $movie_quality === '' || !is_numeric($movie_rating)) {
			die("Invalid data. Please go back and fill in all fields correctly.");
		}

		//The id is only used in WHERE; changing a primary key in SET makes no sense
		$sql = "UPDATE movies SET movie_name=:movie_name, movie_desc=:movie_desc, movie_quality=:movie_quality, movie_rating=:movie_rating WHERE id=:id";

		$prep = $conn->prepare($sql);
		$prep->bindParam(':id',$id, PDO::PARAM_INT);
		$prep->bindParam(':movie_name',$movie_name);
		$prep->bindParam(':movie_desc',$movie_desc);
		$prep->bindParam(':movie_quality',$movie_quality);
		$prep->bindParam(':movie_rating',$movie_rating);

		$prep->execute();
	}

	header("Location: dashboard.php");
	exit;