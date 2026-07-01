<?php
session_start();
require_once 'db.php';

// Force the browser to read this output strictly as JSON
header('Content-Type: application/json');

// Session verification
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['user_id'])) {
    exit(json_encode(['success' => false, 'error' => 'No active session found.']));
}

$user_id = $_SESSION['user_id'];
$title = "New Note";
$body = "New Note";
$timestamp = date("H:i");
$date_group = "Today";

try {
    $stmt = $conn->prepare("INSERT INTO notes (user_id, title, body, timestamp, date_group) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $title, $body, $timestamp, $date_group);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'id' => $conn->insert_id, 
            'timestamp' => $timestamp
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Execution failed.']);
    }
    $stmt->close();

} catch (mysqli_sql_exception $e) {
    // If the database has a column mismatch or constraint issue, catch it here cleanly!
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
exit;