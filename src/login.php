<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    // fail fast if email isn't validated
    if (!$email) {
        $_SESSION['message'] = "Login failed. Invalid email or password.";
        $_SESSION['msg_type'] = "failure";
        header('Location: /'); // redirect to protected area
        exit;
    }
    
    try {
        // use prepared statement and binding parameters to prevent SQL injection.
        $stmt = $pdo->prepare("SELECT id, email, password_hash FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // ✅ Password matched — create session
            
            // gaurd against session fixation
            // https://owasp.org/www-community/attacks/Session_fixation
            session_regenerate_id(true); 
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            $_SESSION['message'] = "Welcome back!";
            $_SESSION['msg_type'] = "success";
            header('Location: dashboard.php'); // redirect to protected area
            exit;
        } else {
            // ❌ Invalid credentials
            $_SESSION['message'] = "Login failed. Invalid email or password.";
            $_SESSION['msg_type'] = "failure";
            header('Location: /'); // redirect to protected area
            exit;
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        header('Location: error.html');
        exit;
    }
} else {
    // It might be okay to echo the response here. The average user will use the POST method since it is enforced by the UI.
    // Only someone with advanced knowledge of the web would try to access this endpoint by other means (curl, etc...)
    echo "Invalid request method.";
}
