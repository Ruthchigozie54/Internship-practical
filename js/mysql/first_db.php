<?php 
$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "world";

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected";
}


// set charset to avoid encoding issues



?>