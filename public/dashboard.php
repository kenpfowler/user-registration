<?php
session_start();
require __DIR__ . '/../config/db.php';

function sanitize($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

// Get user info from the database
try {
    $stmt = $pdo->prepare("SELECT email, username, full_name, account_type, contact_title, phone_number FROM users WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit;
    }
} catch (PDOException $e) {
    error_log("Dashboard DB error: " . $e->getMessage());
    echo "An error occurred. Please try again later.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="dashboard">
        <div class="logout">
            <form method="POST" action="handle-logout.php">
                <button type="submit">Log Out</button>
            </form>
        </div>

        <h1>Welcome, <?= sanitize($user['full_name']) ?>!</h1>

        <div class="user-info">
            <p><strong>Username:</strong> <?= sanitize($user['username']) ?></p>
            <p><strong>Email:</strong> <?= sanitize($user['email']) ?></p>
            <p><strong>Account Type:</strong> <?= sanitize($user['account_type']) ?></p>
            <?php if (!empty($user['contact_title'])): ?>
                <p><strong>Contact Title:</strong> <?= sanitize($user['contact_title']) ?></p>
            <?php endif; ?>
            <p><strong>Phone Number:</strong> <?= sanitize($user['phone_number']) ?></p>
        </div>
    </div>
</body>
</html>
