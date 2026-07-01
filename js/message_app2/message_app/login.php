<?php
session_start();
require_once 'db.php'; // MySQLi database connection

// If the user is already logged in, skip this page and go straight to the notepad
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        try {
            // 1. Look up user by email using MySQLi Object-Oriented style
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            
            // 2. Fetch the data container payload
            $result = $stmt->get_result();
            $user = $result->fetch_assoc(); // Returns data array or false if user not found

            // 3. If user exists, check their password against the database hash
            if ($user && password_verify($password, $user['password'])) {
                // Log them in securely!
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id']; // Store real user ID for isolating notes
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                
                $stmt->close(); // Close active cursor resources
                header("Location: index.php");
                exit;
            } else {
                $error = "Invalid email or password.";
            }
            
            $stmt->close(); // Close statement if verification failed
        } catch (mysqli_sql_exception $e) {
            $error = "Authentication failed. Please try again.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Notes App</title>
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
                    <span style="font-size: 3rem;">📥</span>
                    <h3 class="fw-bold mt-2 text-dark">Sign In</h3>
                    <p class="text-muted small">Access your iCloud synchronized notes</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 small" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['registered'])): ?>
                    <div class="alert alert-success py-2 small" role="alert">
                        Registration successful! Please log in.
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold text-secondary">Email address</label>
                        <input type="email" class="form-control form-control-lg fs-6" id="email" name="email" required placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                        <input type="password" class="form-control form-control-lg fs-6" id="password" name="password" required placeholder="••••••••">
                    </div>
                    <div class="mb-3 form-check d-flex justify-content-between">
                        <div>
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label small text-muted" for="rememberMe">Remember me</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-apple w-100 btn-lg fs-6 fw-medium py-2">Sign In</button>
                </form>

                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">Don't have an account? <a href="register.php" class="text-decoration-none fw-semibold text-primary">Create one</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>