<?php

// 1. Create a variable for the connection
$conn = mysqli_connect(
    // Pass the db credentials
    // eg, hostname, db_name, username, password
    // mysql -u root -h 127.0.0.1 -p
    "localhost",
    "root",
    "",
    "fca_students_academy"
);
if(!$conn){
    die("Connection Failed");
}

echo "Connected Successfully";

?>