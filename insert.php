
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

    echo "Student Added";
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
</head>
<body>
  <a href="index.php"><button>Go Back</button></a>  
</body>
</html>