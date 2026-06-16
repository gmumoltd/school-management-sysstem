<?php
session_start();
session_destroy();
header("location: login.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <td>
        <a href="edit.php?id=<?php echo $row['ID']; ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete.php?id=<?php echo $row['ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
    </td>
</body>
</html>