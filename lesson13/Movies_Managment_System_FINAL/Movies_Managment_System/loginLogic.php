<?php 
	/*Creating a session  based on a session identifier, passed via a GET or POST request.
  We will include config.php for connection with database.
  We will get the datas from login.php file and check if any of those datas is incorrect or doesn't exist
   when Sign in button is clicked in login.php file
  */
	session_start();

	include_once('config.php');

	//Only accept form submissions; anything else goes back to the login page
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		header('Location: login.php');
		exit;
	}

	//We will collect username from form data after submitting an HTML form with method="post".
	$username = trim($_POST['username'] ?? '');

	//We will collect password from form data after submitting an HTML form with method="post".
	$password = $_POST['password'] ?? '';

	//Check if any of username and password variables is empty
	if ($username === '' || $password === '') {

		//If true, store this message and go back to login.php where it is displayed
		$_SESSION['login_error'] = "Please fill in all fields.";
		header('Location: login.php');
		exit;
	}

	//If false, we will create a query to select id,emri,username,email,password,is_admin from users table based on each username
	$sql = "SELECT id, emri, username, email, password, is_admin FROM users WHERE username=:username";

	//We use prepared statement as a feature used to execute the same sql statement repeatedly with high efficiency
	$selectUser = $conn->prepare($sql);

	//bindParam binds a parameter to the specified variable name, so we bind :username to $username variable
	$selectUser->bindParam(":username", $username);

	/* At a later time, the application binds the values to the parameters, and the database executes the statement.
	 The application may execute the statement as many times as it wants with different values */
	$selectUser->execute();

	/*The fetch() method allows you to fetch a row from a result set associated with a PDOStatement object. Internally,
	 the fetch() method fetches a single row from a result set and moves the internal pointer to the next row in the result set.*/
	$data = $selectUser->fetch(PDO::FETCH_ASSOC);

	//Check that the user exists AND the password matches (one generic message for both, so usernames can't be guessed)
	if ($data && password_verify($password, $data['password'])) {

		//Prevent session fixation
		session_regenerate_id(true);

		//Store $data values to $_SESSION variables
		$_SESSION['id'] = $data['id'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['email'] = $data['email'];
		$_SESSION['emri'] = $data['emri'];

		//Store a real boolean, works whether the column holds 'true'/'false' or 1/0
		$_SESSION['is_admin'] = ($data['is_admin'] === 'true' || $data['is_admin'] == 1);

		//And head to dashboard.php
		header('Location: dashboard.php');
		exit;
	}

	$_SESSION['login_error'] = "Invalid username or password.";
	header('Location: login.php');
	exit;