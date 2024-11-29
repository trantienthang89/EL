<?php
// conver.php
session_start();
include '../model/db.php';

// Lấy tất cả các cuộc hội thoại
$stmt = $pdo->prepare("SELECT * FROM conver WHERE type = 'conversation'");
$stmt->execute();
$conversations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversations</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/lessons.css">
    <link rel="stylesheet" href="../public/css/navbar.css">
</head>
<body>
<?php include 'navbar.php'; ?>


    <div class="container main-content">
        <div class="breadcrumb">
            <a href="../index.php">Home</a> > Conversations
        </div>

        <div class="level-header">
            <h1>Conversation Practice</h1>
            <div class="level-description">
                <p>Practice real-world conversations.</p>
            </div>
        </div>

        <div class="conversations-grid">
            <?php foreach ($conversations as $conversation): ?>
                <div class="conversation-card">
                    <div class="conversation-content">
                        <h3><?php echo htmlspecialchars($conversation['title']); ?></h3>
                        <p><?php echo htmlspecialchars($conversation['description']); ?></p>
                        <div class="conversation-meta">
                            <span>Duration: <?php echo htmlspecialchars($conversation['duration']); ?> minutes</span>
                            <span>Difficulty: <?php echo htmlspecialchars($conversation['difficulty']); ?></span>
                        </div>
                        <div class="conversation-actions">
                            <a href="conversation_detail.php?title=<?php echo urlencode($conversation['title']); ?>" class="practice-btn">Start Practice</a>
                            <button class="preview-btn">Preview</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Audio Preview Modal -->
    <div id="previewModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Conversation Preview</h2>
            <audio id="previewAudio" controls>
                <source src="" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>

    <script src="assets/js/conversations.js"></script>
</body>
</html> 