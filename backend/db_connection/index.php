<?php
session_start();

$message = "";

if (isset($_SESSION["added"]) && $_SESSION["added"] == true){

$message = "New country: " . $_SESSION["country"] . " with code: " . $_SESSION["code"]. " has been added successfully";
unset($_SESSION["added"]);


}

echo "<h1>$message</h1>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="process.php" method="post">
    <input name="code" placeholder="Enter country code"  type="text">
    <input name="name" placeholder="Enter country name"  type="text">
    <button type="submit">ADD COUNTRY</button>
  </form>
</body>
</html>