<?php
session_start();

// Route Protection: If session token does not exist, send them away immediately
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}


$messages = [
    [
        "id" => 1,
        "title" => "So many books, so little time.",
        "timestamp" => "16:17",
        "date_group" => "Today",
        "preview" => "Frank Zappa",
        "body" => "So many books, so little time.\n\n- Frank Zappa"
    ],
    [
        "id" => 2,
        "title" => "I am sorry to hear that, but wh...",
        "timestamp" => "10:54",
        "date_group" => "Today",
        "preview" => "I had known so much more...",
        "body" => "I am sorry to hear that, but what can we do? I had known so much more before this happened."
    ],
    [
        "id" => 3,
        "title" => "What an excellent father you...",
        "timestamp" => "Yesterday",
        "date_group" => "Yesterday",
        "preview" => "He was shot. I do not know...",
        "body" => "What an excellent father you have. He was shot. I do not know how to express my gratitude, he said."
    ],
    [
        "id" => 4,
        "title" => "At our time of life it is n...",
        "timestamp" => "Yesterday",
        "date_group" => "Yesterday",
        "preview" => "How very true...",
        "body" => "At our time of life it is normal to look back. How very true this is. Let's explore new paths."
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="window-container">

    <aside class="sidebar">

        <div class="window-controls">
            <span class="dot close"></span>
            <span class="dot minimize"></span>
            <span class="dot expand"></span>
        </div>

        <div class="section-title">iCloud</div>

        <ul class="folder-list">
            <li class="active">📥 Notes</li>
            <li>🗑️ Recently Deleted</li>
        </ul>

        <div class="section-title">Tags</div>

        <div class="tags-container">
            <span class="tag">All Tags</span>
            <span class="tag">#books</span>
            <span class="tag">#history</span>
        </div>

        <div class="sidebar-footer">
         <button class="new-folder-btn">📁 New Folder</button>
         <a href="logout.php" class="logout-link" style="float: right; text-decoration: none; font-size: 12px; color: #ff5f56; font-weight: 500;">🚪 Logout</a>
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

            <div class="message-item"
                onclick="selectMessage(this)">

                <div class="item-title">
                    <?= htmlspecialchars($msg['title']) ?>
                </div>

                <div class="item-meta">
                    <span class="item-time">
                        <?= htmlspecialchars($msg['timestamp']) ?>
                    </span>

                    <span class="item-preview">
                        <?= htmlspecialchars($msg['preview']) ?>
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

            <div class="note-date" id="display-date">
                Select a note
            </div>

            <div class="note-editor" id="display-body" contenteditable="true">
                Click a note from the left panel to view it.
            </div>

        </div>

    </main>

</div>

<script src="script.js"></script>
</body>
</html>
