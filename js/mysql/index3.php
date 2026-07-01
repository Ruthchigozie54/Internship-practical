<?php 
// Include the database connection file
require_once "first_db.php";

$sql = "SELECT name FROM city ORDER BY Population DESC LIMIT 10";

//prepare the statement
$stmt = mysqli_prepare($conn, $sql);

//bind parameters ("s" indicates string data type)

if ($stmt) {
//execute the query
mysqli_stmt_execute($stmt);

//get the result from the executed statement
$result = mysqli_stmt_get_result($stmt);

//loop through rows using an associative array
while ($country = mysqli_fetch_assoc($result)) {
  echo "________", "\n";
  echo $country["name"], "\n";
  
}
}
else{
  echo "error, preparing statement";
};

//close the statement


?>