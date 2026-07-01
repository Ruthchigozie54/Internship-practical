<?php
include 'connection.php';

session_start();


$name =  $_POST['name'];
$code =  $_POST['code'];

//1. Create the statement

$query = "SELECT code FROM country WHERE code = ?";
$prepare_query = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($prepare_query, 's', $code);
mysqli_stmt_execute($prepare_query);
$result = mysqli_stmt_get_result($prepare_query);
$assoc = mysqli_fetch_assoc($result);


if (isset($assoc)) {
  $_SESSION["added"] = false;
    header("location:index.php");
    return;
}

$sql = "INSERT INTO country(Code, Name) VALUES (?, ?)";
$prepare_sql = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($prepare_sql, 'ss', $code, $name);
mysqli_stmt_execute($prepare_sql);


if (mysqli_affected_rows($conn) > 0){
    $_SESSION["added"] = true; 
    $_SESSION["country"] = $name; 
    $_SESSION["code"] = $code; 
    header("location:index.php");
}



?>