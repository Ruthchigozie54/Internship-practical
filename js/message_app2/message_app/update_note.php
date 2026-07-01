<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['logged_in'])) {
    exit(json_encode(['success' => false]));
}

$user_id = $_SESSION['user_id'];
$id = intval($_POST['id'] ?? 0);
$body = $_POST['body'] ?? '';

// Extract title cleanly out of the first non-empty text row line
$lines = explode("\n", trim($body));
$title = !empty($lines[0]) ? mb_strimwidth($lines[0], 0, 40, "...") : "New Note";
$timestamp = date("H:i");

$stmt = $conn->prepare("UPDATE notes SET title = ?, body = ?, timestamp = ? WHERE id = ? AND user_id = ?");
$stmt->bind_param("sssii", $title, $body, $timestamp, $id, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'timestamp' => $timestamp, 'title' => $title]);
} else {
    echo json_encode(['success' => false]);
}
$stmt->close();