<?php
 /*
  We will include config.php for connection with database.
  We will get datas from index.php file, and inster them into database when Sign up button is clicked in index.php file.
  If any of session is empty we will get a message
  */

	session_start();

	include_once('config.php');

	//Store an error message (and the typed values, never the passwords) and go back to the form
	function register_fail($message, $old)
	{
		$_SESSION['register_error'] = $message;
		$_SESSION['register_old'] = $old;
		header("Location: index.php");
		exit;
	}

	//Only accept form submissions
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		header("Location: index.php");
		exit;
	}

	$emri = trim($_POST['emri'] ?? '');
	$username = trim($_POST['username'] ?? '');
	$email = trim($_POST['email'] ?? '');

	//Passwords are validated and compared as plain text; only the final one is hashed
	$tempPass = $_POST['password'] ?? '';
	$tempConfirm = $_POST['confirm_password'] ?? '';

	$old = ['emri' => $emri, 'username' => $username, 'email' => $email];

	if ($emri === '' || $username === '' || $email === '' || $tempPass === '' || $tempConfirm === '')
	{
		register_fail("You have not filled in all the fields.", $old);
	}

	if (mb_strlen($emri) > 100 || mb_strlen($username) > 50 || mb_strlen($email) > 255)
	{
		register_fail("One of the fields is too long.", $old);
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		register_fail("Please enter a valid email address.", $old);
	}

	if (strlen($tempPass) < 8)
	{
		register_fail("Password must be at least 8 characters.", $old);
	}

	//bcrypt only uses the first 72 bytes of a password
	if (strlen($tempPass) > 72)
	{
		register_fail("Password must be at most 72 characters.", $old);
	}

	if ($tempPass !== $tempConfirm)
	{
		register_fail("Passwords do not match.", $old);
	}

	$password = password_hash($tempPass, PASSWORD_DEFAULT);

	//Check if the username or email is already taken
	$checkSql = "SELECT id FROM users WHERE username = :username OR email = :email";
	$check = $conn->prepare($checkSql);
	$check->bindParam(':username', $username);
	$check->bindParam(':email', $email);
	$check->execute();

	if ($check->fetch())
	{
		register_fail("Username or email is already in use.", $old);
	}

	//is_admin is NOT set here: new users get the column's default, which must be the non-admin value
	$sql = "INSERT INTO users(emri,username,email,password) VALUES (:emri, :username, :email, :password)";

	$insertSql = $conn->prepare($sql);

	$insertSql->bindParam(':emri', $emri);
	$insertSql->bindParam(':username', $username);
	$insertSql->bindParam(':email', $email);
	$insertSql->bindParam(':password', $password);

	try {
		$insertSql->execute();
	} catch (PDOException $e) {
		//23000 = duplicate key (two people registering the same username/email at the same time)
		if ($e->getCode() == 23000) {
			register_fail("Username or email is already in use.", $old);
		}
		error_log($e->getMessage());
		register_fail("Registration failed. Please try again.", $old);
	}

	//The user is not logged in yet, so send them to the login page (dashboard.php would just bounce them there)
	header("Location: login.php");
	exit;