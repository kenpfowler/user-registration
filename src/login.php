<?php
session_start();
require '../config/db.php';

function sanitize($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT id, email, password_hash FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // ✅ Password matched — create session
            session_regenerate_id(true); // prevents session fixation
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header('Location: dashboard.php'); // redirect to protected area
            exit;
        } else {
            // ❌ Invalid credentials
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
