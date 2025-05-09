<?php
require '../config/db.php';
session_start();

// TODO: Understand this function
function sanitize($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

// ensure registration uses correct method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO: what are we doing here and why (sanitizing and validating)
    // sanitize inputs
    $account_type = sanitize($_POST['account_type']);
    $username     = sanitize($_POST['username']);
    // no sanitize: raw input for hashing
    $password     = $_POST['password']; 
    $full_name    = sanitize($_POST['full_name']);
    $contact_title = isset($_POST['contact_title']) ? sanitize($_POST['contact_title']) : null;
    $phone_number = sanitize($_POST['phone_number']);
    $email        = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    // TODO: once we've vaildated and sanitized the inputs we may want to do somthing with the values before we try to insert them into the database

    if (!$email) {
        // apparently die fucntion can be abused. Can we sent the user an alert if the email is incorrect?
        die("Invalid email format.");
    }

    // https://www.php.net/manual/en/function.password-hash.php
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // https://www.php.net/manual/en/pdo.prepare.php
        $stmt = $pdo->prepare("
            INSERT INTO users 
            (account_type, username, password_hash, full_name, contact_title, phone_number, email)
            VALUES (:account_type, :username, :password_hash, :full_name, :contact_title, :phone_number, :email)
        ");

        // https://www.php.net/manual/en/pdostatement.execute.php
        $stmt->execute([
            ':account_type'   => $account_type,
            ':username'       => $username,
            ':password_hash'  => $password_hash,
            ':full_name'      => $full_name,
            ':contact_title'  => $contact_title,
            ':phone_number'   => $phone_number,
            ':email'          => $email
        ]);

        // Set session to log the user in
        $_SESSION['user_id'] = $pdo->lastInsertId();

        // Redirect to protected area
        header('Location: dashboard.php');
        exit;
    } catch (PDOException $e) {
        if ($e->errorInfo[1] === 1062) {
            // TODO: user should stay on page and receive an alert
            echo "Username or Email already exists.";
        } else {
            // TODO: understand what this catchall error actually does
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    // TODO: user should stay on page and receive an alert
    echo "Invalid request method.";
}
?>
