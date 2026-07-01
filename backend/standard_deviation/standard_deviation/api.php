<?php

// Tell the browser this file returns JSON
header("Content-Type: application/json");

// Read JSON sent from JavaScript
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["mean"]) || !isset($data["rows"])) {
    echo json_encode([
        "error" => "Invalid data received."
    ]);
    exit();
}

// Get the mean
$mean = $data["mean"];

// Get all rows
$rows = $data["rows"];

// Variables to store totals
$totalF = 0;
$totalFD2 = 0;

// Array to store calculated rows
$resultRows = [];

// Loop through each row
foreach ($rows as $row) {

    $x = $row["x"];
    $f = $row["f"];

    // Calculate d
    $d = $x - $mean;

    // Calculate d²
    $d2 = pow($d, 2);

    // Calculate fd²
    $fd2 = $f * $d2;

    // Calculate totals
    $totalF += $f;
    $totalFD2 += $fd2;

    // Store the calculated row
    $resultRows[] = [

        "x" => $x,
        "f" => $f,
        "d" => round($d, 2),
        "d2" => round($d2, 2),
        "fd2" => round($fd2, 2)

    ];
}

// Calculate Standard Deviation
if ($totalF > 0) {

    $standardDeviation = sqrt($totalFD2 / $totalF);

} else {

    $standardDeviation = 0;

}

// Return JSON
echo json_encode([

    "rows" => $resultRows,
    "totalF" => $totalF,
    "totalFD2" => round($totalFD2, 2),
    "standardDeviation" => round($standardDeviation, 2)

]);

?>