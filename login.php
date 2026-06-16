<?php
// 1. Start the session at the very top before any HTML or output
session_start();

include 'connect.php';

// If the user is already logged in, redirect them directly to the dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error_message = "";

if (isset($_POST['login'])) {
    // Grab and clean user input text
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 2. Select only by username using a secure placeholder (?)
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the username variable as a string ("s")
        mysqli_stmt_bind_param($stmt, "s", $username);
        
        // Execute the query
        mysqli_stmt_execute($stmt);
        
        // Fetch the results from the database execution
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // 3. VERIFY PASSWORD: Match the plain text password against the hashed string in DB
            if (password_verify($password, $row['password'])) {
                
                // Password is correct! Set session variables
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id']  = $row['id'];
                
                // Securely redirect to the dashboard and stop further script execution
                header("Location: dashboard.php");
                exit();
            } else {
                $error_message = "Invalid Username or Password.";
            }
        } else {
            $error_message = "Invalid Username or Password.";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Database error. Please try again later.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="max-width: 450px;">
    <h2>Login</h2>

    <!-- Display bootstrap error message clean and conditionally -->
    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        </div>

        <button name="login" class="btn btn-success w-100">Login</button>
    </form>

    <br>
    <a href="register.php">Create Account</a>
</div>

</body>
</html>
