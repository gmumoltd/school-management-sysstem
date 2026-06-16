
<?php

include "connect.php";

$name = $_POST['name'];
$email = $_POST['email'];
$course = $_POST['course'];

$sql = "INSERT INTO students
(name,email,course)

VALUES

('$name','$email','$course')";

$result = mysqli_query(
    $conn, // is the connection still valid?
    $sql // has the sql query ran successfully?
);

if($result){

    echo "<br>Student Added";
}else{

    echo "Error";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
  <a href="index.php"><button class="btn btn-primary"> Go Back </button></a> 
</div> 
</body>
</html>