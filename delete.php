<?php
include 'connect.php';

// 1. Make sure an ID was actually passed in the URL to prevent errors
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    // Cast to integer as an extra layer of defense if your IDs are numeric
    $id = (int)$_GET['id'];

    // 2. Use a prepared statement template
    $sql = "DELETE FROM students WHERE id = ?";

    // Initialize the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // "i" means we are binding an integer variable
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the secure query
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // 3. Always call exit() right after a redirect header
            header("Location: view.php");
            exit(); 
        } else {
            echo "Delete Failed: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the SQL statement.";
    }

} else {
    // If someone tries to access delete.php without an ID, send them back
    header("Location: view.php");
    exit();
}
?>
