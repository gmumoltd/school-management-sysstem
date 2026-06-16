<?php
// 1. Start the session at the very top before any HTML or output
session_start();

// 2. Protect the page: If the session variable is missing, force redirect to login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Always call exit() right after a redirect header to stop script processing
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap 5.3.3 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <!-- Main Dashboard Card Layout -->
    <div class="card shadow-sm p-4">
        <h1 class="text-primary">Dashboard</h1>
        <hr>

        <!-- 3. Securely output the username using htmlspecialchars -->
        <h3 class="my-4">
            Welcome, <span class="text-dark"><?php echo htmlspecialchars($_SESSION['username']); ?></span>!
        </h3>
           <h3> <a href="viewusers.php" class="btn btn-success">View</a></h3>
        <div class="mt-3">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
