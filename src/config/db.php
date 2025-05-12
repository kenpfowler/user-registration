<?php
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // instantiate database connction
    // https://www.php.net/manual/en/book.pdo.php
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Log the error to a file or error monitoring system
    // https://www.php.net/manual/en/function.error-log.php
    error_log("Database connection failed: " . $e->getMessage());

    // redirect or show a user-friendly message
    header("Location: error.html");
    exit;
}
?>
