<?php
session_start();
require_once 'db.php'; // MySQLi connection

// Route Protection
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['user_name'];
$theme = $_SESSION['theme'] ?? 'blue';
$user_id = $_SESSION['user_id'];

$messages = [];

try {
    // Look up only the notes belonging to this logged-in individual
    $stmt = $conn->prepare("SELECT * FROM notes WHERE user_id = ? ORDER BY id DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    $stmt->close();
} catch (mysqli_sql_exception $e) {
    $error_message = "Could not pull notes from database.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?= $theme ?>">

<div class="window-container">

    <aside class="sidebar">
        <div class="window-controls">
            <span class="dot close"></span>
            <span class="dot minimize"></span>
            <span class="dot expand"></span>
        </div>

        <div class="section-title">iCloud</div>
        <div class="user-info">
            <div class="user-name"><?= htmlspecialchars($username) ?></div>
        </div>

        <ul class="folder-list">
            <li class="active">📥 Notes</li>
        </ul>

        <div class="section-title">Tags</div>
        <div class="tags-container">
            <span class="tag">All Tags</span>
            <span class="tag">#books</span>
            <span class="tag">#history</span>
        </div>

        <div class="sidebar-footer">
            <select id="theme-selector">
                <option value="blue">Blue Theme</option>
                <option value="green">Green Theme</option>
                <option value="maroon">Maroon Theme</option>
            </select>

            <button class="new-folder-btn">📁 New Folder</button>

            <a href="logout.php" class="logout-link" style="float: right; text-decoration: none; font-size: 12px; color: #ff5f56; font-weight: 500;">
                🚪 Logout
            </a>
        </div>
    </aside>

    <section class="message-list-panel">
        <div class="panel-header">
            <button class="icon-btn">📋</button>
            <button class="icon-btn">🔲</button>
        </div>

        <div class="list-scrollable">
            <?php
            $currentGroup = '';
            foreach ($messages as $msg):
                if ($currentGroup !== $msg['date_group']) {
                    $currentGroup = $msg['date_group'];
                    echo "<div class='date-separator'>{$currentGroup}</div>";
                }
            ?>
            <div class="message-item" data-id="<?= $msg['id'] ?>" onclick="selectMessage(this)">
                <div class="item-title">
                    <?= htmlspecialchars($msg['title']) ?>
                </div>
                <div class="item-meta">
                    <span class="item-time">
                        <?= htmlspecialchars($msg['timestamp']) ?>
                    </span>
                    <span class="item-preview">
                        <?php 
                            $lines = explode("\n", $msg['body']);
                            echo htmlspecialchars((isset($lines[1]) && trim($lines[1]) !== '') ? $lines[1] : "No additional text"); 
                        ?>
                    </span>
                </div>
                <textarea class="hidden-body"><?= htmlspecialchars($msg['body']) ?></textarea>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <main class="reading-pane">
        <div class="pane-header">
            <button class="icon-btn" id="new-note-btn">✍️</button>
            <button class="icon-btn" id="delete-note-btn">🗑️</button>
            <button class="icon-btn">📤</button>
        </div>

        <div class="pane-content">
            <div class="note-date" id="display-date">Select a note</div>
            <div class="note-editor" id="display-body" contenteditable="true">
                Click a note from the left panel to view it.
            </div>
        </div>
    </main>

</div>

<script src="script.js"></script>
</body>
</html>