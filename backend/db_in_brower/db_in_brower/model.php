<?php

function executeQuery($con, $statement) {
    $prepare = mysqli_prepare($con, $statement);
    mysqli_stmt_execute($prepare);
    $results = mysqli_stmt_get_result($prepare);
    mysqli_stmt_close($prepare); 
    
    return $results;
}

// Renamed from fetchTopLifeExpectancy
function getHighestLifeExpectancy($con) {
    $statement = "SELECT NAME, LIFEEXPECTANCY FROM country ORDER BY LIFEEXPECTANCY DESC LIMIT 10";
    return executeQuery($con, $statement);
}

// Shortened from fetchTopPopulatedAfricanCountries
function getTopAfricanCountries($con) {
    $statement = "SELECT name, Population FROM country WHERE Continent = 'Africa' ORDER BY Population DESC LIMIT 10";
    return executeQuery($con, $statement);
}

function fetchSmallestCities($con) {
    $statement = "SELECT name, Population FROM city ORDER BY Population ASC LIMIT 10";
    return executeQuery($con, $statement);
}

?>