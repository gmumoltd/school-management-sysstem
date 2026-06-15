<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | SMS</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Student Management System</h1>
        <hr>
        <!-- Links to go to the crud pages -->
        <a href="index.php" class="btn btn-primary">Add Student</a>
        <a href="view.php" class="btn btn-success">View</a>
        <hr>

        <!-- lables and input fields for the form -->
        <h2>Student Registration Form</h2>
<form action="insert.php" method="POST">
    <label for="name" class="form-label">Name: </label>
    <input type="text" name="name" class="form-control" placeholder="Enter name">
    <br>
    <label for="email" class="form-label">Email: </label>
    <input type="email" name="email" placeholder="Enter email" class="form-control">
    <br>
    <label for="course" class="form-label">Course: </label>
    <input type="text" name="course" placeholder="Enter course" class="form-control">
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
</body>
</html>
