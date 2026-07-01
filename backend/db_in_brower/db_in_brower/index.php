<?php
include "connection.php";
include "model.php";

// Fetch all three datasets using the updated function names
$topLifeExpectancy = getHighestLifeExpectancy($con);
$topAfricanPopulations = getTopAfricanCountries($con);
$smallestCities = fetchSmallestCities($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Assignments</title>
</head>
<body>

    <h2>Top 10 Countries with Highest Life Expectancy</h2>
    <table>
        <tr>
            <th>Country</th>
            <th>Life Expectancy</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($topLifeExpectancy)): ?>
            <tr>
                <td><?= $row['NAME'] ?></td>
                <td><?= $row['LIFEEXPECTANCY'] ?></td>
            </tr>
        <?php endwhile ?>
    </table>
    
    <hr>
    
    <h2>Top 10 Most Populated Countries in Africa</h2>
    <table>
        <tr>
            <th>Country</th>
            <th>Population</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($topAfricanPopulations)): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['Population'] ?></td>
            </tr>
        <?php endwhile ?>
    </table>

    <hr>

    <h2>Top 10 Smallest Cities in the World</h2>
    <table>
        <tr>
            <th>City</th>
            <th>Population</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($smallestCities)): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['Population'] ?></td>
            </tr>
        <?php endwhile ?>
    </table>

</body>
</html>