<?php 
//We will destroy all of the data associated with the current session
	session_start();

	//Clear all session variables
	$_SESSION = [];

	//Delete the session cookie as well, so the old session id can't be reused
	if (ini_get('session.use_cookies')) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
	}

	session_destroy();

	header("Location: login.php");
	exit;