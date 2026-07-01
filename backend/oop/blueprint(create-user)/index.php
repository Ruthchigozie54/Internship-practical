<?php
// Start the session at the very beginning
session_start();

require_once 'Users.php';

// Retrieve and clear any flash messages
$message = "";
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Retrieve old form data if it exists (so we can repopulate the form)
$oldName = isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : "";
$oldPhone = isset($_SESSION['form_data']['phoneNumber']) ? $_SESSION['form_data']['phoneNumber'] : "";
$oldDob = isset($_SESSION['form_data']['dob']) ? $_SESSION['form_data']['dob'] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $phoneNumber = isset($_POST['phoneNumber']) ? trim($_POST['phoneNumber']) : "";
    $password = isset($_POST['password']) ? trim($_POST['password']) : "";
    $dob = isset($_POST['dob']) ? trim($_POST['dob']) : ""; // Capture DOB

    $user = new User();
    // Pass $dob into the save method
    $result = $user->save($name, $phoneNumber, $password, $dob);
    
    // Save the returned message string to the session
    $_SESSION['message'] = $result['message'];

    // Check the status we returned from the User class
    if ($result['status'] == 'error') {
        // Validation failed: Save safe inputs back to session
        $_SESSION['form_data'] = [
            'name' => $name,
            'phoneNumber' => $phoneNumber,
            'dob' => $dob
        ];
    } else {
        // Validation succeeded: Clear the form data so the fields reset
        unset($_SESSION['form_data']);
    }

    // PRG Pattern: Redirect to prevent form resubmission warnings
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        /* CSS Reset & Variables */
        :root {
            --primary-color: #964B00;
            --primary-hover: #783c00; 
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border-color: #d1d5db;
            --success-bg: #d1fae5;
            --success-text: #065f46;
            --error-bg: #fee2e2;
            --error-text: #991b1b;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .form-container {
            background-color: var(--card-bg);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 450px;
        }

        .form-header { margin-bottom: 24px; text-align: center; }
        .form-header h2 { font-size: 1.5rem; font-weight: 600; margin-bottom: 8px; }
        .form-header p { color: var(--text-muted); font-size: 0.875rem; }

        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 6px; }
        
        input {
            width: 100%;
            padding: 10px 12px;
            font-size: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            transition: all 0.2s ease;
            outline: none;
        }

        input::placeholder { color: #9ca3af; }
        input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(150, 75, 0, 0.2); 
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 10px;
        }

        button:hover { background-color: var(--primary-hover); }

        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
        }

        .alert-success { background-color: var(--success-bg); color: var(--success-text); border: 1px solid #a7f3d0; }
        .alert-error { background-color: var(--error-bg); color: var(--error-text); border: 1px solid #fecaca; }
    </style>
</head>
<body>

    <div class="form-container">
        <div class="form-header">
            <h2>Create an Account</h2>
            <p>Please fill in your details to register.</p>
        </div>

        <?php if (!empty($message)): ?>
            <?php echo $message; ?>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="e.g. Ruth Gift" value="<?php echo htmlspecialchars($oldName); ?>" required>
            </div>

            <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="e.g. 08012345678" value="<?php echo htmlspecialchars($oldPhone); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($oldDob); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="At least 6 characters" required>
            </div>

            <button type="submit">Register User</button>
        </form>
    </div>

</body>
</html>