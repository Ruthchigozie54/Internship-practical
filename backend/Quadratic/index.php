<?php

header("Content-Type: application/json");

require_once "factorize.php";

$a = $_POST["a"] ?? null;
$b = $_POST["b"] ?? null;
$c = $_POST["c"] ?? null;

if ($a === null || $b === null || $c === null) {

    echo json_encode([
        "success" => false,
        "message" => "Please provide a, b and c."
    ]);

    exit;
}

$result = factorizeQuadratic((int)$a, (int)$b, (int)$c);

echo json_encode($result);