<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstraps</title>
    <!---<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">-->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            padding: 40px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2);
        }

        .logo {
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            background: #eef0ff;
            color: #667eea;
            border-radius: 18px;
            font-size: 30px;
        }

        .form-control {
            height: 50px;
            border-radius: 10px;
            padding-left: 15px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102,126,234,.15);
        }

        .btn-login {
            height: 50px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-weight: 600;
            transition: .3s;
        }

        .btn-login:hover {
            color: white;
            opacity: .9;
            transform: translateY(-2px);
        }

        .social-btn {
            height: 45px;
            border-radius: 10px;
            font-weight: 500;
        }

        a {
            color: #667eea;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #999;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e5e5e5;
        }
    </style>

</head>
<body>

    <div class="login-card">

        <!-- Logo -->
        <div class="logo">
            <i class="bi bi-shield-lock-fill"></i>
        </div>

        <!-- Heading -->
        <div class="text-center mb-4">
            <h3 class="fw-bold">Welcome Back!</h3>
            <p class="text-muted">Please login to your account</p>
        </div>

        <!-- Login Form -->
        <form action="add.php" method="POST">

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Email Address</label>
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    placeholder="name@example.com"
                    autocomplete="email"
                    required
                >
            </div>

            <!-- Password -->
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label class="form-label fw-semibold">Password</label>
                    <a href="#" class="small">Forgot password?</a>
                </div>

                <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <!-- Remember Me -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="remember"
                    >
                    <label class="form-check-label text-muted" for="remember">
                        Remember me
                    </label>
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit" name="submit" class="btn btn-login w-100" action="dashboard.php">
                Sign In <i class="bi bi-arrow-right ms-2"></i>
            </button>

        </form>

        <!-- Divider -->
        <div class="divider my-4">
            OR CONTINUE WITH
        </div>

        <!-- Social Login -->
        <div class="row g-2">
            <div class="col-6">
                <button class="btn btn-outline-secondary social-btn w-100" type="button">
                    <i class="bi bi-google me-2"></i> Google
                </button>
            </div>

            <div class="col-6">
                <button class="btn btn-outline-secondary social-btn w-100" type="button">
                    <i class="bi bi-facebook me-2"></i> Facebook
                </button>
            </div>
        </div>

        <!-- Register -->
        <div class="text-center mt-4">
            <span class="text-muted">Don't have an account?</span>
            <a href="register.html" class="fw-semibold">Sign Up</a>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>-->
</body>
</html>