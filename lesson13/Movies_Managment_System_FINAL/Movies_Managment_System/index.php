<?php
session_start();

//Already logged in users don't need the registration page
if (!empty($_SESSION['username'])) {
	header('Location: dashboard.php');
	exit;
}

//Show (once) the error message and previously typed values set by register.php, if any
$error = $_SESSION['register_error'] ?? null;
$old = $_SESSION['register_old'] ?? [];
unset($_SESSION['register_error'], $_SESSION['register_old']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<style>

		html,
	body {
	  height: 100%;
	}

	body {
	  display: flex;
	  align-items: center;
	  padding-top: 40px;
	  padding-bottom: 40px;
	  background-color: #f5f5f5;
	}

	.form-signin {
	  width: 100%;
	  max-width: 330px;
	  padding: 15px;
	  margin: auto;
	}

	.form-signin .checkbox {
	  font-weight: 400;
	}

	.form-signin .form-floating:focus-within {
	  z-index: 2;
	}

	.form-floating{
		margin: 10px;
	}
	</style>
</head>
<body class="text-center">
<!-- Creating a form which will post us some data in register.php file -->
<main class="form-signin">
  <form action="register.php" method="post">
    <img class="mb-4" src="https://getbootstrap.com/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Register</h1>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <div class="form-floating">
      <input type="text" class="form-control" id="emri" placeholder="Emri" name="emri" value="<?= htmlspecialchars($old['emri'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
      <label for="emri">Emri</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" id="username" placeholder="Username" name="username" autocomplete="username" value="<?= htmlspecialchars($old['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
      <label for="username">Username</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" id="email" placeholder="Email" name="email" autocomplete="email" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
      <label for="email">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" autocomplete="new-password" minlength="8" required>
      <label for="password">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password" autocomplete="new-password" minlength="8" required>
      <label for="confirm_password">Confirm Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign up</button>
    <span>Already have an account: </span><a href="login.php">Sign in</a>
  </form>
</main>

</body>
</html>