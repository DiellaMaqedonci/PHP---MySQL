<?php 
	/* 
	We will include config.php for connection with database.
	Delete a movie based on his id.
	*/
	session_start();

	include_once('config.php');

	//Only logged in admins can delete movies
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
		$sql = "DELETE FROM movies WHERE id=:id";
		$prep = $conn->prepare($sql);
		$prep->bindParam(':id',$id, PDO::PARAM_INT);

		try {
			$prep->execute();
		} catch (PDOException $e) {
			//23000 = the movie is still referenced by other rows (for example bookings)
			if ($e->getCode() == 23000) {
				die("This movie cannot be deleted because it has bookings. <a href='list_movies.php'>Go back</a>");
			}
			error_log($e->getMessage());
			die("Delete failed. Please try again.");
		}
	}

	header("Location: list_movies.php");
	exit;