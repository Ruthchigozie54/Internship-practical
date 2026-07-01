<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Redirection with parameter signaling success
        header("Location: login.php?registered=true");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Notes App</title>
    <link rel="stylesheet" href="/bootstrap/bootstrap.css">
    
    <style>
      
        body {
            background: linear-gradient(135deg, #2a2a2a 0%, #1a1a1a 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .auth-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .btn-apple {
            background-color: #0071e3;
            color: white;
        }
        .btn-apple:hover {
            background-color: #0077ed;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card auth-card p-4">
                <div class="text-center mb-4">
                    <span style="font-size: 3rem;">📝</span>
                    <h3 class="fw-bold mt-2 text-dark">Create Account</h3>
                    <p class="text-muted small">Get started with your digital notepad</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 small" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form action="register.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold text-secondary">Full Name</label>
                        <input type="text" class="form-control form-control-lg fs-6" id="name" name="name" required placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold text-secondary">Email address</label>
                        <input type="email" class="form-control form-control-lg fs-6" id="email" name="email" required placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                        <input type="password" class="form-control form-control-lg fs-6" id="password" name="password" required placeholder="••••••••">
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label small fw-semibold text-secondary">Confirm Password</label>
                        <input type="password" class="form-control form-control-lg fs-6" id="confirm_password" name="confirm_password" required placeholder="••••••••">
                    </div>
                    <button type="submit" class="btn btn-apple w-100 btn-lg fs-6 fw-medium py-2">Register</button>
                </form>

                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">Already have an account? <a href="login.php" class="text-decoration-none fw-semibold text-primary">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>