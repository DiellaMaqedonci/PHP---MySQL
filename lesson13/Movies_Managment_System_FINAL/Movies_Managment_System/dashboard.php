<?php 
/*Creating a session  based on a session identifier, passed via a GET or POST request.
  We will include config.php for connection with database.
  We will fetch all datas from users in database and show them.
  If a user is admin, he can update or delete a user data.
  */
	session_start();

	include_once('config.php');

	if (empty($_SESSION['username'])) {
		header("Location: login.php");
		exit;
	}

	$is_admin = !empty($_SESSION['is_admin']);

	//Only admins see the users table, so only query it for admins (and only the needed columns)
	$users_data = [];
	if ($is_admin) {
		$sql = "SELECT id, emri, username, email FROM users";
		$selectUsers = $conn->prepare($sql);
		$selectUsers->execute();

		$users_data = $selectUsers->fetchAll();
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Hugo 0.88.1">
	<meta name="theme-color" content="#7952b3">
</head>
<body>


<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Welcome to dashboard " . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-50" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="logout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <?php if ($is_admin) { ?>
            <li class="nav-item">
              <a class="nav-link" href="home.php">
                <span data-feather="file"></span>
                Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dashboard.php">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="list_movies.php">
                <span data-feather="file"></span>
                Movies
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="bookings.php">
                <span></span>
                Bookings
              </a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="home.php">
                Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="bookings.php">
                <span></span>
                Bookings
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        
      </div>

    <?php if ($is_admin) { ?>

      <h2>Users</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Emri</th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Update</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users_data as $user_data) { ?>

              <tr>
                <td><?= htmlspecialchars($user_data['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($user_data['emri'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($user_data['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?= htmlspecialchars($user_data['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                <!-- If we want to update a user we need to link into editUsers.php -->
                <td><a href="editUsers.php?id=<?= (int)$user_data['id']; ?>">Update</a></td>
                <!-- If we want to delete a user we need to link into deleteUsers.php -->
                <td><a href="deleteUsers.php?id=<?= (int)$user_data['id']; ?>">Delete</a></td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
      </div>
    <?php } ?>
    </main>
  </div>
</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
	<script src="dashboard.js"></script>
</body>
</html>