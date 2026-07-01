<?php

header("Content-Type: application/json");

require_once("../functions.php");

// Check if the word exists
if (!isset($_GET["word"])) {

    echo json_encode([
        "success" => false,
        "message" => "Please enter a word."
    ]);

    exit;
}

// Clean the word
$word = cleanWord($_GET["word"]);

// Validate empty input
if ($word == "") {

    echo json_encode([
        "success" => false,
        "message" => "Word cannot be empty."
    ]);

    exit;
}

// Get length
$length = strlen($word);

// Get letter frequencies
$frequency = getLetterFrequency($word);

// Calculate factorial
$numerator = factorial($length);

$denominator = 1;

foreach ($frequency as $count) {

    $denominator *= factorial($count);

}

$totalPermutations = $numerator / $denominator;


$shuffles = [];


$maxShuffles = min(10, $totalPermutations);

while (count($shuffles) < $maxShuffles) {

    $shuffle = str_shuffle($word);

    if (!in_array($shuffle, $shuffles)) {
        $shuffles[] = $shuffle;
    }
}

// Return JSON
echo json_encode([
    "success" => true,
    "word" => $word,
    "length" => $length,
    "formula" => "{$length}! / {$denominator}",
    "possible_rearrangements" => $totalPermutations,
    "frequency" => $frequency,
    "shuffles" => $shuffles
], JSON_PRETTY_PRINT);