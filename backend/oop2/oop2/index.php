<?php
$answer = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);

    $answer = "Welcome, $name! Your email ($email) has been registered successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body
    class="d-flex justify-content-center align-items-center"
    style="min-height:100vh; background:linear-gradient(135deg,#4f46e5,#06b6d4);">

    <div class="card shadow-lg border-0 p-4" style="width:450px;">
        <div class="card-body">

            <h2 class="text-center text-primary fw-bold mb-4">
                User Registration
            </h2>

            <form method="POST">

                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        placeholder="Full Name"
                        required>
                    <label for="name">Full Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="Email Address"
                        required>
                    <label for="email">Email Address</label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Password"
                        required>
                    <label for="password">Password</label>
                </div>

                <div class="form-floating mb-4">
                    <input
                        type="password"
                        class="form-control"
                        id="confirmPassword"
                        name="confirm_password"
                        placeholder="Confirm Password"
                        required>
                    <label for="confirmPassword">Confirm Password</label>
                </div>

                <button
                    type="submit"
                    class="btn btn-success w-100 fw-bold">
                    Register Account
                </button>

            </form>

            <?php if (!empty($answer)): ?>
                <div class="alert alert-success mt-4">
                    <?php echo $answer; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>