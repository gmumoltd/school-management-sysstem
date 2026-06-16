<?php
// 1. Session protection (ensure only logged-in users can update students)
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'connect.php';

// Initialize variables to prevent errors
$id = 0;
$row = ['name' => '', 'email' => '', 'course' => ''];
$success_msg = "";
$error_msg = "";

// 2. FETCH CURRENT RECORD
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = (int)$_GET['id']; // Cast to integer for security

    // Securely pull the current student details using a prepared statement
    $fetch_sql = "SELECT * FROM students WHERE id = ?";
    $fetch_stmt = mysqli_prepare($conn, $fetch_sql);
    
    if ($fetch_stmt) {
        mysqli_stmt_bind_param($fetch_stmt, "i", $id);
        mysqli_stmt_execute($fetch_stmt);
        $result = mysqli_stmt_get_result($fetch_stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            // Success: Student record found and saved into $row
        } else {
            $error_msg = "Student record not found.";
        }
        mysqli_stmt_close($fetch_stmt);
    }
} else {
    // Redirect if no valid ID is provided in the URL
    header("Location: view.php");
    exit();
}

// 3. UPDATE RECORD (Triggers when the form is submitted)
if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);

    if (!empty($name) && !empty($email) && !empty($course)) {
        // Secure update statement using placeholders
        $update_sql = "UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);

        if ($update_stmt) {
            // "sssi" - 3 strings (name, email, course) and 1 integer (id)
            mysqli_stmt_bind_param($update_stmt, "sssi", $name, $email, $course, $id);
            
            if (mysqli_stmt_execute($update_stmt)) {
                // Instantly update the current local $row array so the form displays the new data
                $row['name'] = $name;
                $row['email'] = $email;
                $row['course'] = $course;
                
                $success_msg = "Student record updated successfully!";
                
                // Optional: Automatically redirect back to view.php after 2 seconds
                header("refresh:2;url=view.php");
            } else {
                $error_msg = "Update Failed: " . mysqli_error($conn);
            }
            mysqli_stmt_close($update_stmt);
        }
    } else {
        $error_msg = "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow-sm p-4">
        <h2>Update Student Details</h2>
        <p class="text-muted">Editing Record ID: <?php echo $id; ?></p>
        <hr>

        <!-- Status Alerts -->
        <?php if (!empty($success_msg)): ?>
            <div class="alert alert-success"><?php echo $success_msg; ?></div>
        <?php endif; ?>

        <?php if (!empty($error_msg)): ?>
            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <!-- 4. HTML FORM (Pre-filled with secure data) -->
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Course Name</label>
                <input type="text" name="course" value="<?php echo htmlspecialchars($row['course']); ?>" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="view.php" class="btn btn-secondary">Cancel</a>
                <button name="update" class="btn btn-success">Update Student</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
