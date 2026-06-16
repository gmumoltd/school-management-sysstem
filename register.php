<?php

include 'connect.php';

if(isset($_POST['register'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password= password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users
    (username,email,password)

VALUES

    ('$username','$email','$hashed_password')";

    $result = mysqli_query($conn,$sql);

    if($result){

        echo "<div class='alert alert-success'>
        Registration Successful
        </div>";

}

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>User Registration</h2>

    <form method="POST">

            <input type="text" name="username" class="form-control" placeholder="Username" required>

            <br>

            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <br>

            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <br>

            <button name="register" class="btn btn-primary"> Register </button>

    </form>

    <br>

    <a href="login.php"> Already have an account? Login </a>
</div>

</body>

</html>
