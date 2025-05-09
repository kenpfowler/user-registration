<?php
session_start();
require __DIR__ . '/../config/db.php';

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
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
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        .dashboard { max-width: 600px; margin: auto; }
        .user-info { margin-bottom: 2em; padding: 1em; border: 1px solid #ccc; border-radius: 8px; }
        .logout { text-align: right; }
        .logout form { display: inline; }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="logout">
            <form method="POST" action="handle-logout.php">
                <button type="submit">Log Out</button>
            </form>
        </div>

        <h1>Welcome, <?= htmlspecialchars($user['full_name']) ?>!</h1>

        <div class="user-info">
            <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Account Type:</strong> <?= htmlspecialchars($user['account_type']) ?></p>
            <?php if (!empty($user['contact_title'])): ?>
                <p><strong>Contact Title:</strong> <?= htmlspecialchars($user['contact_title']) ?></p>
            <?php endif; ?>
            <p><strong>Phone Number:</strong> <?= htmlspecialchars($user['phone_number']) ?></p>
        </div>
    </div>
</body>
</html>
