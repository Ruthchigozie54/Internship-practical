<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['logged_in'])) {
    exit(json_encode(['success' => false]));
}

$user_id = $_SESSION['user_id'];
$id = intval($_POST['id'] ?? 0);

$stmt = $conn->prepare("DELETE FROM notes WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
$stmt->close();