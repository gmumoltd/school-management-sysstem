<?php
include "connect.php";

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<div class="container mt-5">
    <h2>Student List</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>UserName</th>
                <th>Email</th>
                <!-- <th>Password</th> -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // The loop must live entirely inside the tbody
            while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['USERNAME']; ?></td>
                    <td><?php echo $row['EMAIL']; ?></td>
                    <!-- <td><?php echo $row['password']; ?></td> -->
                    <td>
                        <a href="edit.php?id=<?php echo $row['ID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?php echo $row['ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                    </td>
                </tr>
            <?php
            } // This closes the while loop properly
            ?>
        </tbody>
    </table>
</div>

</body>
</html>