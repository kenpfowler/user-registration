<?php
require_once __DIR__ . '../config/init.php'; // contains session setup and other global configs

// Get route from URL query, e.g., index.php?page=dashboard
$page = $_GET['page'] ?? '';

// Load route definitions
$routes = require __DIR__ . '../src/routes/routes.php';

// Match route
if (array_key_exists($page, $routes)) {
    require __DIR__ . '../src/controllers/' . $routes[$page];
} else {
    http_response_code(404);
    header('Location: not-found.html');
}
