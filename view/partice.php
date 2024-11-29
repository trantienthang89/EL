<?php
// practice_tests.php
session_start();
include '../model/db.php';

// Fetch all tests from the Practice table
$stmt = $pdo->prepare("SELECT * FROM Practice");
$stmt->execute();
$tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($tests === false) {
    die("Error fetching tests: " . implode(", ", $stmt->errorInfo()));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice Tests</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/lessons.css">
    <link rel="stylesheet" href="../public/css/navbar.css">
</head>
<body>
<?php include 'navbar.php'; ?>

    <div class="container main-content">
        <div class="breadcrumb">
            <a href="../index.php">Home</a> > Practice Tests
        </div>

        <div class="level-header">
            <h1>Practice Tests</h1>
            <div class="test-overview">
                <div class="overview-item">
                    <span class="overview-label">Total Tests:</span>
                    <span class="overview-value"><?php echo count($tests); ?></span>
                </div>
            </div>
        </div>

        <div class="tests-grid">
            <?php if (count($tests) > 0): ?>
                <?php foreach ($tests as $test): ?>
                    <div class="test-card">
                        <div class="test-header">
                            <h3><?php echo htmlspecialchars($test['title']); ?></h3>
                        </div>
                        <div class="test-content">
                            <div class="test-info">
                                <p>Topics: <?php echo htmlspecialchars($test['topics']); ?></p>
                                <p>Duration: <?php echo htmlspecialchars($test['duration']); ?> minutes</p>
                                <p>Questions: <?php echo htmlspecialchars($test['questions']); ?></p>
                                <p>Level: <?php echo htmlspecialchars($test['level']); ?></p>
                                <?php if (isset($test['description'])): ?>
                                    <p>Description: <?php echo htmlspecialchars($test['description']); ?></p>
                                <?php endif; ?>
                            </div>
                            <a href="test_start.php?id=<?php echo htmlspecialchars($test['id']); ?>" class="test-btn">
                                <?php echo isset($test['score']) ? 'Retake Test' : 'Start Test'; ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No tests available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
