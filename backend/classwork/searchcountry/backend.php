<?php
include "connect.php";

function all(mysqli $conn)
{
    $statement = "SELECT * FROM country";
    // $query = $connection->prepare($statement);
    $query = $conn->query($statement);
    if ($query->num_rows > 0) {
        return $query->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
function topTenPopulation(mysqli $conn) {
    $statement = "SELECT * FROM country ORDER BY Population desc LIMIT 10";
    $query = $conn->query($statement);
    if ($query->num_rows > 0) {
        return $query->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    sleep(3);
} else {
    die("Invalid request");
}

// routes
if ($action == "population") {
    $result =  json_encode(topTenPopulation($conn));
    echo $result;
} 
if ($action == "all") {
    $result =  json_encode(all($conn));
    echo $result;
} 