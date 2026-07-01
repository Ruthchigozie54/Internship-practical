<?php 
include 'connection.php';
global $conn;


// catch the form data
$code = $_POST['country_code'];
$name = $_POST['country']; 

$sql = "SELECT code FROM Country WHERE code = ?";
$prepared_check = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($prepared_check, "s", $code);
mysqli_stmt_execute($prepared_check);
$results = mysqli_stmt_get_result($prepared_check);


if (isset ($_POST['country']) && isset($_POST['country_code'])) {
  if (mysqli_num_rows($results) > 0) {
  echo "Country already exists";
} else {
  $sql = "INSERT INTO country (name, code) VALUES (?, ?)";
  $prepared_insert = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($prepared_insert, "ss", $name, $code);
  mysqli_stmt_execute($prepared_insert);

  if (mysqli_stmt_affected_rows($prepared_insert) > 0) {
    echo "Country inserted successfully";
  } else {
    echo "Error inserting Country: " . mysqli_error($conn);
  }
} 
} else {
  echo "Please fill in all fields";
};




?>